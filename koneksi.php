<?php
$host = "localhost";
$user = "root"; // Default XAMPP user
$password = "";
$database = "safepaws_db";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil!";
}
?>