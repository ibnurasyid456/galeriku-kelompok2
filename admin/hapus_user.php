<?php
include '../config/koneksi.php';

$user_id = $_GET['user_id'];

$query = "DELETE FROM users WHERE user_id='$user_id'";
$result = mysqli_query($con, $query);
 
if ($result) {
    header('Location: admin_dashboard.php');
} else {
    echo "Gagal menghapus user.";
}
?>
