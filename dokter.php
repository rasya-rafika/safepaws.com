<?php include 'layouts/header.php'; ?>
<?php include 'koneksi.php'; 

// cek koneksi database
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
    #btnLihatGrafik {
      display: inline-block;
      margin: auto;
    }

</style>

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Dokter Hewan</h2>
    <p class="text-center">Pilih dokter hewan terbaik di sekitar Anda.</p>

    <!-- Filter Lokasi -->
    <div class="row mb-4">
        <div class="col-md-4 offset-md-4">
            <form method="GET" action="">
                <label for="lokasi" class="form-label">Pilih Lokasi:</label>
                <select class="form-select" name="lokasi" id="lokasi">
                    <option value="">Semua Lokasi</option>
                    <option value="Jakarta" <?= isset($_GET['lokasi']) && $_GET['lokasi'] == 'Jakarta' ? 'selected' : '' ?>>Jakarta</option>
                    <option value="Bandung" <?= isset($_GET['lokasi']) && $_GET['lokasi'] == 'Bandung' ? 'selected' : '' ?>>Bandung</option>
                    <option value="Surabaya" <?= isset($_GET['lokasi']) && $_GET['lokasi'] == 'Surabaya' ? 'selected' : '' ?>>Surabaya</option>
                    <option value="Bali" <?= isset($_GET['lokasi']) && $_GET['lokasi'] == 'Bali' ? 'selected' : '' ?>>Bali</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>
        </div>
    </div>

    <div class="row">
        <?php
        // ini buat ambil  lokasi yang dipilih pake GET
        $lokasiFilter = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

        // filter berdasarkan lokasi dalam persen itu nantii keganti sesuai lokasi yang dipilih di filternya
        if ($lokasiFilter) {
            $query = "SELECT * FROM dokter WHERE lokasi LIKE '%$lokasiFilter%'";
        } else {
            $query = "SELECT * FROM dokter";
        }

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $foto = 'asset/' . htmlspecialchars($row['foto']);
        ?>
        <!-- untuk munculin data dokternya -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="<?= $foto ?>" class="card-img-top" alt="Foto Dokter" style="height: 250px; object-fit: contain; background-color: #f8f8f8;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
                            <p class="card-text">Pengalaman: <strong><?= htmlspecialchars($row['pengalaman']) ?></strong> tahun</p>
                            <p class="card-text">Rating: <strong><?= number_format($row['rating'], 1) ?></strong> ⭐</p>
                            <p class="card-text">Lokasi: <strong><?= htmlspecialchars($row['lokasi']) ?></strong></p>
                        <div class="d-flex justify-content-end">
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ratingModal<?= $row['id_dokter'] ?>">
                          Beri Rating
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
                          <div class="mb-3">
                            <label class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($row['nama']) ?>" readonly>
                          </div>
                          <input type="hidden" name="id_dokter" value="<?= $row['id_dokter'] ?>">
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
<div id="wrapperBtnGrafik" class="text-center mt-4">
  <button id="btnLihatGrafik" class="btn btn-primary">Lihat Grafik</button>
</div>

<div id="chartContainer" class="mt-4 container" style="display: none;">
    <h2 class="text-center">Statistik Dokter</h2>
    <p class="text-center">Lihat grafik rating dokter</p>
    <canvas id="chartDokter"></canvas>

    <div class="text-center mt-3">
        <button id="downloadPdf" class="btn btn-success">Download PDF</button>
        <button id="btnTutupGrafik" class="btn btn-danger">Tutup Grafik</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/chartdokter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    const btnLihatGrafik = document.getElementById("btnLihatGrafik");
    const chartContainer = document.getElementById("chartContainer");
    const downloadBtn = document.getElementById("downloadPdf");
    const closeBtn = document.getElementById("btnTutupGrafik");

    btnLihatGrafik.addEventListener("click", function () {
      chartContainer.style.display = "block";
    btnLihatGrafik.style.display = "none"; // Sembunyikan atau tutp grafik
    });

    closeBtn.addEventListener("click", function () {
      chartContainer.style.display = "none";
      btnLihatGrafik.style.display = "inline-block"; // untuk munculin lagi
    });


    downloadBtn.addEventListener("click", function () {
        downloadBtn.style.display = "none";
        closeBtn.style.display = "none";

        html2canvas(chartContainer).then(canvas => {
            const imgData = canvas.toDataURL("image/png");
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
            pdf.save("grafik_dokter.pdf");

            // Tampilkan kembali tombol download nya 
            downloadBtn.style.display = "inline-block";
            closeBtn.style.display = "inline-block";
        });
    });
</script>


<?php include 'layouts/footer.php'; ?>