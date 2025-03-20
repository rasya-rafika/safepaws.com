<?php
include 'koneksi.php';

// CREATE
if (isset($_POST['tambah'])) {
    $nama_hewan = $_POST['nama_hewan'];
    $deskripsi = $_POST['deskripsi'];
    $umur = $_POST['umur'];

    $sql = "INSERT INTO shelter (nama_hewan, deskripsi, umur) VALUES ('$nama_hewan', '$deskripsi', '$umur')";
    $conn->query($sql);
    header("Location: shelter.php");
}

// DELETE
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM shelter WHERE id=$id");
    header("Location: shelter.php");
}

// READ
$result = $conn->query("SELECT * FROM shelter");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Shelter Hewan</title>
</head>
<body>
    <h2>Tambah Hewan</h2>
    <form method="POST">
        <input type="text" name="nama_hewan" placeholder="Nama Hewan" required>
        <textarea name="deskripsi" placeholder="Deskripsi" required></textarea>
        <input type="number" name="umur" placeholder="Umur" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <h2>Daftar Hewan</h2>
    <table border="1">
        <tr>
            <th>Nama Hewan</th>
            <th>Deskripsi</th>
            <th>Umur</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['nama_hewan']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td><?= $row['umur']; ?> tahun</td>
            <td>
                <a href="edit_shelter.php?id=<?= $row['id']; ?>">Edit</a> | 
                <a href="shelter.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
