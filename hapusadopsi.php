<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah data ada
    $cek = $conn->query("SELECT * FROM adopsi WHERE id = $id");
    if ($cek->num_rows > 0) {
        $data = $cek->fetch_assoc();
        $foto = $data['foto'];

        // Hapus data dari database
        $conn->query("DELETE FROM adopsi WHERE id = $id");

        // Hapus foto dari folder jika ada
        if (!empty($foto) && file_exists("uploads/$foto")) {
            unlink("uploads/$foto");
        }

        header("Location: adopsi.php?msg=sukses");
        exit();
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
