<?php include "layouts/header.php" ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws+</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Warna Navbar */
        .navbar {
            background-color: #008080 !important; /* TEAL */
        }
        .navbar .nav-link {
            color: white !important;
        }
        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }
        
       /* HERO SECTION */
#hero {
    background: linear-gradient(to bottom, #B2DFDB, #E0F7FA); /* Light Teal to Soft Blue */
    color: #004D4D; /* Dark Teal */
    text-shadow: none;
    padding: 100px 0;
    text-align: center;
}

/* Warna Judul "Selamat Datang" */
#hero h1 {
    font-size: 2.8rem;
    font-weight: bold;
    color: #00695C; /* Deep Teal */
}

/* Warna Subjudul */
#hero p {
    font-size: 1.3rem;
    color: #00796B; /* Darker Teal */
}

        /* Section Styling */
        section {
            padding: 60px 0;
        }
       /* Warna Background Setiap Section */
#tentang {
    background-color: #E0F7FA; /* Soft Light Blue */
}
#dokter {
    background-color: #B2DFDB; /* Light Teal */
}
#shelter {
    background-color: #80CBC4; /* Medium Teal */
}

#komunitas {
    background: linear-gradient(120deg, #004D4D, #008080); /* Dark Gradient */
    color: white;
}


#kontak {
    background:: #B2DFDB; /* Light Teal */
    color:#008080;
}

/* Footer */
footer {
    background-color: #004d4d; 
    color: white;
    padding: 15px 0;
    text-align: center;
}

/* Button Styling */
.btn {
    padding: 10px 20px;
    font-size: 1.1rem;
    border-radius: 25px;
}
.btn-primary {
    background-color: #00796B !important; /* Darker Teal */
    border: none;
}
.btn-success {
    background-color: #00838F !important; /* Soft Blue */
    border: none;
}
.btn-warning {
    background-color: #00796B !important; /* Teal */
    border: none;
    color: white !important; /* Ubah warna tulisan jadi putih */
}
.btn-primary:hover, .btn-success:hover, .btn-warning:hover {
    opacity: 0.8;
}

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}
    </style>
</head>
<body>
    <!-- Modal Login/Register -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">Masuk atau Daftar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="authTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#loginForm">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#registerForm">Register</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3">
                    <!-- Form Login -->
                    <div class="tab-pane fade show active" id="loginForm">
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>

                    <!-- Form Register -->
                    <div class="tab-pane fade" id="registerForm">
                        <form method="POST" action="register.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- HERO SECTION -->
    <header id="hero" class="text-center d-flex align-items-center vh-100">
        <div class="container">
            <h1>Selamat Datang di SafePaws+</h1>
            <p>Platform konsultasi dokter hewan dan adopsi hewan peliharaan</p>
            <a href="#dokter" class="btn btn-primary">Cari Dokter</a>
            <a href="#shelter" class="btn btn-success">Adopsi Hewan</a>
        </div>
    </header>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="bg-light text-center">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p> Di SafePaws+, kami berkomitmen memberikan perawatan terbaik untuk hewan kesayangan Anda. Dengan tim dokter hewan berpengalaman dan fasilitas modern, kami siap menangani pemeriksaan rutin, vaksinasi, hingga perawatan medis kompleks.  
                  Kami memahami betapa berharganya hewan peliharaan dalam hidup Anda. Karena itu, kami menghadirkan layanan penuh kasih sayang dan berbasis ilmu pengetahuan untuk memastikan sahabat berbulu Anda sehat dan bahagia. ❤️</p>
        </div>
    </section>

    <!-- DOKTER -->
    <section id="dokter" class="text-center">
        <div class="container">
            <h2>Dokter Hewan</h2>
            <p>Kami menyediakan layanan untuk mencari dokter hewan terbaik di sekitar Anda.</p>
            <a href="dokter.php" class="btn btn-primary">Lihat Dokter</a>
        </div>
    </section>

    <!-- SHELTER -->
    <section id="shelter" class="bg-light text-center">
        <div class="container">
            <h2>Adopsi Hewan</h2>
            <p>Temukan hewan peliharaan yang menunggu untuk diadopsi.</p>
            <a href="shelter.php" class="btn btn-success">Lihat Shelter</a>
        </div>
    </section>

        <!-- KOMUNITAS -->
    <section id="komunitas" class="text-center">
        <div class="container">
            <h2>Komunitas</h2>
            <p>Bergabung dengan komunitas pecinta hewan dan berbagi pengalaman.</p>
            <a href="komunitas.php" class="btn btn-primary">Lihat Komunitas</a>
        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="text-center">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <p>Jika ada pertanyaan, jangan ragu untuk menghubungi kami.</p>
            <a href="kontak.php" class="btn btn-warning">Hubungi</a>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include "layouts/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
