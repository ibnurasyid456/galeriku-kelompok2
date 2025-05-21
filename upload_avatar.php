<?php
session_start();
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cropped_avatar'])) {
    $user_id = $_SESSION['user_id'];
    $data = $_POST['cropped_avatar'];

    if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
        $data = substr($data, strpos($data, ',') + 1);
        $type = strtolower($type[1]);

        $data = base64_decode($data);
        $filename = uniqid() . '.' . $type;
        $filepath = 'uploads/avatars/' . $filename;

        file_put_contents($filepath, $data);
        mysqli_query($con, "UPDATE users SET avatar = '$filename' WHERE user_id = '$user_id'");
    }
    header('Location: profil.php');
    exit();
}
?>
