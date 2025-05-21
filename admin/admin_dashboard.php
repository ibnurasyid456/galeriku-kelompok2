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
          <a class="nav-link" href="list_foto.php">Daftar Semua Foto</a>
        </li>
      </ul>
    </nav>

    <!-- Main -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 id="users" class="fw-bold">List Semua User</h2>
        <button class="btn btn-pink" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambah User</button>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM users";
            $result = mysqli_query($con, $query);
            $no = 1;
            while ($user = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                echo "<td>" . htmlspecialchars($user['role']) . "</td>";
                echo "<td>
                        <a href='hapus_user.php?user_id=" . $user['user_id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus user ini?');\">Hapus</a>
                      </td>";
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      
    </main>
  </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 shadow-lg">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="tambahUserLabel">Tambah User Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="tambah_user.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control rounded-3" id="username" name="username" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control rounded-3" id="email" name="email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control rounded-3" id="password" name="password" required>
          </div>

          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select rounded-3" id="role" name="role" required>
              <option value="">-- Pilih Role --</option>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-pink rounded-3">Tambah User</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
