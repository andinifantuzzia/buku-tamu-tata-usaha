<?php
include 'koneksi.php';
$nik = $_POST['nim'];
$nama = $_POST['nama'];
$alamat = $_POST['jurusan'];
$jabatan = $_POST['angkatan'];

$input = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, jurusan, angkatan) VALUES('$nim', '$nama
,'$jurusan', '$angkatan')") or die(mysqli_error($koneksi));

if($input){
    echo "<script>
    alert('Data Berhasil Disimpan');
    window.location.href = 'mahasiswa.php';
    </script>";
} else {
    echo "<script>
    alert('Gagal Menyimpan Data');
    window.location.href = 'mahasiswa.php';
    </script>";
}
?>