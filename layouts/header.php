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

    <!-- SweetAlert2 CSS (Optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Inline Style -->
    <style>
        body {
            padding-top: 70px;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #008080 !important; /* TEAL */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link {
            color: #fff !important;
        }
        .nav-link:hover {
            color: #ffc107 !important;
        }
        footer {
            background-color: #004d4d; 
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
        }
        /* Pastikan tab login & register memiliki warna teks yang terlihat */
.nav-tabs .nav-link {
    color: black !important; /* Warna teks hitam agar selalu terlihat */
    font-weight: bold;
}

/* Warna tab aktif */
.nav-tabs .nav-link.active {
    color: white !important;  /* Saat aktif, warna teks jadi putih */
    background-color: #008080 !important; /* Warna TEAL agar kontras */
}

/* Saat hover */
.nav-tabs .nav-link:hover {
    color:rgba(38, 50, 39, 0.91) !important; /* Warna kuning saat hover */
}

    </style>
    
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
                <li class="nav-item"><a class="nav-link" href="index.php#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#dokter">Dokter</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#shelter">Shelter</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#komunitas">Komunitas</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#kontak">Kontak</a></li>

                <?php if (isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <span class="nav-link">Halo, <?= $_SESSION['user']; ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm ms-2 px-3" href="#" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning btn-sm ms-2 px-3 text-dark" href="#" data-bs-toggle="modal" data-bs-target="#authModal">Login/Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- MODAL LOGIN/REGISTER -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masuk atau Daftar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="authTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#loginForm">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-bs-toggle="tab" href="#registerForm">Register</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="loginForm">
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="registerForm">
                        <form method="POST" action="register.php">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
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

<!-- MODAL LOGOUT -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">Konfirmasi Logout</h5>
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
