<?php
session_start();

// Cek apakah user sudah login dan apakah role-nya adalah 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // Jika tidak ada session 'role' atau bukan admin, arahkan ke halaman login
    header('Location: login.php');
    exit();
}  

include '../config/koneksi.php';  // Menyambungkan ke database
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - GaleriKu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .btn-pink {
      background-color: #e91e63;
      color: white;
    }
    .btn-pink:hover {
      background-color: #ff85c1;
      color: white;
    }
    .sidebar {
      min-height: 100vh;
      background-color: white;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    .table thead {
      background-color: #ffe0f0;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">GaleriKu Admin</a>
    <div class="d-flex">
      <span class="navbar-text me-3">
        <?php echo htmlspecialchars($_SESSION['username']); ?>
      </span>
      <a href="logout.php" class="btn btn-pink btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    
    <!-- Sidebar -->
    <nav class="col-md-2 d-none d-md-block sidebar p-3">
      <h6 class="fw-bold">Menu</h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="admin_dashboard.php">List Users</a>
          <a class="nav-link active" href="komentar_admin.php">List Komentar</a>
        </li>
      </ul>
    </nav>

    <!-- Main -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
      <!-- Daftar Semua Foto -->
      <h2 class="fw-bold mt-5" id="fotos">Daftar Semua Foto</h2>
      <div class="table-responsive">
        <table class="table table-striped table-bordered mt-3">
          <thead>
            <tr>
              <th>#</th>
              <th>Gambar</th>
              <th>Deskripsi</th>
              <th>Uploader</th>
              <th>Tanggal Upload</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT p.*, u.username FROM photo p  JOIN users u ON p.user_id = u.user_id ORDER BY upload_time DESC";
            $result = mysqli_query($con, $query);
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td><img src='../uploads/" . $row['file_name'] . "' width='100'></td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . $row['upload_time'] . "</td>";
              echo "<td><a href='hapus_foto_admin.php?file_name=" . urlencode($row['file_name']) . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus foto ini?');\">Hapus</a></td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
