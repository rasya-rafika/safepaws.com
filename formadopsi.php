<?php
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $usia = $_POST['usia'];
    $pekerjaan = $_POST['pekerjaan'] === 'Lainnya' && isset($_POST['pekerjaan_lain']) ? $_POST['pekerjaan_lain'] : $_POST['pekerjaan'];
    $tipe_rumah = $_POST['tipe_rumah'];
    $tinggal_dengan = $_POST['tinggal_dengan'];
    $setuju_adopsi = $_POST['setuju_adopsi'];
    $pernah_merawat = $_POST['pernah_merawat'];
    $jenis_hewan_dulu = $_POST['jenis_hewan_dulu'];
    $alasan_adopsi = $_POST['alasan_adopsi'];
    $cara_merawat = $_POST['cara_merawat'];
    $komitmen1 = isset($_POST['komitmen1']) ? 1 : 0;
    $komitmen2 = isset($_POST['komitmen2']) ? 1 : 0;
    $komitmen3 = isset($_POST['komitmen3']) ? 1 : 0;

    $sql = "INSERT INTO form_adopsi (
        nama, alamat, no_hp, usia, pekerjaan, tipe_rumah, tinggal_dengan, setuju_adopsi,
        pernah_merawat, jenis_hewan_dulu, alasan_adopsi, cara_merawat, komitmen1, komitmen2, komitmen3
    ) VALUES (
        '$nama', '$alamat', '$no_hp', '$usia', '$pekerjaan', '$tipe_rumah', '$tinggal_dengan', '$setuju_adopsi',
        '$pernah_merawat', '$jenis_hewan_dulu', '$alasan_adopsi', '$cara_merawat', '$komitmen1', '$komitmen2', '$komitmen3'
    )";
    

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Form berhasil dikirim! 
            Terima kasih telah mengajukan permohonan adopsi. Jika pemilik hewan menyetujui permohonan Anda, mereka akan menghubungi Anda lebih lanjut melalui kontak yang telah Anda cantumkan. Mohon tunggu konfirmasi, ya!');
            window.location.href = 'adopsi.php';
        </script>";
        exit();  // Pastikan eksekusi PHP berhenti setelah pengalihan
    } else {
        echo "Error: " . $conn->error;
    }
    

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Adopsi Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
    .teal-text { color: #20c997; }
    .btn-teal { background-color: #20c997; color: white; }
    .btn-teal:hover { background-color: #17a589; }
    </style>
    
    <script>
        function toggleLainnya() {
            const pekerjaan = document.getElementById('pekerjaan');
            const pekerjaanLain = document.getElementById('pekerjaan_lain_wrap');
            pekerjaanLain.style.display = pekerjaan.value === 'Lainnya' ? 'block' : 'none';
        }
    </script>
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="card shadow-lg mx-auto" style="max-width: 720px;">
        <div class="card-body p-4">
            <h2 class="mb-1 text-center teal-text fw-bold">Formulir Adopsi Hewan</h2>
            <p class="text-center text-muted fst-italic mb-4">Harap diisi dengan jujur dan sesuai kondisi sebenarnya.</p>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Domisili</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP / WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <input type="number" name="usia" class="form-control" style="max-width: 120px;" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pekerjaan</label>
                    <select name="pekerjaan" id="pekerjaan" class="form-select" onchange="toggleLainnya()" required>
                        <option value="">-- Pilih --</option>
                        <option value="Pelajar">Pelajar</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Karyawan">Karyawan</option>
                        <option value="Freelancer">Freelancer</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="mb-3" id="pekerjaan_lain_wrap" style="display:none;">
                    <label class="form-label">Pekerjaan Lainnya</label>
                    <input type="text" name="pekerjaan_lain" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Tempat Tinggal</label>
                    <select name="tipe_rumah" class="form-select" required>
                        <option value="Rumah Sendiri">Rumah Sendiri</option>
                        <option value="Kontrakan">Kontrakan</option>
                        <option value="Kos">Kos</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Tinggal dengan orang lain?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tinggal_dengan" value="Ya" required>
                        <label class="form-check-label">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tinggal_dengan" value="Tidak" required>
                        <label class="form-check-label">Tidak</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Apakah mereka setuju kamu adopsi hewan?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="setuju_adopsi" value="Ya" required>
                        <label class="form-check-label">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="setuju_adopsi" value="Tidak" required>
                        <label class="form-check-label">Tidak</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Pernah merawat hewan?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pernah_merawat" value="Ya" required>
                        <label class="form-check-label">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pernah_merawat" value="Tidak" required>
                        <label class="form-check-label">Tidak</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jika ya, sebutkan jenis hewan & durasinya:</label>
                    <input type="text" name="jenis_hewan_dulu" class="form-control" placeholder="Contoh: Kucing, 2 tahun">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alasan ingin mengadopsi hewan</label>
                    <textarea name="alasan_adopsi" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bagaimana cara kamu merawat hewan tersebut?</label>
                    <textarea name="cara_merawat" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Komitmen:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="komitmen1" id="komitmen1">
                        <label class="form-check-label" for="komitmen1">Bersedia menanggung biaya perawatan hewan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="komitmen2" id="komitmen2">
                        <label class="form-check-label" for="komitmen2">Tidak akan menjual atau memindahkan hewan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="komitmen3" id="komitmen3">
                        <label class="form-check-label" for="komitmen3">Bersedia dikunjungi untuk evaluasi setelah adopsi</label>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-teal px-4 py-2 fw-bold">Kirim Pengajuan</button>
                </div>

                <script>
                document.querySelector("form").addEventListener("submit", function(e) {
                    //Validasi pekerjaan "Lainnya"
                    const pekerjaan = document.getElementById('pekerjaan').value;
                    const pekerjaanLain = document.querySelector('input[name="pekerjaan_lain"]').value.trim();
                    if (pekerjaan === 'Lainnya' && pekerjaanLain === '') {
                        alert('Silakan isi pekerjaan lainnya.');
                        e.preventDefault();
                        return;
                    }
                    
                    // Validasi "tinggal_dengan" dan "setuju_adopsi"
                    const tinggalDengan = document.querySelector('input[name="tinggal_dengan"]:checked');
                    const setujuAdopsi = document.querySelector('input[name="setuju_adopsi"]:checked');
                    if (!tinggalDengan) {
                        alert('Silakan pilih apakah kamu tinggal dengan orang lain.');
                        e.preventDefault();
                        return;
                    }
                    if (tinggalDengan.value === 'Ya' && !setujuAdopsi) {
                        alert('Silakan isi apakah orang yang tinggal denganmu setuju atau tidak.');
                        e.preventDefault();
                        return;
                    }
                    
                    // Validasi semua checkbox komitmen harus dicentang
                    const komitmen1 = document.getElementById('komitmen1').checked;
                    const komitmen2 = document.getElementById('komitmen2').checked;
                    const komitmen3 = document.getElementById('komitmen3').checked;
                    if (!(komitmen1 && komitmen2 && komitmen3)) {
                        alert('Harap centang semua komitmen sebelum mengirim form.');
                        e.preventDefault();
                        return;
                    }
                    });

                    const tinggalRadios = document.querySelectorAll('input[name="tinggal_dengan"]');
                    const setujuInputs = document.querySelectorAll('input[name="setuju_adopsi"]');
                    tinggalRadios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            if (this.value === 'Tidak') {
                                setujuInputs.forEach(input => {
                                    input.checked = false;
                                    input.disabled = true;
                                });
                            } else {
                                setujuInputs.forEach(input => input.disabled = false);
                            }
                        });
                    });
                </script>

            </form>
        </div>
    </div>
</div>

</body>
</html>