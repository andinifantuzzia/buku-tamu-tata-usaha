<?php
include 'koneksi.php';
session_start();

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user  = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password  = mysqli_real_escape_string($koneksi, $_POST['password']);
    // Cek username sudah ada
    $check = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username sudah dipakai!";
    } else {
        // Insert data
        $query = "INSERT INTO users (username, password) 
                  VALUES ('$user', '$password')";

        if (mysqli_query($koneksi, $query)) {
            $success = "Pendaftaran berhasil! Silakan login.";
            header("Location: dash.php");
            exit();
        } else {
            $error = "Gagal mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <style>
body {
    font-family: Arial, sans-serif;
    background-image: url('poltek.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Card Form */
.container {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 50px 35px 25px;
    border-radius: 15px;
    width: 350px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    text-align: center;
}

/* Title */
h3 {
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 25px;
}

/* Label */
.form-label {
    text-align: left;
    font-weight: 600;
    width: 100%;
}

/* Input */
.form-control {
    border-radius: 8px;
    font-size: 16px;
    padding: 10px;
}

/* Button */
.btn-primary {
    background-color: #0275d8;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #025aa5;
}

/* Alert Boxes */
.alert-danger,
.alert-success {
    font-size: 14px;
    padding: 10px;
    border-radius: 8px;
}

/* Link login */
.text-center a {
    text-decoration: none;
    font-weight: bold;
}

.text-center a:hover {
    text-decoration: underline;
}
</style>


</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <h3 class="mb-3">Daftar Akun</h3>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>

            <p class="mt-3 text-center">
                Sudah punya akun? <a href="staff.php">Login</a>
            </p>

        </div>
    </div>
</div>

</body>
</html>