<?php
session_start();
//hapus semua session
session_unset();
session_destory();
// redirect ke halaman login
header("location: login.php");
exit();
?>