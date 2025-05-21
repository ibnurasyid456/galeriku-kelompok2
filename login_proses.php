<?php
include 'config/koneksi.php';
session_start();
$username = $_POST['username'];
$password = $_POST['password'];


// Ambil data user dari database
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
  
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Cek role
        if ($user['role'] == 'admin') {
            header('Location: admin/admin_dashboard.php');
        } else {
            header('Location: beranda.php');
        }
        exit();
    } else {
        echo "Password salah.";
    }
} else {
    echo "Username tidak ditemukan.";
}
?>
