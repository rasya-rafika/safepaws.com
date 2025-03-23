<?php
include 'layouts/header.php';
include 'koneksi.php'; // Koneksi ke database

// Periksa koneksi database
if (!$conn) {
    die('<div class="alert alert-danger">Koneksi ke database gagal: ' . mysqli_connect_error() . '</div>');
}
?>

<style>
    .modal-header {
        background-color: #f8f9fa;
    }
    .modal-title {
        font-weight: bold;
    }
    .form-label {
        font-weight: 500;
    }
    .form-select option {
        font-size: 1rem;
    }
    .btn-submit-rating {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000;
    }
    .btn-submit-rating:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #fff;
    }
</style>

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
                // Ambil nama file foto dari database
                $foto = 'asset/' . htmlspecialchars($row['foto']);
        ?>

                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                    <img src="<?= $foto ?>" class="card-img-top" alt="Foto Dokter"style="height: 250px; object-fit: contain; background-color: #f8f8f8;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
                            <p class="card-text">Pengalaman: <strong><?= htmlspecialchars($row['pengalaman']) ?></strong> tahun</p>
                            <p class="card-text">Rating: <strong><?= number_format($row['rating'], 1) ?></strong> ⭐</p>

                            <div class="d-flex justify-content-between">
                                <!-- Tombol Buat Buka Modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ratingModal<?= $row['id_dokter'] ?>">
                                    Beri Rating
                                </button>

                                <a href="lokasi_dokter.php?id=<?= $row['id_dokter'] ?>" class="btn btn-primary">Lihat Lokasi</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Beri Rating -->
                <div class="modal fade" id="ratingModal<?= $row['id_dokter'] ?>" tabindex="-1" aria-labelledby="ratingModalLabel<?= $row['id_dokter'] ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="beri_rating.php" method="POST">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ratingModalLabel<?= $row['id_dokter'] ?>">Beri Rating untuk <?= htmlspecialchars($row['nama']) ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                          <!-- Nama Dokter -->
                          <div class="mb-3">
                            <label class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($row['nama']) ?>" readonly>
                          </div>

                          <!-- Input Hidden buat id_dokter -->
                          <input type="hidden" name="id_dokter" value="<?= $row['id_dokter'] ?>">

                          <!-- Pilihan Rating -->
                          <div class="mb-3">
                            <label class="form-label">Pilih Rating (1-5)</label>
                            <select class="form-select" name="rating" required>
                              <option value="">⭐ -- Pilih Rating --</option>
                              <option value="1">⭐ 1 - Buruk</option>
                              <option value="2">⭐⭐ 2 - Cukup</option>
                              <option value="3">⭐⭐⭐ 3 - Baik</option>
                              <option value="4">⭐⭐⭐⭐ 4 - Sangat Baik</option>
                              <option value="5">⭐⭐⭐⭐⭐ 5 - Luar Biasa</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-submit-rating">Kirim Rating ⭐</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

        <?php
            }
        } else {
            echo '<div class="col-12"><p class="text-center text-muted">Belum ada data dokter.</p></div>';
        }
        ?>
    </div>
</div>
<!-- Tombol Lihat Grafik -->
<div class="text-center mt-4">
      <button id="btnLihatGrafik" class="btn btn-primary">Lihat Grafik</button>
    </div>

    <!-- Container Grafik (Awalnya Disembunyikan) -->
    <div id="chartContainer" class="mt-4" style="display: none;">
      <h2 class="text-center">Statistik Dokter</h2>
      <p class="text-center">Lihat grafik pengalaman dan rating dokter.</p>
      <canvas id="chartDokter"></canvas> <!-- Tempat menampilkan grafik -->

    <!-- Tombol Tutup Grafik -->
    <div class="text-center mt-3">
        <button id="btnTutupGrafik" class="btn btn-danger">Tutup Grafik</button>
    </div>
  
  </div>

</div>

<?php include 'layouts/footer.php'; ?>

<!-- Include Bootstrap JS (kalau belum ada di footer.php) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Tambahkan Chart.js -->
<script src="js/chart.js"></script>
<!-- Tambahkan Script Chart Dokter -->
<script src="js/chartdokter.js"></script>
<?php include 'layouts/footer.php'; ?>

<!-- Include Bootstrap JS (kalau belum ada di footer.php) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
