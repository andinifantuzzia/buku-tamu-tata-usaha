<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'] ?? '';
    $instansi = $_POST['instansi'] ?? '';
    $contact  = $_POST['contact'] ?? '';
    $purpose  = $_POST['purpose'] ?? '';

    $hasil = "
        <div class='alert alert-success mt-3'>
            <h5>Data Tamu:</h5>
            Nama: $name <br>
            Instansi: $instansi <br>
            Kontak: $contact <br>
            Tujuan: $purpose
        </div>
    ";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buku Tamu Digital</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <style>
    .form-container {
        max-width: 380px;
        margin: 60px auto;
        padding: 25px;
        background: rgba(25, 98, 167, 0.85);
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(247, 240, 240, 1);
    }

    .staf, .porto a {
        color: white;
        font-weight: bold;
    }
  </style>
</head>

<body style="background: url('WhatsApp Image 2025-10-13 at 09.08.59_8e646cf4.jpg') no-repeat center/cover;">

  <div class="staf text-end p-3">
    <a href="sraff.php">Login</a>
  </div>

  <div class="form-container">

      <div class="text-center mb-3">
        <img src="logo_poltek-removebg-preview.png" alt="Logo" class="img-fluid" style="max-width:100px;">
      </div>

      <h3 class="text-center mb-4" style="color: white;">Buku Tamu Digital</h3>


      <form method="POST" action="">

        <input type="text" name="name" class="form-control mb-3" placeholder="Nama" required>
        <input type="text" name="instansi" class="form-control mb-3" placeholder="Instansi" required>
        <input type="text" name="contact" class="form-control mb-3" placeholder="No Kontak" required>
        <input type="text" name="purpose" class="form-control mb-3" placeholder="Tujuan Kunjungan" required>
        <button type="submit" 
        class="w-100 fw-bold" 
        style="color: white; background-color: #116cc6ff; border:none;">
         Simpan
        </button>

      </form>

      <?php if (!empty($hasil)) echo $hasil; ?>

  </div>

  <div class="porto text-center mt-4">
    <a href="about-me.php" class="text-decoration-none text-white fw-semibold">About</a>
  </div>

</body>
</html>
