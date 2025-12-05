<?php
include "koneksi.php";

if (isset($_POST['submit'])) {

    $nama      = $_POST['nama'];
    $instansi  = $_POST['instansi'];
    $nohp      = $_POST['nohp'];
    $tujuan    = $_POST['tujuan'];

    // Waktu realtime saat tombol SIMPAN diklik
    date_default_timezone_set('Asia/Jakarta');
    $tanggal   = date('Y-m-d');
    $jamawal   = date('H:i'); // realtime detik juga

    $query = "INSERT INTO tbpengunjung (nama, instansi, nohp, tujuan, tanggal, jamawal)
              VALUES ('$nama', '$instansi', '$nohp', '$tujuan', '$tanggal', '$jamawal')";

    mysqli_query($koneksi, $query);

    header("Location: dash.php");
    exit();
}
?>
