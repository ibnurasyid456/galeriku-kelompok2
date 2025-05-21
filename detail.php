<?php

// Memulai Sesi
session_start();


// Mengubungkan file koneksi.php
require 'config/koneksi.php';


// Proses Menambah Like
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    // Periksa apakah user sudah login
    if (!isset($_SESSION['user_id'])) {
        // Jika belum login, arahkan ke halaman login
        header("Location: login.php"); // Ganti "login.php" dengan alamat halaman loginmu
        exit;
    }

    // Pastikan file_name diterima dengan benar dari query parameter
    $file_name = $_GET['file_name'];
    $stmt = mysqli_prepare($con, "UPDATE photo SET likes = likes + 1 WHERE file_name = ?");
    mysqli_stmt_bind_param($stmt, "s", $file_name);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: detail.php?file_name=" . urlencode($file_name));   // Redirect ulang untuk menampilkan perubahan
        exit;
    } else {
        echo "Error: " . mysqli_error($con);   // Menampilkan error jika query gagal
    }
}


// Proses Menambah Komentar
// Pastikan pengguna sudah login sebelum dapat mengirimkan komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment']) && !empty($_POST['comment'])) {
    if (!isset($_SESSION['user_id'])) {
        // Pengguna belum login, arahkan ke halaman login
        header("Location: login.php"); // Ganti dengan lokasi login Anda
        exit;
    }

    // Jika sudah login, simpan komentar
    $comment = trim($_POST['comment']);
    $user_id = $_SESSION['user_id'];
    $stmt = mysqli_prepare($con, "INSERT INTO comments (file_name, content, user_id, created_at) VALUES (?, ?, ?, NOW())");
    mysqli_stmt_bind_param($stmt, "ssi", $_GET['file_name'], $comment, $user_id);
    mysqli_stmt_execute($stmt);
    header("Location: detail.php?file_name=" . urlencode($_GET['file_name']));
    exit;
}


// jika parameter file_name tidak ada maka akan menampilkan itu
if (!isset($_GET['file_name'])) {
    die("Foto tak ditemukan.");
}



