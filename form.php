<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = htmlspecialchars($_POST["name"]);
    $instansi = htmlspecialchars($_POST["instansi"]);
    $contact  = htmlspecialchars($_POST["contact"]);
    $purpose  = htmlspecialchars($_POST["purpose"]);

    $data = [
        "name"     => $name,
        "instansi" => $instansi,
        "contact"  => $contact,
        "purpose"  => $purpose,
        "waktu"    => date("Y-m-d H:i:s")
    ];

    $file = "bukutamu.json";
    $jsonArray = [];

    if (file_exists($file)) {
        $jsonArray = json_decode(file_get_contents($file), true);
    }

    $jsonArray[] = $data;
    file_put_contents($file, json_encode($jsonArray, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buku Tamu Digital</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
</head>
<body>

  <div class="staf">
    <a href="sraff.html">Login</a>
  </div>

  <div id="mainWrapper" class="main-wrapper single-form">
    <div id="formWrapper" class="form-wrapper">
      <div class="input-container">
        <div class="login-card">
          <div class="text-center mb-3">
            <img src="logo_poltek-removebg-preview.png" alt="Logo" class="img-fluid" style="max-width:100px;">
          </div>
          <h3 class="text-center mb-4">Buku Tamu Digital</h3>

          <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
              <div class="alert alert-success text-center">
                  Data berhasil disimpan!
              </div>
          <?php endif; ?>

          <form id="formInput" method="POST" action="">
            <div class="mb-3">
              <input type="text" name="name" class="form-control" placeholder="Nama" required>
            </div>
            <div class="mb-3">
              <input type="text" name="instansi" class="form-control" placeholder="Instansi" required>
            </div>
            <div class="mb-3">
              <input type="text" name="contact" class="form-control" placeholder="No Kontak" required>
            </div>
            <div class="mb-3">
              <input type="text" name="purpose" class="form-control" placeholder="Tujuan Kunjungan" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-light text-dark fw-bold">Simpan</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <div class="porto text-center mt-4">
    <a href="about me.html" class="text-decoration-none text-white fw-semibold">About</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
