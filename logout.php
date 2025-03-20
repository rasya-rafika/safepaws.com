<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
echo "<script>alert('Logout berhasil!'); window.location.href='index.php';</script>";
?>
