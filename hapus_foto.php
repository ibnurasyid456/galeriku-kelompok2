<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$file_name = $_GET['id'] ?? '';

// Cek apakah foto milik user
$query = "SELECT * FROM photo WHERE file_name = '$file_name' AND user_id = '$user_id'";
$result = mysqli_query($con, $query);

// proses hapus
if (mysqli_num_rows($result) === 1) {
    $file_path = 'uploads/' . $file_name;
    if (file_exists($file_path)) {
        unlink($file_path);
    }
    mysqli_query($con, "DELETE FROM photo WHERE file_name = '$file_name'");
}

header('Location: profil.php');
exit();
?>