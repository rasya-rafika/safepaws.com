<?php
session_start();
include 'koneksi.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM adopsi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adopsi Hewan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f0fdfa;
        }
        .btn-teal {
            background-color: #14b8a6;
            color: white;
            border: none;
        }
        .btn-teal:hover {
            background-color: #0d9488;
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
        }
        .text-teal {
            color: #0f766e;
        }
        .dropdown-toggle::after {
            display: none;
        }
        .dropdown-toggle.custom-toggle {
            font-size: 18px;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.4);
            border: none;
            padding: 6px 10px;
            border-radius: 50%;
        }
        .dropdown-toggle.custom-toggle:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <script>
        alert("Form berhasil dikirim! Terima kasih telah mengajukan permohonan adopsi. Jika pemilik hewan menyetujui permohonan Anda, mereka akan menghubungi Anda.");
    </script>
<?php endif; ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-teal">🐾 Daftar Hewan untuk Diadopsi</h2>
        <a href="tambahhewan.php" class="btn btn-teal">+ Tambah Hewan</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 position-relative">

                     <!-- untuk cek sesi login user -->  
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id']): ?>
                <div class="dropdown position-absolute top-0 end-0 m-2">
                    <button class="dropdown-toggle custom-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="editadopsi.php?id=<?= $row['id']; ?>">✏️ Edit</a></li>
                        <li><a class="dropdown-item text-danger" href="hapusadopsi.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</a></li>
                    </ul>
                </div>
            <?php endif; ?>


                        <img src="uploads/<?= htmlspecialchars($row['foto']); ?>" class="card-img-top" alt="Hewan" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-capitalize text-dark"><?= htmlspecialchars($row['nama']); ?></h5>

                            <table class="table table-borderless mb-3" style="font-size: 0.95rem;">
                                <tr>
                                    <td class="fw-bold text-start" style="width: 40%;">Umur</td>
                                    <td class="text-start">: <?= htmlspecialchars($row['usia']); ?> bulan</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-start">Jenis Kelamin</td>
                                    <td class="text-start">: <?= htmlspecialchars($row['jenis_kelamin']); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-start">Kategori</td>
                                    <td class="text-start">: <?= htmlspecialchars($row['kategori']); ?></td>
                                </tr>
                            </table>

                            <div class="mb-3">
                                <p class="fw-bold mb-1">Deskripsi:</p>
                                <p class="mb-0" style="font-size: 0.95rem; line-height: 1.6;"><?= nl2br(htmlspecialchars($row['deskripsi'])); ?></p>
                            </div>

                            <div class="text-end mt-auto">
                                <a href="formadopsi.php" class="btn btn-teal text-white">Adopsi</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">Belum ada hewan untuk diadopsi.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
