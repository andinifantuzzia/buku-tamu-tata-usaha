<?php
// include database connection file
include 'koneksi.php';
$nim = $_POST['nik'];
$nama = $_POST['nama'];
$jurusan = $_POST['alamat'];
$angkatan = $_POST['bagian'];
$result = mysqli_query($koneksi, "UPDATE dosen SET nama='$nama', alamat= '$alamat'
,jabatan $jabatan' WHERE nik='$nik'");
// Redirect to homepage to display updated user in list
header("Location: dosen.php");
?>