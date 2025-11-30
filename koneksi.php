<?php
$koneksi = mysqli_connect("localhost", "root", "", "buku_tamu");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
?>
