<?php

// memulai sesi
session_start();


?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GaleriKu - Temukan & Bagikan Foto Favoritmu</title>

    <!-- Mengimpor CSS dan Animasi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>

        /* GAYA kustom dengan CSS */
        body, html {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            z-index: 1050;
        }

        .hero-section {
            background: url('img/merahh.jpg') no-repeat center center/cover;
            min-height: 100vh;
            padding-top: 80px;
            color: white;
            position: relative;
            opacity: 0; /* Initially hidden */
            transform: translateY(20px); /* Slide down slightly */
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .hero-section.animate__animated {
            opacity: 1;
            transform: translateY(0);
        }

        .overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 6rem 2rem;
            text-align: center;
        }

        .btn-pink {
            background-color: rgb(254, 0, 51);
            color: white;
            border: none;
        }

        .btn-outline-pink {
            border: 2px solid rgb(254, 0, 51);
            color: rgb(254, 0, 51);
            background-color: white;
        }

        .btn-outline-pink:hover {
            background-color: rgb(254, 0, 51);
            color: white;
        }

        .gallery-preview {
            padding: 4rem 2rem;
            background-color: #f9f9f9;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out 0.3s, transform 1s ease-out 0.3s; /* Delay the start */
        }

        .gallery-preview.animate__animated {
            opacity: 1;
            transform: translateY(0);
        }

        .gallery-preview h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #333;
        }

        .gallery-preview img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .gallery-preview img:hover {
            transform: scale(1.03);
        }

        .about-us {
            padding: 4rem 2rem;
            background-color: #fff;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out 0.6s, transform 1s ease-out 0.6s; /* Further delay */
        }

        .about-us.animate__animated {
            opacity: 1;
            transform: translateY(0);
        }

        .about-us h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #333;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 2rem 0;
            opacity: 0;
            transition: opacity 1s ease-out 0.9s; /* Even further delay */
        }

        footer.animate__animated {
            opacity: 1;
        }

        footer a {
            color: rgb(254, 0, 51);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="animate__animated">
     
        <!-- Navbar dengan Opsi Login/Logout -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm position-fixed w-100">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="img/logo.png" alt="Logo" style="width: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav me-3">
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="beranda.php">Blog</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="beranda.php" class="btn btn-pink me-2">Beranda</a>';
                        echo '<a href="logout.php" class="btn btn-outline-pink">Keluar</a>';
                    } else {
                        echo '<a href="login.php" class="btn btn-pink me-2">Masuk</a>';
                        echo '<a href="register.php" class="btn btn-outline-pink">Daftar</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bagian ini menampilkan hero section dengan latar belakang gambar, overlay gelap untuk kontras teks, dan tombol "Explore" yang mengarahkan ke halaman beranda. -->
    <div class="hero-section d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container hero-content">
            <h1 class="display-4 fw-bold">Selamat Datang di GaleriKu</h1>
            <p class="lead mt-3">Temukan, unggah, dan bagikan inspirasi melalui foto-foto favoritmu!</p>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="beranda.php" class="btn btn-pink me-2">Explore</a>

            </div>
        </div>
    </div>

            <!-- informasi tentang platform GaleriKu dan mengajak pengunjung untuk mendaftar melalui tombol "Mulai Bergabung" -->
    <section class="about-us" id="tentang" >
        <div class="container">
            <h2>Tentang GaleriKu</h2>
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="img/landing pg.png" alt="Tentang GaleriKu" class="img-fluid rounded-4 shadow-sm">
                </div>
                <div class="col-md-6">
                    <p style="font-size: 1.1rem; color: #555;">
                        <strong>GaleriKu</strong> adalah platform berbagi foto modern yang menghubungkan para pecinta fotografi dari seluruh dunia.
                        Temukan karya-karya inspiratif, abadikan momen terbaikmu, dan ciptakan komunitas kreatif bersama kami!
                    </p>
                    <p style="font-size: 1.1rem; color: #555;">
                        Dengan GaleriKu, kamu tidak hanya berbagi foto, tapi juga berbagi cerita dan inspirasi untuk dunia. Yuk, bergabung sekarang!
                    </p>
                    <a href="register.php" class="btn btn-pink mt-3 px-4">Mulai Bergabung</a>
                </div>
            </div>
        </div>
    </section>


                    <!-- Galeri Populer dengan Carousel -->
    <section class="gallery-preview" id="blog">
        <div class="container">
            <h2>Galeri Populer</h2>
            <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <img src="img/1.jpg" alt="Gallery Image 1" class="img-fluid shadow-sm">
                            </div>
                            <div class="col-md-4">
                                <img src="img/2.jpg" alt="Gallery Image 2" class="img-fluid shadow-sm">
                            </div>
                            <div class="col-md-4">
                                <img src="img/3.jpg" alt="Gallery Image 3" class="img-fluid shadow-sm">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <img src="img/1.jpg" alt="Gallery Image 4" class="img-fluid shadow-sm">
                            </div>
                            <div class="col-md-4">
                                <img src="img/2.jpg" alt="Gallery Image 5" class="img-fluid shadow-sm">
                            </div>
                            <div class="col-md-4">
                                <img src="img/3.jpg" alt="Gallery Image 6" class="img-fluid shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>


            <!-- Footer dengan informasi tambahan -->
    <footer class="text-center animate__animated">
        <div class="container">
            <p class="mb-2">© <?=date('Y')?> GaleriKu. All rights reserved.</p>
            <p class="small">
                Dibuat dengan ❤️ oleh <a href="#">Tim GaleriKu</a> |
                <a href="#">Kebijakan Privasi</a> |
                <a href="#">Kontak</a>
            </p>
        </div>
    </footer>


    <!-- Script ini menambahkan kelas animasi dari Animate.css ke berbagai elemen saat halaman selesai dimuat, menciptakan efek transisi yang halus. -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hero = document.querySelector('.hero-section');
            const gallery = document.querySelector('.gallery-preview');
            const about = document.querySelector('.about-us');
            const footer = document.querySelector('footer');
            const body = document.body;

            if (body) {
                body.classList.add('animate__fadeIn');
            }
            if (hero) {
                hero.classList.add('animate__animated');
            }
            if (gallery) {
                gallery.classList.add('animate__animated');
            }
            if (about) {
                about.classList.add('animate__animated');
            }
            if (footer) {
                footer.classList.add('animate__animated');
            }
        });
    </script>

        <!-- Mengimpor JS BOOTSRTAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>