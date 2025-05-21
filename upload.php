<?php
include 'config/koneksi.php';
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

date_default_timezone_set('Asia/Makassar');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $desc = $_POST['description'];
    $file = $_FILES['file'];
    $user_id = $_SESSION['user_id'];
    $upload_time = date('Y-m-d H:i:s');

    if ($file['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Pastikan folder ada
        }

        $file_name = basename($file['name']);
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid('img_', true) . '.' . $file_ext;
        $target_file = $upload_dir . $new_file_name;

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            // Gunakan prepared statement
           $likes = 0; // default awal
            $stmt = mysqli_prepare($con, "INSERT INTO photo (user_id, description, upload_time, file_name, likes) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "isssi", $user_id, $desc, $upload_time, $new_file_name, $likes);


            if (mysqli_stmt_execute($stmt)) {
                echo "<meta http-equiv='refresh' content='1;url=beranda.php'>";
            } else {
                echo "Gagal menyimpan data di database. Error: " . mysqli_error($con);
            }
        } else {
            echo "Gagal memindahkan file.";
        }
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
    }
}
?>
