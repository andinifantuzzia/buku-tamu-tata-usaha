<?php
<<<<<<< HEAD
$host = "localhost";
$user = "root";
$pass = "";
$db = "akademik"; //Nama Database
// melakukan koneksi ke db
$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Gagal koneksi : ". mysqli_connect_error());
}
=======
$koneksi = mysqli_connect("localhost", "root", "", "buku_tamu");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
?>
>>>>>>> b163290a93ca4ea9ccee3051012b4331efc6065d
