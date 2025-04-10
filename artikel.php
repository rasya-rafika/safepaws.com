<?php include "layouts/header.php"; 
include 'koneksi.php'; // Koneksi ke database?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Artikel Edukasi - SafePaws+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #00695C;
            color: white;
        }
        .artikel-section {
            padding: 80px 0;
            text-align: center;
        }
        .artikel-card {
            background-color: white;
            color: #004D40;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            height: 100%;
            transition: transform 0.3s ease;
        }
        .artikel-card:hover {
            transform: translateY(-5px);
        }
        .artikel-card h5 {
            font-weight: bold;
        }
        .btn-artikel {
            background-color: #00897B;
            color: white;
            border: none;
        }
        .btn-artikel:hover {
            background-color: #00695C;
        }
        .btn-tambah {
            background-color: #004D40;
            color: white;
            margin-bottom: 40px;
        }
        .btn-tambah:hover {
            background-color: #00332C;
        }
        .artikel-logo {
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<section class="artikel-section">
    <div class="container">
        <h2 class="mb-4">Artikel Edukasi</h2>
        <p class="mb-4">Gabung dan pelajari berbagai hal penting tentang perawatan, penyelamatan, dan kesejahteraan hewan!</p>

        <!-- Tombol Tambah Artikel -->
        <div class="text-end mb-4">
            <a href="tambah_artikel.php" class="btn btn-tambah">+ Tambah Artikel</a>
        </div>

        <div class="row g-4">
            <!-- Artikel Statis -->
            <div class="col-md-4">
                <div class="artikel-card">
                    <img src="uploads/artikel1.jpg" alt="Makanan Kucing Logo" class="artikel-logo img-fluid">
                    <h5>Rekomendasi Makanan Kucing</h5>
                    <p>Temukan berbagai pilihan makanan kucing yang sehat, bergizi, dan sesuai kebutuhan nutrisi kucingmu.</p>
                    <a href="https://fokus.co.id/rekomendasi-makanan-kucing-yang-bagus" target="_blank" class="btn btn-artikel mt-3">Find Out More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="artikel-card">
                    <img src="uploads/artikel2.jpg" alt="Fakta Anjing Logo" class="artikel-logo img-fluid">
                    <h5>Fakta Tentang Anjing</h5>
                    <p>Ketahui berbagai fakta menarik tentang anjing, mulai dari sifatnya yang setia hingga kecerdasannya.</p>
                    <a href="https://www.anjingpedia.id/fakta-tentang-anjing/" target="_blank" class="btn btn-artikel mt-3">Find Out More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="artikel-card">
                    <img src="uploads/artikel3.jpg" alt="Tentang Kucing Logo" class="artikel-logo img-fluid">
                    <h5>Tentang Kucing</h5>
                    <p>Pelajari lebih jauh tentang karakteristik, kebiasaan, dan tips merawat kucing kesayanganmu.</p>
                    <a href="https://satriahewan.com/tentang-kucing/" target="_blank" class="btn btn-artikel mt-3">Find Out More</a>
                </div>
            </div>

            <!-- Artikel dari Database -->
            <?php 
            $query = "SELECT * FROM artikel ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-4">
                    <div class="artikel-card">
                        <img src="uploads/<?php echo htmlspecialchars($row['logo']); ?>" alt="Logo Artikel" class="artikel-logo img-fluid">
                        <h5><?php echo htmlspecialchars($row['judul']); ?></h5>
                        <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                        <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank" class="btn btn-artikel mt-3">Find Out More</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include "layouts/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
