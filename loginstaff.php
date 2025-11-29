<?php 
session_start();
require 'koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query prepared statement
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
            $_SESSION['staff_password']    = $row['password'];

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
    <title>Form Login</title>
</head>
<body>

<h2>Form Login Staff</h2>

<form action="proses_login.php" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "Username: " . $username . "<br>";
    echo "Password: " . $password . "<br>"; // hanya untuk demo, jangan dipakai di produksi
}
?>
