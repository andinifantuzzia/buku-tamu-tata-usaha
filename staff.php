<?php
session_start();
$_SESSION['login'] = true;
$_SESSION['user']  = $username;
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];
    $user = mysqli_real_escape_string($koneksi, $user);
    $password = mysqli_real_escape_string($koneksi, $password); 
    $data = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$user' AND password= 
    '$password'");
    $row = mysqli_fetch_array($data);
    if (mysqli_num_rows($data) > 0) {
        $_SESSION['username'] = $row['username'];
        header('Location: dash.php');
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
body{ 
    font-family: Arial, sans-serif;
    background-image: url('poltek.jpg');
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.container {
    background: rgba(133, 174, 248, 0.7);
    padding: 25px;
    border-radius: 10px;
    width: 350px;
}
h3 {
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 25px;
}
.form-group {
    margin-bottom: 15px;
}
.form-label {
    text-align: left;
    font-weight: 600;
    width: 100%;
}
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center mb-4">Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
        <p class="mt-3 text-center">
        Belum punya akun?  <a href="registrasi.php">Registrasi</a>
</p>
    </div>
</div>


</body>
</html>