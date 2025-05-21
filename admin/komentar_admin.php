<?php
session_start();
include '../config/koneksi.php';

// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kelola Komentar - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">GaleriKu Admin</a>
    <div class="d-flex">
      <span class="navbar-text me-3">
        <?php echo htmlspecialchars($_SESSION['username']); ?>
      </span>
      <a href="admin_dashboard.php" class="btn btn-danger btn-sm">Kembali</a>
      
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2 class="fw-bold mb-4">Semua Komentar User</h2>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Komentar</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
      $query = "SELECT comments.id, comments.content, comments.created_at, users.username FROM comments  JOIN users ON comments.user_id = users.user_id  ORDER BY comments.created_at DESC";

        $result = mysqli_query($con, $query);
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['content']) . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>

         <a href='hapus_komentar.php?id=" . urlencode($row['id']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus komentar ini?');\">Hapus</a>

                  </td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
