<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "buku_tamu";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Gagal koneksi : ". mysqli_connect_error());
}
$koneksi = mysqli_connect("localhost", "root", "", "buku_tamu");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
?>