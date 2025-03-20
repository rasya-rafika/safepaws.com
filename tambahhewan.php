<?php
include 'koneksi.php';

// CREATE
if (isset($_POST['tambah'])) {
    $nama_hewan = $_POST['nama_hewan'];
    $umur = $_POST['umur'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi_shelter = $_POST['lokasi_shelter'];

    $stmt = $conn->prepare("INSERT INTO shelter (nama_hewan, umur, deskripsi, lokasi_shelter) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $nama_hewan, $umur, $deskripsi, $lokasi_shelter);
    $stmt->execute();
    $stmt->close();
    header("Location: shelter.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Hewan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 40%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            border: none;
            background: teal;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #006666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Hewan ke Shelter</h2>
        <form method="POST">
            <input type="text" name="nama_hewan" placeholder="Nama Hewan" required>
            <input type="number" name="umur" placeholder="Umur Hewan" required>
            <textarea name="deskripsi" placeholder="Deskripsi Hewan" required></textarea>
            <input type="text" name="lokasi_shelter" placeholder="Lokasi Shelter" required>
            <button type="submit" name="tambah">Tambah Hewan</button>
        </form>
        <br>
        <a href="shelter.php"><button>Kembali</button></a>
    </div>
</body>
</html>