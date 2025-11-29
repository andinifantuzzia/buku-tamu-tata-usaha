<?php
session_start();


$nameError = "";
$passwordError = "";
$username = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['name'];
    $password = $_POST['password'];

    if ($username != "admin") {
        $nameError = "Username salah";
    }

    if ($password != "12345") {
        $passwordError = "Password salah";
    }

    if ($username == "admin" && $password == "12345") {
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;

      
      background-image: url('poltek.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;

      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }

    .staf {
      position: absolute;
      top: 20px;
      left: 20px;
    }

    .staf a {
      color: white;
      font-weight: bold;
      text-decoration: none;
      background: rgba(0,0,0,0.5);
      padding: 6px 10px;
      border-radius: 5px;
    }

    .form-container {
      width: 350px;
      background: rgba(255, 255, 255, 0.85);
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      text-align: center;
    }

    .form-group {
      text-align: left;
      margin-bottom: 15px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .submit-btn {
      width: 100%;
      padding: 10px;
      background: #0275d8;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .submit-btn:hover {
      background: #025aa5;
    }

    .error-message {
      color: red;
      font-size: 13px;
      margin-top: 3px;
      display: none;
    }
  </style>

</head>
<body>

  <div class="staf">
    <a href="form.php">Back</a>
  </div>

  <div class="form-container">
    <h2>Login</h2>

    <form method="POST" action="">
      
      <div class="form-group">
        <input 
          type="text" 
          id="name" 
          name="name" 
          placeholder="Masukkan username" 
          value="<?php echo $username; ?>"
        >
        <div 
          class="error-message" 
          id="nameError"
          style="display: <?php echo $nameError ? 'block' : 'none'; ?>;"
        >
          <?php echo $nameError; ?>
        </div>
      </div>
      
      <div class="form-group">
        <input 
          type="password" 
          id="password" 
          name="password" 
          placeholder="Masukkan kata sandi"
        >
        <div 
          class="error-message" 
          id="passwordError"
          style="display: <?php echo $passwordError ? 'block' : 'none'; ?>;"
        >
          <?php echo $passwordError; ?>
        </div>
      </div>
      
      <button type="submit" class="submit-btn">Masuk</button>

    </form>
  </div>

</body>
</html>
