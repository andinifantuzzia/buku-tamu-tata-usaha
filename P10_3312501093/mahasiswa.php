<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/5.15.4/css/all.min.css">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bstarget="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" arialabel="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto d-flex align-items-center">
                    <div class="icon">
                        <i class="fas fa-envelope-square me-3"></i>
                        <i class="fas fa-bell-slash me-3"></i>
                        <i class="fas fa-user-circle me-3"></i> <!-- Profil User Icon -->
                        <i class="fasfa-sign-out-alt me-3"></i>
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
                    <a class="nav-link active text-white" href="dashboard.php"><i class="fasfa-tachometer-alt me2"></i>Dashboard</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="mahasiswa.php"><i class="fasfa-user-graduate me-2"></i>Daftar
                        Mahasiswa</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="dosen.php"><i class="fasfa-chalkboard-teacher me-2"></i>Daftar
                        Dosen</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="pegawai.php"><i class="fasfa-users me-2"></i>Daftar Pegawai</a>
                    <hr
                        class="bg-secondary">
                </li>
            </ul>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fasfa-user-graduate me-2"></i> Daftar Mahasiswa</h3>
            <hr>
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                <i class="fasfa-plus-circle me-2"></i>TAMBAH DATA MAHASISWA
            </button>
            <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahDataLabel">Tambah Data Mahasiswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="tambah_mhs.php" method="POST">
                                <div class=mb-3>
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="angkatan" class="form-label">Angkatan</label>
                                    <input type="text" class="form-control" id="angkatan" name="angkatan" required>
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
                        <th scope="col">NIM</th>
                        <th scope="col">NAMA MAHASISWA</th>
                        <th scope="col">JURUSAN</th>
                        <th scope="col">ANGKATAN</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nim']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['jurusan']; ?></td>
                            <td><?php echo $data['angkatan']; ?></td>
                            <td>
                            <button class="btn btn-success btn-sm me-1 edit-button"
                            data-bs-toggle="modal"
                            data-bs-target="#editDataModal"
                            data-nim="<?php echo $data['nim']; ?>"
                            data-nama="<?php echo $data['nama']; ?>"
                            data-jurusan="<?php echo $data['jurusan']; ?>"
                            data-angkatan="<?php echo $data['angkatan']; ?>">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="hapus_mhs.php?nim=<?php echo $data['nim']; ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete</a>
                            <!-- Modal Edit Data -->
                        <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" ariahidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editDataLabel">Edit Data Mahasiswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="ubah_mhs.php" method="POST">
                                        <input type="hidden" id="edit-nim" name="nim">
                                        <div class="mb-3">
                                            <label for="edit-nama" class="form-label">Nama Mahasiswa</label>
                                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-jurusan" class="form-label">Jurusan</label>
                                            <input type="text" class="form-control" id="edit-jurusan" name="jurusan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-angkatan" class="form-label">Angkatan</label>
                                            <input type="text" class="form-control" id="edit-angkatan" name="angkatan" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        </td>
                            <td>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
document.addEventListener('DOMContentLoaded', function () {
const editButtons =  document.querySelectorAll('.edit-button');
editButtons.forEach(button => {
button.addEventListener('click', function () {
const nim = this.getAttribute('data-nim');
const nama = this.getAttribute('data-nama');
const jurusan = this.getAttribute('data-jurusan');
const angkatan = this.getAttribute('data-angkatan');

document.getElementById('edit-nim').value = nim;
document.getElementById('edit-nama').value = nama;
document.getElementById('edit-jurusan').value = jurusan;
document.getElementById('edit-angkatan').value = angkatan;
});
});
});
            </script>
</body>

</html>