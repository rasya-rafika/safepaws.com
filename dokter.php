<?php
include 'layouts/header.php';
include 'koneksi.php'; // Koneksi ke database

// Periksa koneksi database
if (!$conn) {
    die('<div class="alert alert-danger">Koneksi ke database gagal: ' . mysqli_connect_error() . '</div>');
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Dokter Hewan</h2>
    <p class="text-center">Pilih dokter hewan terbaik di sekitar Anda.</p>

    <div class="row">
        <?php
        // Ambil data dokter dari database
        $query = "SELECT * FROM dokter";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Cek apakah gambar ada
                $foto = !empty($row['foto']) ? 'uploads/' . htmlspecialchars($row['foto']) : 'assets/default-dokter.png';

                echo '
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="' . $foto . '" class="card-img-top" alt="Foto Dokter" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">' . htmlspecialchars($row['nama']) . '</h5>
                            <p class="card-text">Pengalaman: <strong>' . htmlspecialchars($row['pengalaman']) . '</strong> tahun</p>
                            <p class="card-text">Rating: <strong>' . number_format($row['rating'], 1) . '</strong> ⭐</p>
                            <div class="d-flex justify-content-between">
                                <a href="beri_rating.php?id=' . $row['id_dokter'] . '" class="btn btn-warning">Beri Rating</a>
                                <a href="lokasi_dokter.php?id=' . $row['id_dokter'] . '" class="btn btn-primary">Lihat Lokasi</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12"><p class="text-center text-muted">Belum ada data dokter.</p></div>';
        }
        ?>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