// Mengambil data foto dari database
$file_name = $_GET['file_name'];
$stmt = mysqli_prepare($con, "SELECT * FROM photo WHERE file_name = ?");
mysqli_stmt_bind_param($stmt, "s", $file_name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$photo = mysqli_fetch_assoc($result);

if (!$photo) {
    die("Foto tidak ditemukan.");
}
$photo['upload_time'] = date("d F Y, H:i", strtotime($photo['upload_time']));


// Mengambil Foto Terkait Berdasarkan Deskripsi
$description = $photo['description'];
$keywords = array_filter(explode(' ', $description));
$like_clauses = [];
$params = [];
$types = '';

foreach ($keywords as $word) {
    $like_clauses[] = "description LIKE ?";
    $params[] = '%' . $word . '%';
    $types .= 's';
}

$where_clause = implode(' OR ', $like_clauses);
$query = "SELECT * FROM photo WHERE file_name != ? AND ($where_clause) ORDER BY upload_time DESC ";
$params = array_merge([$file_name], $params);
$types = 's' . $types;

$stmt = mysqli_prepare($con, $query);


// Bind parameters dynamically : Mengikat Parameter secara dinamis menggunakan call_user_func_array
$bind_names[] = $types;
foreach ($params as $key => $value) {
    $bind_name = 'bind' . $key;
    $$bind_name = $value;
    $bind_names[] = &$$bind_name;
}
call_user_func_array([$stmt, 'bind_param'], $bind_names);

mysqli_stmt_execute($stmt);
$related_result = mysqli_stmt_get_result($stmt);
$related_photos = [];
while ($row = mysqli_fetch_assoc($related_result)) {
    $related_photos[] = $row;
}


// Mengambil Komentar untuk Foto
// Pastikan variabel $comments_query sudah dieksekusi dengan benar
$comments_query = mysqli_prepare($con, "SELECT * FROM comments WHERE file_name = ? ORDER BY created_at DESC");

if ($comments_query === false) {
    die('Query tidak dapat dijalankan: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($comments_query, "s", $file_name);
mysqli_stmt_execute($comments_query);

// Ambil hasil query
$comments_result = mysqli_stmt_get_result($comments_query);

if ($comments_result === false) {
    die('Tidak ada komentar yang ditemukan.');
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Foto</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>

    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
    }
    .col-md-7 {
    display: flex; /* Menggunakan flexbox */
    align-items: flex-start; /* Membuat item rata atas */
    flex-direction: column; /* Mengatur item menjadi kolom */
}

.image-container {
  position: relative;
  display: inline-block;
  max-width: 60%;
  margin: 0 auto;
  transform: translateX(-45px); /* geser kiri seluruh blok */
}

.image-container .dropdown {
    position: absolute;
    top: 10px;
    z-index: 20;
    margin-top: 4rem;
    
}

.image-container .dropdown .btn {
    background-color: rgba(255, 255, 255, 0.85);
    border: none;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    transition: background-color 0.3s ease;
}

.image-container .dropdown .btn:hover {
    background-color: rgba(255, 255, 255, 1);
}

.main-photo-style {
  max-width: 650px;
  max-height: 650px;
  width: 100%;
  height: auto;
  border-radius: 2rem;
  object-fit: contain;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s ease;
  user-select: none;
  margin-top: 3.5rem;
  /* Hapus transform atau margin-left di sini */
}

.main-photo-style:hover {
    transform: scale(1.02);
}



.btn-outline-secondary {
    display: block;
    margin: 1rem auto 0;
      transform: translateX(-45px); /* geser kiri seluruh blok */
    
}
  
    img.img-fluid.rounded:hover {
      transform: scale(1.02);
      transition: all 0.3s ease;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }


  

  @media (min-width: 768px) {
    .masonry-columns {
      column-count: 3;
      column-gap: 1rem
    }
  }

    /* .masonry-item img {
      width: 100%;
      height: auto;
    } */


  .masonry-item {
    break-inside: avoid;
    margin-bottom: 1rem;
    transition: transform 0.2s ease-in-out;
    width: 102%; /* Sesuaikan nilai ini sesuai kebutuhan */
    margin: 0 auto;
    
    }


  .masonry-item img:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

    .overlay-text.text-black {
       max-width: 80%; /* Sesuaikan lebar deskripsi */
      margin: 1rem auto 0;
      /* text-align: center; */
      max-width: 500px;
        transform: translateX(-45px); /* geser kiri seluruh blok */
   
    }

      .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
      }

      textarea:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
      }

      textarea.form-control {
        resize: none;
      }


      .related-photo {
        border-radius: 1rem; /* Atur sesuai selera, misal 0.5rem, 2rem, dst */
        transition: transform 0.3s ease;
      }
    .related-photo:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

   .back-button {
  position: absolute;
  top: 10px;
  left: 10px;
  z-index: 20;
  font-size: 1.8rem;
  padding: 0.3rem 0.6rem;
  background-color: rgba(255, 255, 255, 0.85);
  border-radius: 50%;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  color: #333;
  transition: background-color 0.3s ease;
}

.back-button:hover {
  background-color: rgba(255, 255, 255, 1);
  color: #000;
  text-decoration: none;
}

    

  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <!-- Kolom Kiri: Foto Utama -->
        <div class="col-md-7 ">
        <div class="image-container text-center position-relative ">
          <div class="dropdown" style="position: absolute; top: 10px; right: 10px; z-index: 20;">
         <button class="btn btn-light btn-sm rounded-circle shadow-sm"  type="button" data-bs-toggle="dropdown"   aria-expanded="false"  aria-label="Menu opsi foto" >
        <i class="bi bi-three-dots-vertical"></i>
      </button>

      <ul class="dropdown-menu">
        <li>
          <a class="dropdown-item" href="download.php?file=<?= urlencode($photo['file_name']) ?>">
            <i class="bi bi-download me-2"></i>Unduh
          </a>
        </li>
      </ul>
    </div>
    <img src="uploads/<?= htmlspecialchars($photo['file_name']) ?>"  alt="Foto utama"  class="main-photo-style" draggable="false"  />
    </div>

    

      <!-- Tombol Kembali -->
<a href="beranda.php" class="btn btn-secondary back-button" aria-label="Kembali ke beranda">
  <i class="bi bi-arrow-left-circle"></i>
</a>



        <!-- Deskripsi + Info -->
  <div class="mt-4 text-center overlay-text text-black fw-semibold px-2 ">
    <?= htmlspecialchars($photo['description']) ?>
    <p class="text-muted small">
      <i class="bi bi-clock me-1"></i><?= htmlspecialchars($photo['upload_time']) ?>
    </p>
  </div>

  <!-- Like -->
  <form method="post" class="text-center mb-4">
  <button type="submit" name="like" class="btn btn-outline-danger rounded-pill px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2">
    <i class="bi bi-heart-fill"></i> 
    <span>Suka</span> 
    <span class="badge bg-danger-subtle text-danger fw-semibold"><?= $photo['likes'] ?? 0 ?></span>
  </button>
</form>


  <!-- Komentar -->
  <div class="px-2">
  <form method="post" class="mb-4">
  <div class="input-group">
    <textarea name="comment" class="form-control rounded-start-4 shadow-sm border-1" rows="1" placeholder="Tulis komentar..."></textarea>
    <button type="submit" name="submit_comment" class="btn btn-primary rounded-end-4 px-4 shadow-sm">
      <i class="bi bi-send"></i> Kirim
    </button>
  </div>
</form>




    <!-- Daftar Komentar -->
    <div class="mt-3">
  <?php while ($comment = mysqli_fetch_assoc($comments_result)): ?>
    <div class="border rounded p-2 mb-2 bg-light">
      <p class="mb-1"><?= htmlspecialchars($comment['content']) ?></p>
      <small class="text-muted"><?= date("d M Y, H:i", strtotime($comment['created_at'])) ?></small>
      
     
    </div>
  <?php endwhile; ?>
</div>

  </div>
</div>

      <!-- Kolom Kanan: Foto Terkait dengan Pinterest-style -->
      <div class="col-md-5">
        <h5 class="mb-3 border-bottom pb-2 text-primary"><i class="bi bi-images me-2 text-primary"></i>Rekomendasi Terkait</h5>
        <div class="masonry-columns">
          <?php foreach ($related_photos as $related): ?>
            <div class="masonry-item mb-3">
              <a href="detail.php?file_name=<?= htmlspecialchars($related['file_name']) ?>" class="text-decoration-none">
                <img
                  src="uploads/<?= htmlspecialchars($related['file_name']) ?>"
                  alt="foto terkait"
                  class="img-fluid shadow-sm related-photo"
                />
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS (wajib untuk dropdown) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

