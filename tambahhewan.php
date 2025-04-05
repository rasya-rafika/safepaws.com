<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['usia'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $user_id = $_SESSION['user_id'];

    // Upload foto
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($foto_tmp, "uploads/$foto_name");

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO adopsi (nama, usia, jenis_kelamin, kategori, deskripsi, foto, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssi", $nama, $umur, $jenis_kelamin, $kategori, $deskripsi, $foto_name, $user_id);
    $stmt->execute();
    $stmt->close();

    header("Location: adopsi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Hewan Adopsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h2 class="mb-4">Tambah Hewan untuk Diadopsi</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama Hewan</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Umur (bulan)</label>
                <input type="number" name="usia" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Kucing">Kucing</option>
                    <option value="Anjing">Anjing</option>
                    <option value="Hewan Lain">Hewan Lain</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Hewan</label>
                <input type="file" name="foto" class="form-control" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
