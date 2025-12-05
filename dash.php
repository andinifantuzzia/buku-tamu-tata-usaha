<?php 
include "koneksi.php"; // Menghubungkan ke database

// Menangkap data pencarian
$cari = $_GET['cari'] ?? "";

// Menangkap tanggal awal
$dari = $_GET['dari'] ?? "";

// Menangkap tanggal akhir
$sampai = $_GET['sampai'] ?? "";

// Perintah awal untuk menampilkan data
$query = "SELECT * FROM tbpengunjung WHERE 1=1";

// Jika kolom pencarian diisi
if ($cari != "") {
    $query .= " AND (nama LIKE '%$cari%' 
                OR instansi LIKE '%$cari%' 
                OR nohp LIKE '%$cari%' 
                OR tujuan LIKE '%$cari%')";
}

// Jika kedua tanggal diisi
if ($dari != "" && $sampai != "") {
    $query .= " AND tanggal BETWEEN '$dari' AND '$sampai'";
}

// Menjalankan perintah ke database
$dataPengunjung = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Pengunjung</title>

  <!-- Memanggil Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="p-4 bg-light">
  <div class="container">

    <h2 class="fw-bold text-uppercase mb-4">Daftar Pengunjung</h2>

    <!-- Form Pencarian dan Filter -->
    <form method="GET" class="d-flex gap-2 mb-3">

      <input type="text" name="cari" class="form-control" placeholder="Cari..." value="<?= $cari ?>">

      <input type="date" name="dari" class="form-control" value="<?= $dari ?>">
      <span class="pt-2">s/d</span>
      <input type="date" name="sampai" class="form-control" value="<?= $sampai ?>">

      <button class="btn btn-primary">Filter</button>

      <a href="dash.php" class="btn btn-secondary">Reset</a>
    </form>

    <!-- Tombol Tambah Data -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
    <i class="bi bi-plus-lg"></i> Tambah Data
    </button>

    <!-- Tabel Data -->
    <div class="table-responsive">
      <table class="table table-hover align-middle table-bordered bg-white">
        <thead class="table-dark">
          <tr>
            <th>Nama</th>
            <th>Instansi</th>
            <th>No HP</th>
            <th>Keperluan</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php while ($row = mysqli_fetch_assoc($dataPengunjung)) { ?>
          <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['instansi'] ?></td>
            <td><?= $row['nohp'] ?></td>
            <td><?= $row['tujuan'] ?></td>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['jamawal'] ?></td>

            <td>
              <?= $row['jamakhir'] ? date('H:i', strtotime($row['jamakhir'])) : '-' ?>
            </td>

            <td>
              <button 
                class="btn btn-info btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalEdit<?= $row['id'] ?>">
                Edit
              </button>

              <?php if (!$row['jamakhir']) { ?>
              <a href="selesai.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Selesai</a>
              <?php } ?>
              
              <a href="hapus.php?id=<?= $row['id'] ?>" 
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Yakin hapus data?')">
                 Hapus
              </a>
            </td>
          </tr>
          <div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered"> 
    <div class="modal-content">
              
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pengunjung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
              
      <!-- FORM TAMBAH DATA -->
      <form action="tambah.php" method="POST">
        <div class="modal-body">
              
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control mb-2" required>
              
          <label class="form-label">Instansi</label>
          <input type="text" name="instansi" class="form-control mb-2" required>
              
          <label class="form-label">No HP</label>
          <input type="text" name="nohp" class="form-control mb-2" required>
              
          <label class="form-label">Keperluan</label>
          <textarea name="tujuan" class="form-control mb-2" required></textarea>
        </div>
              
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
          <!-- Form Edit Data -->
          <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title">Edit Pengunjung</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="edit.php" method="POST">
                  <div class="modal-body">

                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control mb-2" value="<?= $row['nama'] ?>" required>

                    <label>Instansi</label>
                    <input type="text" name="instansi" class="form-control mb-2" value="<?= $row['instansi'] ?>" required>

                    <label>No HP</label>
                    <input type="text" name="nohp" class="form-control mb-2" value="<?= $row['nohp'] ?>" required>

                    <label>Keperluan</label>
                    <textarea name="tujuan" class="form-control mb-2" required><?= $row['tujuan'] ?></textarea>

                  </div>

                  <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  </div>
                </form>

              </div>
            </div>
          </div>

          <?php } ?>
        </tbody>
      </table>
    </div>
        <!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered"> 
    <div class="modal-content">
              
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pengunjung</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
              
      <!-- FORM TAMBAH DATA -->
      <form action="tambah.php" method="POST">
        <div class="modal-body">
              
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control mb-2" required>
              
          <label class="form-label">Instansi</label>
          <input type="text" name="instansi" class="form-control mb-2" required>
              
          <label class="form-label">No HP</label>
          <input type="text" name="nohp" class="form-control mb-2" required>
              
          <label class="form-label">Keperluan</label>
          <textarea name="tujuan" class="form-control mb-2" required></textarea>
        </div>
              
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
              
    </div>
  </div>
</div>
</div>
</body>

<!-- Memanggil JavaScript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const form = document.querySelector("form");
const cari = document.querySelector("input[name='cari']");
const dari = document.querySelector("input[name='dari']");
const sampai = document.querySelector("input[name='sampai']");

let timer;

// Filter cari pakai delay
cari.addEventListener("keyup", function () {
  clearTimeout(timer);
  timer = setTimeout(function () {
    form.submit();
  }, 800); // waktu tunggu 0.7 detik setelah berhenti mengetik
});

// Filter tanggal langsung jalan
dari.addEventListener("change", function () {
  form.submit();
});

sampai.addEventListener("change", function () {
  form.submit();
});
</script>



</html>
