<?php
include 'koneksi.php'; // Panggil koneksi database

// Cek apakah form dikirim pakai POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Ambil data dari form
    $id_dokter = intval($_POST['id_dokter']); // Pastikan berupa angka integer
    $rating = intval($_POST['rating']);

    // Validasi rating (hanya boleh 1 sampai 5)
    if ($rating < 1 || $rating > 5) {
        die('Rating tidak valid!'); // Stop jika rating tidak benar
    }

    // 1️⃣ Masukkan rating baru ke tabel rating_dokter
    $insertQuery = "INSERT INTO rating_dokter (id_dokter, rating) VALUES ('$id_dokter', '$rating')";

    if (mysqli_query($conn, $insertQuery)) {
        
        // 2️⃣ Hitung rata-rata rating dari semua rating yang ada di rating_dokter
        $avgQuery = "SELECT AVG(rating) AS avg_rating FROM rating_dokter WHERE id_dokter = '$id_dokter'";
        $avgResult = mysqli_query($conn, $avgQuery);

        if ($avgRow = mysqli_fetch_assoc($avgResult)) {
            $newAvg = round($avgRow['avg_rating'], 1); // Dibulatkan 1 angka desimal, misal 4.8

            // 3️⃣ Update nilai rating di tabel dokter
            $updateDokter = "UPDATE dokter SET rating = '$newAvg' WHERE id_dokter = '$id_dokter'";
            mysqli_query($conn, $updateDokter);
        }

        // 4️⃣ Kembali ke halaman dokter.php setelah berhasil
        header("Location: dokter.php");
        exit;

    } else {
        // Kalau gagal insert rating
        echo "Gagal menyimpan rating!";
    }

} else {
    // Kalau file diakses langsung bukan dari form
    echo "Akses tidak valid!";
}
