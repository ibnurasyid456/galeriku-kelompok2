<?php
session_start();

// Menghapus session
session_unset();

// Menghancurkan session
session_destroy();

// Mengarahkan pengguna kembali ke halaman login setelah logout
header("Location: ../login.php");
exit();
?>
