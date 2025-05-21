<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Ambil data pengguna
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

// Ambil foto milik user
$photo_query = "SELECT * FROM photo WHERE user_id = '$user_id' ORDER BY upload_time DESC";
$photo_result = mysqli_query($con, $photo_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil - GaleriKu</title>

  <!-- bootsrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- link cropper js -->
  <link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .btn-pink {
      background-color: #e91e63;
      color: white;
      border: none;
    }
    .profile-container {
      padding: 2rem;
    }
    .photo-gallery {
      column-count: 3;
      column-gap: 1rem;
    }
    .photo-gallery img {
      width: 100%;
      height: auto;
      border-radius: 1rem;
      display: block;
      margin-bottom: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .photo-gallery img:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }
    .photo-item {
      position: relative;
    }
    @media (max-width: 768px) {
      .photo-gallery {
        column-count: 2;
      }
    }
    @media (max-width: 576px) {
      .photo-gallery {
        column-count: 1;
      }
    }

    img.rounded-circle {
  object-fit: cover;
  border: 2px solid #dee2e6;
}

#avatar-input {
  display: none;
}

  </style>
</head>
<body>

<div class="container profile-container">
  <div class="row">
    <!-- Sidebar Profil -->
<div class="col-md-4 mb-4">
  <div class="card text-center">
    <div class="card-body">
      <?php
        $avatarPath = !empty($user['avatar']) ? 'uploads/avatars/' . htmlspecialchars($user['avatar']) : 'asset/kosong.jpg';
      ?>
      <img src="<?php echo $avatarPath; ?>" class="rounded-circle mb-1" width="120" height="120" alt="Avatar">
      <h5 class="card-title mt-2"><?php echo htmlspecialchars($user['username']); ?></h5>
      <p class="card-text mb-1">Email: <?php echo htmlspecialchars($user['email']); ?></p>
      <p class="card-text mb-1">Role: <?php echo htmlspecialchars($user['role']); ?></p>

      <!-- Form Upload Avatar -->

    <form action="upload_avatar.php" method="POST" enctype="multipart/form-data">
  
    <!-- crop avatar -->
    <input type="hidden" name="cropped_avatar" id="cropped-avatar">

    <!-- Tombol Edit Profile -->
    <button type="button" class="btn btn-sm btn-warning" id="edit-profile-btn">
    Edit Profile
    </button>
  

      <!-- Input File untuk Avatar (disembunyikan) -->
      <div id="file-input-container" style="display: none;" class="mt-1">
        <input type="file" name="avatar" accept="image/*" class="form-control mb-2">
        <button type="submit" class="btn btn-sm btn-primary">Simpan Avatar</button>
      </div>
    </form>


    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop Avatar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img id="cropper-image" style="max-width: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="crop-save">Simpan Crop</button>
      </div>
    </div>
  </div>
</div>



      <a href="logout.php" class="btn btn-outline-danger mt-3">Logout</a>
      <a href="beranda.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
  </div>
</div>


    <!-- Galeri Foto -->
    <div class="col-md-8">
      <h4 class="mb-3">Foto yang Diupload oleh Anda</h4>
      <div class="photo-gallery">
        <?php while ($photo = mysqli_fetch_assoc($photo_result)) : ?>
          <div class="photo-item">
            <img src="uploads/<?php echo htmlspecialchars($photo['file_name']); ?>" alt="<?php echo htmlspecialchars($photo['description'] ?? ''); ?>">
            <div class="position-absolute top-0 end-0 p-2">
              <a class="btn btn-sm btn-danger" href="hapus_foto.php?id=<?php echo urlencode($photo['file_name']); ?>" onclick="return confirm('Yakin ingin menghapus foto ini?')">Hapus</a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.getElementById('edit-profile-btn').addEventListener('click', function () {
    var container = document.getElementById('file-input-container');
    container.style.display = 'block';
  });

</script>

<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>

<script>
let cropper;
const avatarInput = document.querySelector('input[name="avatar"]');
const cropperImage = document.getElementById('cropper-image');
const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
const croppedAvatarInput = document.getElementById('cropped-avatar');

avatarInput.addEventListener('change', function (e) {
  const file = e.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (event) {
    cropperImage.src = event.target.result;
    cropModal.show();

    if (cropper) cropper.destroy();
    cropper = new Cropper(cropperImage, {
      aspectRatio: 1,
      viewMode: 1,
      autoCropArea: 1,
      movable: true,
      cropBoxResizable: true,
      zoomable: true,
    });
  };
  reader.readAsDataURL(file);
});

document.getElementById('crop-save').addEventListener('click', function () {
  const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });
  canvas.toBlob(function (blob) {
    const reader = new FileReader();
    reader.onloadend = function () {
      croppedAvatarInput.value = reader.result;
      cropModal.hide();
    };
    reader.readAsDataURL(blob);
  });
});
</script>


</body>
</html>
