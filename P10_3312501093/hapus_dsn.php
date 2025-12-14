<?php
// include database connection file
include 'koneksi.php';
$nik = $_GET['nik'];
$result = mysqli_query($koneksi, "DELETE FROM dosen WHERE nik='$nik'");
header("Location: dosen.php");
?>