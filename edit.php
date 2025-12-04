<?php
include "koneksi.php";

if (isset($_POST['update'])) {

    $id       = $_POST['id'];
    $nama     = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $nohp     = $_POST['nohp'];
    $tujuan   = $_POST['tujuan'];

    $query = "UPDATE tbpengunjung SET 
                nama='$nama',
                instansi='$instansi',
                nohp='$nohp',
                tujuan='$tujuan'
              WHERE id='$id'";

    mysqli_query($koneksi, $query);

    header("Location: dash.php");
    exit();
}
?>
