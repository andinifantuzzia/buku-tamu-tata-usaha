<html lang="en"> 
<head> 
 <meta charset="utf-8"> 
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> 
 <link rel="stylesheet" type="text/css" href="admin.css"> 
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
 <title>ADMINISTRATOR</title> 
 <style> 
  .nav-link:hover { 
   background-color: gold; 
   color: white !important; 
  } 
 </style> 
</head> 
<body> 
 <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top"> 
  <div class="container-fluid"> 
   <a class="navbar-brand text-white" href="#">SELAMAT DATANG ADMIN</a> 
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
     <span class="navbar-toggler-icon"></span> 
    </button> 
    <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
     <div class="ms-auto d-flex align-items-center"> 
      <div class="icon"> 
       <i class="fas fa-envelope-square me-3"></i> 
       <i class="fas fa-bell-slash me-3"></i> 
       <i class="fas fa-user-circle me-3"></i> <!-- Profil User Icon --> 
       <i class="fas fa-sign-out-alt me-3"></i> 
      </div> 
     </div> 
    </div> 
   </div> 
  </nav> 
<div class="row g-0 mt-5"> 
 <!-- Sidebar --> 
 <div class="col-md-2 bg-info mt-2 pt-4"> 
  <ul class="nav flex-column ms-3 mb-5"> 
   <li class="nav-item"> 
    <a class="nav-link active text-white" href="dashboard.php"><i class="fas fa-tachometer-alt me- 
2"></i>Dashboard</a><hr class="bg-secondary"> </li> 
    <li class="nav-item"> 
     <a class="nav-link text-white" href="pengunjung.php"><i class="fas fa-user-graduate me-2"></i>Daftar 
Mahasiswa</a><hr class="bg-secondary"> </li> 
   <li class="nav-item"> 
    <a class="nav-link text-white" href="dosen.php"><i class="fas fa-chalkboard-teacher me-2"></i>Daftar 
Dosen</a><hr class="bg-secondary"></li> 
   <li class="nav-item"> 
    </ul> 
   </div> 
<div class="col-md-10 p-5 pt-2"> 
  <h3><i class="fas fa-user-graduate me-2"></i> Daftar Pengunjung</h3><hr> 
  <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahDataModal"> 
    <i class="fas fa-plus-circle me-2"></i>TAMBAH DATA PENGUNJUNG` 
</button> 
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahDataLabel">Tambah Data Pengunjung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
      </div>
      <div class="modal-body">
        <form action="tambah_mhs.php" method="POST">
          <div class="mb-3">
            <label for="nim" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Instansi</label>
            <input type="text" class="form-control" id="instansi" name="instansi" required>
          </div>
          <div class="mb-3">
            <label for="jurusan" class="form-label">Number</label>
            <input type="text" class="form-control" id="number" name="number" required>
          </div>
          <div class="mb-3">
            <label for="angkatan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="tujuan" name="tujuan" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<table class="table table-striped table-bordered"> 
<thead> 
<tr> 
<th scope="col">NO</th> 
<th scope="col">NAMA</th> 
<th scope="col">INSTANSI</th> 
<th scope="col">NUMBER</th> 
<th scope="col">TUJUAN</th> 
<th scope="col">AKSI</th> 
</tr> 
</thead> 
<tbody> 
<?php 
include 'koneksi.php'; 
$query = mysqli_query($koneksi, "SELECT * FROM pengunjung"); 
$no = 1; 
while ($data = mysqli_fetch_assoc($query)) { 
?> 
<tr> 
<td><?php echo $no++; ?></td> 
<td><?php echo $data['nama']; ?></td> 
<td><?php echo $data['instansi']; ?></td> 
<td><?php echo $data['number']; ?></td> 
<td><?php echo $data['tujuan']; ?></td> 
<td> 
</td> 
</tr> 
<?php 
} 
?> 
</tbody> 
</table> 
</div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> 
</body> 
</html> 
