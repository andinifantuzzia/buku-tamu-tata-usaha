<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: pengunjung.php");
    exit;
}
include "koneksi.php";

$cari   = $_GET['cari']   ?? '';
$dari   = $_GET['dari']   ?? '';
$sampai = $_GET['sampai'] ?? '';

$query = "SELECT * FROM tbpengunjung WHERE 1=1";

if ($cari) {
    $query .= " AND CONCAT(nama, instansi, nohp, tujuan, tanggal) LIKE '%$cari%'";
}

if ($dari && $sampai) {
    $query .= " AND tanggal BETWEEN '$dari' AND '$sampai'";
}

$dataPengunjung = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard Pengunjung</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f4f6f9; }
.card { border:none; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,.05); }
.table thead th {
  background:#1f2937; color:#fff; font-size:13px;
  position:sticky; top:0; z-index:10;
}
.table-wrapper { max-height:430px; overflow:auto; }
.btn-icon { padding:4px 8px; font-size:13px; }
.page-title { font-weight:700; letter-spacing:.5px; }
</style>
</head>

<body>

<div class="container-fluid p-4">

<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="page-title">📋 DATA PENGUNJUNG</h4>
  <a href="logout.php" class="btn btn-outline-danger btn-sm"
     onclick="return confirm('Yakin ingin logout?')">
    <i class="bi bi-box-arrow-right"></i> Logout
  </a>
</div>


<div class="card">


  <div class="card-header d-flex justify-content-between align-items-center">
    <span class="fw-semibold">Daftar Pengunjung</span>
    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="bi bi-plus-circle"></i> Tambah
    </button>
  </div>


  <div class="card-body border-bottom">
    <form method="GET" class="row g-2 align-items-end">
      <div class="col-md-4">
        <label class="form-label small">Pencarian</label>
        <input type="text" name="cari" class="form-control"
               placeholder="cari"
               value="<?= $cari ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label small">Dari</label>
        <input type="date" name="dari" class="form-control" value="<?= $dari ?>">
      </div>

      <div class="col-md-2">
        <label class="form-label small">Sampai</label>
        <input type="date" name="sampai" class="form-control" value="<?= $sampai ?>">
      </div>

      <div class="col-md-2 d-flex gap-2">
        <button class="btn btn-primary w-100">
          <i class="bi bi-search"></i>
        </button>
        <a href="dash.php" class="btn btn-secondary w-100">
          <i class="bi bi-arrow-repeat"></i>
        </a>
      </div>
    </form>
  </div>


  <div class="card-body p-0">
    <div class="table-responsive table-wrapper">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th width="50">No</th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>No HP</th>
            <th>Keperluan</th>
            <th width="120">Tanggal</th>
            <th width="90">Masuk</th>
            <th width="90">Keluar</th>
            <th width="160">Aksi</th>
          </tr>
        </thead>
        <tbody>

        <?php while ($row = mysqli_fetch_assoc($dataPengunjung)) { ?>
          <tr>
            <td class="text-center"><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['instansi'] ?></td>
            <td><?= $row['nohp'] ?></td>
            <td><?= $row['tujuan'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= date('H:i', strtotime($row['jamawal'])) ?></td>
            <td><?= $row['jamakhir'] ? date('H:i', strtotime($row['jamakhir'])) : '-' ?></td>
            <td>
              <button class="btn btn-warning btn-icon mb-1"
                      data-bs-toggle="modal"
                      data-bs-target="#edit<?= $row['id'] ?>">
                <i class="bi bi-pencil"></i>
              </button>

              <?php if (!$row['jamakhir']) { ?>
              <a href="selesai.php?id=<?= $row['id'] ?>" class="btn btn-info btn-icon mb-1">
                <i class="bi bi-check-circle"></i>
              </a>
              <?php } ?>

              <a href="hapus.php?id=<?= $row['id'] ?>"
                 onclick="return confirm('Hapus data?')"
                 class="btn btn-danger btn-icon mb-1">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>

          
          <div class="modal fade" id="edit<?= $row['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <form action="edit.php" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Pengunjung</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="text" name="nama" class="form-control mb-2" value="<?= $row['nama'] ?>" required>
                    <input type="text" name="instansi" class="form-control mb-2" value="<?= $row['instansi'] ?>" required>
                    <input type="text" name="nohp" class="form-control mb-2" value="<?= $row['nohp'] ?>" required>
                    <textarea name="tujuan" class="form-control" required><?= $row['tujuan'] ?></textarea>
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        <?php } ?>

        </tbody>
      </table>
    </div>
  </div>

</div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="tambah.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pengunjung</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
          <input type="text" name="instansi" class="form-control mb-2" placeholder="Instansi" required>
          <input type="text" name="nohp" class="form-control mb-2" placeholder="No HP" required>
          <textarea name="tujuan" class="form-control" placeholder="Keperluan" required></textarea>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const form = document.querySelector("form");
const cari = document.querySelector("input[name='cari']");
let timer;

cari.addEventListener("keyup", () => {
  clearTimeout(timer);
  timer = setTimeout(() => form.submit(), 600);
});
</script>

</body>
</html>
