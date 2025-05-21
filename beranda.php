<?php


session_start();  // memulai sesi PHP untuk mengakses data sesi pengguna
include 'config/koneksi.php';   // Menyertakan file koneksi ke database


$username = $_SESSION['username'] ?? null; // Mengambil username dari sesi jika tersedia


// Hanya jalankan query ini jika user login
// Jika pengguna telah login, ambil data user_id dan avatar dari database
if ($username) {
    $user_query = mysqli_query($con, "SELECT user_id, avatar FROM users WHERE username = '$username'");
    $user_data = mysqli_fetch_assoc($user_query);
    $user_id = $user_data['user_id'];
    $avatar = $user_data['avatar'] ?? null;
}


?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GaleriKu</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }

    .btn-pink {
      background-color: #e91e63;
      color: white;
      border: none;
    }


    .sidebar {
      width: 80px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background-color: white;
      border-right: 1px solid #dee2e6;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 1rem;
      z-index: 1000;
    }


    .sidebar i {
      font-size: 1.5rem;
      margin: 1rem 0;
      color: #6c757d;
      cursor: pointer;
    }

    .sidebar i:hover {
      color: #000;
    }

    .main-content {
      margin-left: 80px;
    }

    .masonry {
      column-count: 4;
      column-gap: 1rem;
    }

    @media (max-width: 1200px) {
      .masonry {
        column-count: 3;
      }
    }

    @media (max-width: 768px) {
      .masonry {
        column-count: 2;
      }
    }

    @media (max-width: 576px) {
      .masonry {
        column-count: 1;
      }
    }

    .masonry-item {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
      overflow: visible;
      position: relative;
      break-inside: avoid;
      margin-bottom: 1rem;
    }

    .masonry-item img {
      width: 100%;
      height: 100%;
      border-radius: 1rem;
      display: block;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      object-fit: cover;
    }

    .masonry-item img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }

    .search-bar {
      background-color: white;
      padding: 1rem;
      position: sticky;
      top: 0;
      z-index: 999;
      border-bottom: 1px solid #dee2e6;
    }

    .search-input {
      width: 100%;
    }

    /* Modal Styles */
    .modal-content {
      border-radius: 1rem;
    }

    .dropdown-menu {
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .avatar-img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 80%;
}


.masonry-item.animate {
  opacity: 1;
  transform: translateY(0);
}

.dropdown-menu {
  right: 0 !important;
  left: auto !important;
}

.sidebar-icons i {
  font-size: 1.5rem;
  color: #6c757d;
  cursor: pointer;
  transition: color 0.2s;
}

.sidebar-icons i:hover {
  color: #000;
}


</style>
  
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <img src="img/logo.png" width="60" alt="Logo" class="mb-4">
  
  <div class="sidebar-icons d-flex flex-column align-items-center gap-4 w-100">
    <a href="index.php"><i class="bi bi-house-door-fill" title="Beranda"></i></a>
    <i class="bi bi-search" id="sidebarSearch" title="Cari"></i>

    
    <?php if ($username): ?>
      <i class="bi bi-plus-circle" title="Tambah" data-bs-toggle="modal" data-bs-target="#tambahFoto"></i>
    <?php else: ?>
      <i class="bi bi-plus-circle" title="Tambah" id="btnTambahFoto"></i>
    <?php endif; ?>
  </div>
  
  <!-- Avatar -->
  <div class="mt-auto mb-3 text-center">
    <?php if ($username): ?>
      <a href="profil.php">
        <img src="<?php echo $avatar ? 'uploads/avatars/' . htmlspecialchars($avatar) : 'asset/kosong.jpg'; ?>" class="avatar-img" alt="Avatar">
      </a>
      <div class="user-profile mt-1">
        <small class="fw-bold"><?= htmlspecialchars($username); ?></small>
      </div>
    <?php else: ?>
      <a href="login.php" title="Masuk">
        <i class="bi bi-box-arrow-in-right" style="font-size: 1.8rem;"></i>
      </a>
    <?php endif; ?>
  </div>
