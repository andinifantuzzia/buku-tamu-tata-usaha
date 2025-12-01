<?php 
session_start();
require 'koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared Statement
    $stmt = $conn->prepare("SELECT * FROM staff WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek username
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {

            $_SESSION['staff_login'] = true;
            $_SESSION['staff_nama']  = $row['nama'];

            header("Location: dashboard.php");
            exit;

        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Login Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image : url("poltek.jpg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background:#007BFF;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #457de6ff;
            border-radius: 5px;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-box button:hover {
            background: #0069d9;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login Staff</h2>

    <?php if (!empty($error)) : ?>
        <div class="error"><?= $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

</div>

</body>
</html>
