<?php 
// Aktifkan session
session_start();
// Ambil nilai session error
$error = $_SESSION['error'] ?? [];
// Ambil nilai dari session old untuk ditampilkan pada input
$old = $_SESSION['old'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - GaleriKu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('img/merahh.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background-color: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(8px);
      padding: 40px;
      border-radius: 20px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 0 20px rgba(0,0,0,0.15);
    }

    .login-container h2 {
      font-weight: bold;
      color:rgb(254, 0, 51);
    }

    .btn-pink {
      background-color:rgb(254, 0, 51);
      border: none;
    }

    .btn-pink:hover {
      background-color:rgb(254, 0, 51);
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2 class="mb-3 text-center">Selamat datang di GaleriKu</h2>
    <p class="text-muted text-center mb-4">Temukan dan bagikan inspirasi visual</p>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger py-2">
        <?php foreach ($error as $msg): ?>
            <p><?= $msg ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="register_proses.php" method="POST" class="mt-3">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?=$old['username'] ?? '' ?>"/>
        <?php if (isset($error['username'])): ?>
          <small class="text-danger"><?= $error['username'] ?></small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?=$old['email'] ?? '' ?>"/>
        <?php if (isset($error['email'])): ?>
          <small class="text-danger"><?= $error['email'] ?></small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
        <?php if (isset($error['password'])): ?>
          <small class="text-danger"><?= $error['password'] ?></small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirm" class="form-control">
        <?php if (isset($error['password_confirm'])): ?>
          <small class="text-danger"><?= $error['password_confirm'] ?></small>
        <?php endif; ?>
      </div>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-pink text-white">Daftar</button>
      </div>
    </form>
    <p class="text-center mt-3">
      Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold">Masuk</a>
    </p>
  </div>

  <?php
  // Menghapus session error dan old setelah form ditampilkan
  unset($_SESSION['error']);
  unset($_SESSION['old']);
  ?>
</body>
</html>
