<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "safepaws_db");

// Inisialisasi pesan
$success = $error = "";

// Proses kirim form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $pesan = trim($_POST["pesan"]);

    // Validasi form
    if (empty($nama) || empty($email) || empty($pesan)) {
        $error = "Semua field wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";
    } else {
        // Simpan ke database
        $stmt = $koneksi->prepare("INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $pesan);
        if ($stmt->execute()) {
            $success = "Pesan berhasil dikirim!";
        } else {
            $error = "Gagal mengirim pesan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kontak Kami</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #a0e9e0, #d2f1f0);
      min-height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .wave-top {
      background: url('https://www.svgrepo.com/show/353682/wave-top.svg') no-repeat center top;
      background-size: cover;
      height: 120px;
    }

    .contact-container {
      background-color: #ffffff;
      border-radius: 15px;
      padding: 40px;
      max-width: 600px;
      margin: 150px auto 50px auto;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #00796b;
      font-weight: 600;
      text-align: center;
      margin-bottom: 30px;
    }

    .form-label {
      color: #00695c;
    }

    .btn-primary {
      background-color: #008080;
      border: none;
    }

    .btn-primary:hover {
      background-color: #006666;
    }

    .alert {
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <div class="wave-top"></div>

  <div class="contact-container">
    <h2>Hubungi Kami</h2>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama" id="nama" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required>
      </div>
      <div class="mb-3">
        <label for="pesan" class="form-label">Pesan</label>
        <textarea class="form-control" name="pesan" id="pesan" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
    </form>
  </div>

</body>
</html>
