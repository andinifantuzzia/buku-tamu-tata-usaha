<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id       = $_POST['id'];
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi']);
    $nohp     = mysqli_real_escape_string($koneksi, $_POST['nohp']);
    $tujuan   = mysqli_real_escape_string($koneksi, $_POST['tujuan']);

    $query = "UPDATE tbpengunjung SET
              nama='$nama',
              instansi='$instansi',
              nohp='$nohp',
              tujuan='$tujuan'
              WHERE id='$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil diupdate');
                window.location='dash.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal update data');
                history.back();
              </script>";
    }
}
?>
