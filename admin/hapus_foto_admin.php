<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$file_name = $_GET['file_name'] ?? '';

if (empty($file_name)) {
    header('Location: list_foto.php');
    exit();
}

// Gunakan prepared statement
$stmt = $con->prepare("SELECT * FROM photo WHERE file_name = ?");
$stmt->bind_param("s", $file_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $foto = $result->fetch_assoc();
    $file_path = '../uploads/' . $foto['file_name'];
    if (file_exists($file_path)) {
        unlink($file_path);  // Hapus file dari folder
    }

    // Hapus dari database
    $stmt_del = $con->prepare("DELETE FROM photo WHERE file_name = ?");
    $stmt_del->bind_param("s", $file_name);
    $stmt_del->execute();
}

header('Location: list_foto.php');
exit();
?>
