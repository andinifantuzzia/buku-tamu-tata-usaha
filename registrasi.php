<?php
include 'koneksi.php';
session_start();
$success = "";
$error = "";
$successMsg = "";
$username = "";
$usernameError = "";
$passwordError = "";

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
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Registrasi</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-image: url('poltek.jpg');
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.form-container {
    background: rgba(255,255,255,0.9);
    padding: 25px;
    border-radius: 10px;
    width: 350px;
}
.form-group {
    margin-bottom: 15px;
}
input[type="text"], input[type="password"]{
    width: 100%;
    padding: 10px;
    font-size: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.submit-btn {
    width: 100%;
    padding: 10px;
    background: #0275d8;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.submit-btn:hover { background: #025aa5; }
.error-message { color: red; font-size: 13px; margin-top: 3px; }
.success-message { color: green; font-size: 14px; margin-bottom: 10px; }
</style>
</head>
<body>
<div class="form-container">
    <h2>Registrasi</h2>
    <?php if ($successMsg) echo "<div class='success-message'>$successMsg</div>"; ?>
    <form method="POST" action="">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            <div class="error-message"><?php echo $usernameError; ?></div>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password">
            <div class="error-message"><?php echo $passwordError; ?></div>
        </div>
        <button type="submit" class="submit-btn">Daftar</button>
    </form>
</div>
</body>
</html>
