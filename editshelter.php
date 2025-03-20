<?php
include 'koneksi.php';

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM shelter WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

// Update data jika tombol "Simpan Perubahan" ditekan
if (isset($_POST['update'])) {
    $nama_hewan = $_POST['nama_hewan'];
    $umur = $_POST['umur'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi_shelter = $_POST['lokasi_shelter'];

    $stmt = $conn->prepare("UPDATE shelter SET nama_hewan=?, umur=?, deskripsi=?, lokasi_shelter=? WHERE id=?");
    $stmt->bind_param("sissi", $nama_hewan, $umur, $deskripsi, $lokasi_shelter, $id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: shelter.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Hewan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Hewan</h2>
        <form method="POST">
            <div class="mb-3">
                <label>ID Hewan</label>
                <input type="text" class="form-control" value="<?= $data['id']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label>Nama Hewan</label>
                <input type="text" name="nama_hewan" class="form-control" value="<?= htmlspecialchars($data['nama_hewan']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Umur (tahun)</label>
                <input type="number" name="umur" class="form-control" value="<?= $data['umur']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
            </div>
            <div class="mb-3">
                <label>Lokasi Shelter</label>
                <input type="text" name="lokasi_shelter" class="form-control" value="<?= htmlspecialchars($data['lokasi_shelter']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
            <a href="shelter.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
