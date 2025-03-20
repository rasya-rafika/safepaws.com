<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafePaws+</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- SweetAlert2 CSS (Optional, buat notifikasi logout) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom Style -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">SafePaws+</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="#dokter">Dokter</a></li>
        <li class="nav-item"><a class="nav-link" href="#shelter">Shelter</a></li>
        <li class="nav-item"><a class="nav-link" href="#komunitas">Komunitas</a></li>
        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>

        <!-- Cek apakah user sudah login -->
        <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-item">
                <span class="nav-link">Halo, <?php echo $_SESSION['user']; ?>!</span>
            </li>
            <li class="nav-item">
                <!-- Logout pakai link supaya sejajar -->
                <a class="nav-link btn btn-danger text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Logout</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <!-- Tombol Login/Register -->
                <a class="nav-link btn btn-warning text-dark px-3" href="#" data-bs-toggle="modal" data-bs-target="#authModal">Login/Register</a>
            </li>
        <?php endif; ?>
    </ul>
</div>

    </div>
</nav>

<!-- MODAL LOGIN/REGISTER (Kalau mau taruh di header.php juga) -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">Masuk atau Daftar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
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

<!-- MODAL KONFIRMASI LOGOUT -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="logoutConfirmModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="logout.php" class="btn btn-danger">Ya, Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert Logout Notifikasi -->
<script>
    <?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Logout!',
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>
</script>
