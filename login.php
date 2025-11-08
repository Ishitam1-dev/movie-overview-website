<?php
session_start();
include '../backend/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // plain password (use hash in real apps)

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['admin_logged_in'] = true;
        header("Location: index1.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="background">
    <div class="login-box">
      <h2>Login</h2>
      
      <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

      <form method="POST" action="">
        <div class="input-box">
          <i class="fa fa-user"></i>
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-box">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="login-btn">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
