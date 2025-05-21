<?php
session_start();
include 'config/koneksi.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM photos WHERE user_id='$user_id'";
$result = mysqli_query($con, $query);
?>

<h2>Galeri Saya</h2>

<a href="upload_foto.php">Upload Foto Baru</a>

<div style="display: flex; flex-wrap: wrap;">
<?php
while ($photo = mysqli_fetch_assoc($result)) {
    echo "<div style='margin:10px;'>";
    echo "<img src='".htmlspecialchars($photo['photo_path'])."' width='150'><br>";
    echo htmlspecialchars($photo['caption'])."<br>";
    echo "<a href='hapus_foto.php?id=".$photo['photo_id']."' onclick=\"return confirm('Yakin hapus foto ini?')\">Hapus</a>";
    echo "</div>";
}
?>
</div>
