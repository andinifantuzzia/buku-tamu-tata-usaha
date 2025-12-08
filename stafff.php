<?php
session_start();

// Konfigurasi database
$host = "localhost";
$db = "buku_tamu";
$user = "root";
$pass = ""; // sesuaikan dengan password MySQL-mu

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$username = $password = "";
$usernameError = $passwordError = $loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        $usernameError = "Username wajib diisi";
    }

    if (empty($password)) {
        $passwordError = "Password wajib diisi";
    }

    if (empty($usernameError) && empty($passwordError)) {
        // Cek username di database
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($userId, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                // Login berhasil
                $_SESSION['user_id'] = $userId;
                $_SESSION['username'] = $username;
                header("Location: dash.php");
                exit;
            } else {
                $loginError = "Password salah";
            }
        } else {
            $loginError = "Username tidak ditemukan";
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login</title>
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
input[type="text"], input[type="password"] {
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
</style>
</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <?php if ($loginError) echo "<div class='error-message'>$loginError</div>"; ?>
    <form method="POST" action="">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            <div class="error-message"><?php echo $usernameError; ?></div>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password">
            <div class="error-message"><?php echo $passwordError; ?></div>
        </div>
        <button type="submit" class="submit-btn">Masuk</button>
    </form>
    <p>Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
</div>
</body>
</html>