</div>

<!-- Main Content -->
<div class="main-content">


<!-- Search Bar -->
<div class="search-bar">
  <div class="container-fluid">
    <form method="GET" action="" id="searchForm">
      <div class="input-group">
        <input type="text" class="form-control search-input" name="q" placeholder="Cari inspirasi..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
        <button class="btn btn-outline-secondary" type="submit">
       <i class="bi bi-search"></i>


        </button>
      </div>
    </form>

    <?php if (!empty($_GET['q'])): ?>
      <p class="mt-2"><small>Menampilkan hasil untuk: <strong><?= htmlspecialchars($_GET['q']) ?></strong></small></p>
    <?php endif; ?>
  </div>
</div>



  <!-- Masonry Grid -->
  <div class="container py-4">
    <div class="masonry">
      <?php
$search = isset($_GET['q']) ? mysqli_real_escape_string($con, $_GET['q']) : '';
$query = $search
    ? "SELECT * FROM photo WHERE description LIKE '%$search%' ORDER BY upload_time DESC"
    : "SELECT * FROM photo ORDER BY upload_time DESC";
$result = mysqli_query($con, $query);

while ($photo = mysqli_fetch_assoc($result)) {
    echo '<div class="masonry-item position-relative">';
    echo '<img src="uploads/' . $photo['file_name'] . '" alt="' . htmlspecialchars($photo['description'] ?? '') . '">';
    echo '<div class="position-absolute top-0 end-0 p-2">';
    echo '<div class="dropdown">';
    echo '<button class="btn btn-transparent btn-sm" type="button" data-bs-toggle="dropdown">';
    echo '<i class="bi bi-three-dots-vertical"></i>';
    echo '</button>';
    echo '<ul class="dropdown-menu">';
    echo '<li><a class="dropdown-item" href="detail.php?file_name=' . urlencode($photo['file_name']) . '">Lihat Detail</a></li>';
    echo '<a class="dropdown-item" href="download.php?file=' . urlencode($photo['file_name']) . '">Unduh</a>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>

    </div>
  </div>

</div>

      <!-- Modal Tambah Foto -->
 <!-- Modal ini muncul ketika pengguna yang telah login mengklik ikon tambah. Formulir di dalam modal memungkinkan pengguna untuk mengunggah foto baru dengan deskripsi. -->
 <?php if ($username): ?>
 <div class="modal fade" id="tambahFoto" tabindex="-1" aria-labelledby="tambahFotoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 shadow-lg">
      <div class="modal-header text-white" style="background-color: #e91e63;">
        <h5 class="modal-title" id="tambahFotoLabel">Tambah Foto Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="description" name="description" required>
          </div>
          <div class="mb-3">
            <label for="file" class="form-label">Pilih Foto</label>
            <input type="file" class="form-control" id="file" name="file" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-pink rounded-3">Tambah Foto</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll(".masonry-item");
    items.forEach((item, index) => {
      setTimeout(() => {
        item.classList.add("animate");
      }, index * 35); // jeda antar gambar 35ms
    });
  });
</script>


<script>
  //  Script ini memastikan bahwa jika pengguna belum login dan mengklik ikon tambah, mereka akan diarahkan ke halaman login.
  // Redirect ke login jika belum login dan klik tombol tambah
  document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("btnTambahFoto");
    if (btn) {
      btn.addEventListener("click", function () {
        window.location.href = "login.php";
      });
    }
  });

  
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const sidebarSearch = document.getElementById("sidebarSearch");
    const searchForm = document.getElementById("searchForm");

    if (sidebarSearch && searchForm) {
      sidebarSearch.addEventListener("click", function () {
        searchForm.scrollIntoView({ behavior: "smooth", block: "center" });
        const input = searchForm.querySelector("input[name='q']");
        if (input) {
          input.focus();
        }
      });
    }
  });
</script>




</script>
</body>
</html>
