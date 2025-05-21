<?php
include 'config/koneksi.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password != $password_confirm) {
    echo "Password dan Konfirmasi Password tidak cocok.";
    exit();
}

// Enkripsi password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user baru dengan role 'user'
$query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', 'user')";
$result = mysqli_query($con, $query);

if ($result) {
    header('Location: login.php');
} else {
    echo "Pendaftaran gagal.";
}
?>
