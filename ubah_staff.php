<?php
// include database connection file
include 'koneksi.php';
$nim = $_POST['name'];
$nama = $_POST['password'];
$result = mysqli_query($koneksi, "UPDATE staff SET name='$nama', password= '$password'
'");
// Redirect to homepage to display updated user in list
header("Location: loginstaff.php");
?>