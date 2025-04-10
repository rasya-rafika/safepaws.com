<?php
include "layouts/header.php";
include "koneksi.php"; // Pastikan file koneksi ini sesuai

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link = $_POST['link'];

    // Upload gambar
    $namaFile = $_FILES['logo']['name'];
    $tmpFile = $_FILES['logo']['tmp_name'];
    $uploadDir = "uploads/";
    $targetFile = $uploadDir . basename($namaFile);

    if (move_uploaded_file($tmpFile, $targetFile)) {
        $query = "INSERT INTO artikel (judul, deskripsi, logo, link) VALUES ('$judul', '$deskripsi', '$namaFile', '$link')";
        mysqli_query($conn, $query);

        echo "<script>alert('Artikel berhasil ditambahkan!'); window.location='artikel.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupload gambar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Artikel - SafePaws+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #00695C;
            color: white;
        }
        .form-container {
            background-color: white;
            color: #004D40;
            border-radius: 15px;
            padding: 40px;
            margin-top: 60px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .btn-submit {
            background-color: #00897B;
            color: white;
            border: none;
        }
        .btn-submit:hover {
            background-color: #00695C;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">Tambah Artikel Edukasi</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Link Artikel (URL)</label>
                <input type="url" name="link" class="form-control" placeholder="https://contoh.com/artikel" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Logo/Gambar</label>
                <input type="file" name="logo" class="form-control" accept="image/*" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-submit px-4">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php include "layouts/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
