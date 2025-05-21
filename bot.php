   
// Proses Hapus Komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment'])) {
    $comment_id = $_POST['comment_id'];

    // Pastikan file_name diterima dengan benar dari query parameter
    $file_name = $_GET['file_name'];

    // Siapkan query untuk menghapus komentar
    $stmt = mysqli_prepare($con, "DELETE FROM comments WHERE user_id = ?");
    if (!$stmt) {
        die('Query preparation failed: ' . mysqli_error($con));
    }

    // Bind parameter dan eksekusi
    mysqli_stmt_bind_param($stmt, "i", $comment_id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: detail.php?file_name=" . urlencode($file_name));  // Redirect ke halaman detail foto
        exit;
    } else {
        echo "Error: " . mysqli_error($con);  // Menampilkan error jika query gagal
    }
}
   
   <!-- Tombol Hapus -->
      <!-- <form method="POST" style="display:inline;">
        <input type="hidden" name="comment_id" value="<?= $comment['user_id'] ?>">
        <button type="submit" name="delete_comment" class="btn btn-danger btn-sm mt-2">
          <i class="bi bi-trash">Hapus</i>
        </button>
      </form> -->


      like Baru

      // Cek apakah user sudah like sebelumnya
$check = mysqli_prepare($con, "SELECT 1 FROM photo_likes WHERE user_id = ? AND file_name = ?");
mysqli_stmt_bind_param($check, "is", $_SESSION['user_id'], $file_name);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);

if (mysqli_stmt_num_rows($check) === 0) {
    // Belum like, tambahkan like
    $stmt = mysqli_prepare($con, "UPDATE photo SET likes = likes + 1 WHERE file_name = ?");
    mysqli_stmt_bind_param($stmt, "s", $file_name);
    mysqli_stmt_execute($stmt);

    $insert_like = mysqli_prepare($con, "INSERT INTO photo_likes (user_id, file_name) VALUES (?, ?)");
    mysqli_stmt_bind_param($insert_like, "is", $_SESSION['user_id'], $file_name);
    mysqli_stmt_execute($insert_like);
}

<!-- 
tombol komen -->
<!-- <form method="post" class="mb-4">
  <div class="d-flex gap-2">
    <textarea name="comment" class="form-control rounded-4 shadow-sm border-1" rows="1" placeholder="Tulis komentar..."></textarea>
    <button type="submit" name="submit_comment" class="btn btn-primary rounded-pill px-4 shadow-sm">
      <i class="bi bi-send"></i>
    </button>
  </div>
</form> -->
