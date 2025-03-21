<?php
include 'koneksi.php';
header('Content-Type: application/json');

$query = "SELECT nama, COALESCE(rating, 0) AS rating FROM dokter"; // Paksa NULL jadi 0
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        "nama" => $row["nama"],
        "rating" => (float)$row["rating"] // Pastikan rating dikonversi ke float
    ];
}

// Cek apakah JSON berhasil dibuat
$json_data = json_encode($data);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_last_error_msg(); // Print error jika encoding gagal
    exit;
}

echo $json_data;
exit;
?>