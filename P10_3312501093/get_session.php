<?php
session_start();


if (isset($_SESSION['nama'])) {
    echo "nama: " . $_SESSION['nama'] . "<br>";
    echo "role: " . $_SESSION['role'] . "<br>";
    echo "<a href='destory_session.php'>hapus session</a>;
} else {
    echo "session belum diset. <a href='set_session.php'>set session</a>";
}
?>