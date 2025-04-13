<?php
session_start();
include 'koneksi.php'; // Pastikan ada koneksi ke database

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // buat supaya pass jadi enskripsi 

    // Periksa username atau email sudah terdaftar blm
    $checkUser = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username atau email sudah digunakan!'); window.location.href='index.php';</script>";
    } else {
        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal!'); window.location.href='index.php';</script>";
        }
    }
}
?>
