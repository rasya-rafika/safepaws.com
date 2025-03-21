<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "safepaws_db";

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Kalo berhasil, gak perlu echo di sini (supaya gak ganggu layout di page lain)
// echo "Koneksi berhasil!";
?>
