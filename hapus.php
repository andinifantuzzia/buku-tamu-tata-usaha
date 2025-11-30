<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM tbpengunjung WHERE id='$id'");

header("Location: dash.php");
exit;
?>
