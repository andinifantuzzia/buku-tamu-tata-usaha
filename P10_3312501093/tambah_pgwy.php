<?php
include 'koneksi.php';
$ni = $_POST['nim'];
$nama = $_POST['nama'];
$jurusan = $_POST['alamat'];
$angkatan = $_POST['bagian'];

$input = mysqli_query($koneksi, "INSERT INTO dosen (nim, nama, alamat, bagian) VALUES('$nim', '$nama
,'$alamat', '$bagian')") or die(mysqli_error($koneksi));

if($input){
    echo "<script>
    alert('Data Berhasil Disimpan');
    window.location.href = 'dosen.php';
    </script>";
} else {
    echo "<script>
    alert('Gagal Menyimpan Data');
    window.location.href = 'dosen.php';
    </script>";
}
?>