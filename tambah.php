<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi']);
    $nohp     = mysqli_real_escape_string($koneksi, $_POST['nohp']);
    $tujuan   = mysqli_real_escape_string($koneksi, $_POST['tujuan']);

    $tanggal  = date('Y-m-d');
    $jamawal  = date('H:i:s');

    $query = "INSERT INTO tbpengunjung 
              (nama, instansi, nohp, tujuan, tanggal, jamawal)
              VALUES
              ('$nama', '$instansi', '$nohp', '$tujuan', '$tanggal', '$jamawal')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location='dash.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data');
                history.back();
              </script>";
    }
}
?>
