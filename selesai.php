<?php
include "koneksi.php";

$id = $_GET['id'];
$jamakhir = date("H:i");

mysqli_query($koneksi, "UPDATE tbpengunjung SET jamakhir='$jamakhir' WHERE id='$id'");

header("Location: dash.php");
exit;
?>
