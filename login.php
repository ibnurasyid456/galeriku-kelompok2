<?php 
// Aktifkan session
session_start();

// Ambil nilai session error
$error = $_SESSION['login_error'] ?? '';
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

    <?php if ($error): ?>
      <div class="alert alert-danger py-2"><?= $error ?></div>
    <?php endif; ?>

    <form action="login_proses.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-pink text-white">Login</button>
      </div>
    </form>

    <p class="text-center mt-3">
      Belum punya akun? <a href="register.php" class="fw-bold text-decoration-none" style="color:#0000FF;">Daftar sekarang</a>
    </p>
    <p class="text-center">
     <u><a href="index.php" class="fw-bold text-decoration-none" style="color:	#000000;">Beranda</a></u>
  
    </p>
  </div>

  <?php
  // Menghapus session error setelah ditampilkan
  unset($_SESSION['login_error']);
  ?>
</body>
</html>
