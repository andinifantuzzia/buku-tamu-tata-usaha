<?php 
include "koneksi.php";
date_default_timezone_set('Asia/Jakarta');

$hasil = "";
$dataSiapKirim = false;

// ================== PROSES SIMPAN (TOMBOL SIMPAN) ==================
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['simpan'])) {

    $name     = htmlspecialchars(trim($_POST['name']), ENT_QUOTES);
    $instansi = htmlspecialchars(trim($_POST['instansi']), ENT_QUOTES);
    $contact  = htmlspecialchars(trim($_POST['contact']), ENT_QUOTES);
    $purpose  = htmlspecialchars(trim($_POST['purpose']), ENT_QUOTES);

    $tanggal = date("Y-m-d");
    $jam     = date("H:i");

    // Data sementara untuk preview
    $hasil = [
        "Nama"        => $name,
        "Instansi"    => $instansi,
        "Kontak"      => $contact,
        "Tujuan"      => $purpose,
        "Tanggal"     => $tanggal,
        "Jam Masuk"   => $jam
    ];

    $dataSiapKirim = true;
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['selesai'])) {

    $nama     = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $nohp     = $_POST['kontak'];
    $tujuan   = $_POST['tujuan'];
    $tanggal  = $_POST['tanggal'];
    $jamawal  = $_POST['jam_masuk'];
    $jamakhir = date("H:i");

    // Insert ke database
    $query = "INSERT INTO tbpengunjung (nama, instansi, nohp, tujuan, tanggal, jamawal, jamakhir)
              VALUES ('$nama', '$instansi', '$nohp', '$tujuan', '$tanggal', '$jamawal', '$jamakhir')";
    mysqli_query($koneksi, $query);

    // Setelah selesai simpan → redirect ke dash.php
    header("Location: dash.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku Tamu Digital</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: url('WhatsApp Image 2025-10-13 at 09.08.59_8e646cf4.jpg') no-repeat center/cover;
        }
        .layout {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 175px;
        }
        .form-container {
            width: 380px;
            padding: 25px;
            background: rgba(25, 98, 167, 0.85);
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(247, 240, 240, 1);
        }
        .hasil-box {
            width: 350px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            line-height: 1.6;
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- FORM INPUT -->
    <div class="form-container">

        <div class="text-center mb-3">
            <img src="logo_poltek-removebg-preview.png" alt="Logo" class="img-fluid" style="max-width:100px;">
        </div>

        <h3 class="text-center mb-4" style="color: white;">Buku Tamu Digital</h3>

        <form method="POST">
            <input type="text" name="name" class="form-control mb-3" placeholder="Nama" required>
            <input type="text" name="instansi" class="form-control mb-3" placeholder="Instansi" required>
            <input type="text" name="contact" class="form-control mb-3" placeholder="No Kontak" required>
            <input type="text" name="purpose" class="form-control mb-3" placeholder="Tujuan Kunjungan" required>

            <button type="submit" name="simpan"
                class="w-100 fw-bold btn btn-primary">
                Simpan
            </button>
        </form>
    </div>

    <!-- PREVIEW HASIL -->
    <?php if (!empty($hasil)): ?>
        <div class="hasil-box">
            <h5>Data Tamu</h5>

            <?php foreach ($hasil as $key => $value): ?>
                <?= "$key: $value<br>" ?>
            <?php endforeach; ?>

            <!-- TOMBOL SELESAI (INSERT KE DB + jam keluar otomatis) -->
            <?php if ($dataSiapKirim): ?>
                <form method="POST" class="mt-3">

                    <input type="hidden" name="nama" value="<?= $hasil['Nama'] ?>">
                    <input type="hidden" name="instansi" value="<?= $hasil['Instansi'] ?>">
                    <input type="hidden" name="kontak" value="<?= $hasil['Kontak'] ?>">
                    <input type="hidden" name="tujuan" value="<?= $hasil['Tujuan'] ?>">
                    <input type="hidden" name="tanggal" value="<?= $hasil['Tanggal'] ?>">
                    <input type="hidden" name="jam_masuk" value="<?= $hasil['Jam Masuk'] ?>">

                    <button type="submit" name="selesai" class="btn btn-success w-100 fw-bold">
                        Selesai
                    </button>
                </form>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
