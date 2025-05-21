<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

include '../config/koneksi.php';

// Cek apakah method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        echo "Semua field harus diisi!";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query insert user baru
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";
    $result = mysqli_query($con, $query);

    if ($result) {
        header('Location: admin_dashboard.php?status=success');
        exit();
    } else {
        echo "Gagal menambah user.";
    }
} else {
    echo "Akses tidak valid.";
}
?>
