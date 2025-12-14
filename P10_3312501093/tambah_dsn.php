<?php
include 'koneksi.php';
$ni = $_POST['nim'];
$nama = $_POST['nama'];
$jurusan = $_POST['alamat'];
$angkatan = $_POST['Bagian'];

$input = mysqli_query($koneksi, "INSERT INTO Pegawai (nim, nama, alamat, Bagian) VALUES('$nim', '$nama
,'$alamat', '$jabatan')") or die(mysqli_error($koneksi));

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