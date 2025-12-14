<?php
session_start(); // memulai session

//menyimpan data ke dalam session
$_SESSION['nama'] = 'admin';
$_SESSION['role'] = 'administrator';

echo "session telah dibuat. <a href='get_session.php'>lihat session</a>";
>?