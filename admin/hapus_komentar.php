<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}
if (isset($_GET['id'])) {
    $comment_id = intval($_GET['id']);
    mysqli_query($con, "DELETE FROM comments WHERE id = $comment_id");
}


header('Location: komentar_admin.php');
exit();
?>
