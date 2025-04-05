<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: adopsi.php");
    exit();
}

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM adopsi WHERE id = $id")->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $usia = $_POST['usia'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $foto_lama = $_POST['foto_lama'];

    // Cek apakah ada file baru diupload
    if ($_FILES['foto']['name'] != '') {
        $foto_baru = time() . '_' . $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, 'uploads/' . $foto_baru);

        // Hapus foto lama
        if (file_exists('uploads/' . $foto_lama)) {
            unlink('uploads/' . $foto_lama);
        }
    } else {
        $foto_baru = $foto_lama; // Kalau tidak upload foto baru
    }

    $query = "UPDATE adopsi SET 
        nama='$nama', 
        usia='$usia', 
        jenis_kelamin='$jenis_kelamin', 
        kategori='$kategori', 
        deskripsi='$deskripsi',
        foto='$foto_baru'
        WHERE id=$id";

    if ($conn->query($query)) {
        header("Location: adopsi.php?msg=updated");
        exit();
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Adopsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        img.preview {
            max-height: 150px;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="text-teal mb-4">✏️ Edit Data Hewan</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Usia (tahun)</label>
            <input type="number" name="usia" class="form-control" value="<?= htmlspecialchars($data['usia']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Jantan" <?= $data['jenis_kelamin'] == 'Jantan' ? 'selected' : '' ?>>Jantan</option>
                <option value="Betina" <?= $data['jenis_kelamin'] == 'Betina' ? 'selected' : '' ?>>Betina</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="Kucing" <?= $data['kategori'] == 'Kucing' ? 'selected' : '' ?>>Kucing</option>
                <option value="Anjing" <?= $data['kategori'] == 'Anjing' ? 'selected' : '' ?>>Anjing</option>
                <option value="Hewan Lain" <?= $data['kategori'] == 'Hewan Lain' ? 'selected' : '' ?>>Hewan Lain</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Baru (opsional)</label>
            <input type="file" name="foto" class="form-control">
            <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">
            <img src="uploads/<?= $data['foto']; ?>" class="preview" alt="Foto saat ini">
        </div>
        <button type="submit" class="btn btn-teal">Simpan Perubahan</button>
        <a href="adopsi.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
