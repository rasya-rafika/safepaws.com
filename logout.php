<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Logout berhasil!'); window.location.href='index.php';</script>";
exit;
?>
