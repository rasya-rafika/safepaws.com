<?php
include 'koneksi.php';

// CREATE
if (isset($_POST['tambah'])) {
    $nama_hewan = $_POST['nama_hewan'];
    $umur = $_POST['umur'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi_shelter = $_POST['lokasi_shelter'];

    $sql = "INSERT INTO shelter (nama_hewan, umur, deskripsi, lokasi_shelter) VALUES ('$nama_hewan', '$umur', '$deskripsi', '$lokasi_shelter')";
    $stmt->execute();
    $stmt->close();
    header("Location: shelter.php");
}

// DELETE
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM shelter WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: shelter.php");
}

// READ
$result = $conn->query("SELECT * FROM shelter");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Shelter Hewan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: teal;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        a button {
            padding: 10px 15px;
            border: none;
            background: teal;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }
        a button:hover {
            background: #006666;
        }
        .aksi a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 5px;
        }
        .edit {
            background: #007bff;
        }
        .hapus {
            background: #dc3545;
        }
        .edit:hover {
            background: #0056b3;
        }
        .hapus:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <h2>Daftar Hewan di Shelter</h2>
    <a href="tambahhewan.php"><button>Tambah Hewan</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Hewan</th>
            <th>Umur</th>
            <th>Deskripsi</th>
            <th>Lokasi Shelter</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['nama_hewan']); ?></td>
            <td><?= $row['umur']; ?> tahun</td>
            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
            <td><?= htmlspecialchars($row['lokasi_shelter']); ?></td>
            <td class="aksi">
                <a href="editshelter.php?id=<?= $row['id']; ?>" class="edit">Edit</a>
                <a href="shelter.php?hapus=<?= $row['id']; ?>" class="hapus" onclick="return confirm('Apakah anda yakin untuk hapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>