<?php
$host = "localhost"; // Sesuaikan jika menggunakan server lain
$user = "root"; // Biasanya "root" untuk localhost
$pass = ""; // Kosongkan jika tidak ada password
$db = "safepaws_db"; // Nama database

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil!";
}
?>