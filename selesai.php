<?php
date_default_timezone_set('Asia/Jakarta');

include "koneksi.php";

$id = $_GET['id'];

// Ambil waktu sekarang REALTIME (format jam-menit)
$jamakhir = date("H:i");

// Update jam akhir
mysqli_query($koneksi, "UPDATE tbpengunjung SET jamakhir='$jamakhir' WHERE id='$id'");

header("Location: dash.php");
?>
