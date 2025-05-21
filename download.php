<?php


// memulai sesi
session_start();


if (!isset($_SESSION['username'])) {
    // Redirect ke login jika belum login
    header("Location: login.php");
    exit();
}


// Memeriksa Parameter File
if (!isset($_GET['file'])) {
    echo "File tidak ditemukan.";
    exit();
}

// Menentukan Jalur dan Memeriksa Keberadaan File
$file = basename($_GET['file']);
$filepath = "uploads/" . $file;

// proses pengunduhan
if (file_exists($filepath)) {

    // mengatur header untuk pengunduhan
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; file_name="' . $file . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath);
    exit();
} else {
    echo "File tidak ditemukan.";
    exit();
}
