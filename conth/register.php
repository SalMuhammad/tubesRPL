<?php 
require 'functions.php';

// session_start();
// if(!isset($_SESSION["login"])) {
//   header("Location: login.php");
//   exit;
// }

if(isset($_POST["register"])) {
  if(registrasi($_POST) > 0) {
    echo "
    <script>
      alert('user baru berhasil di tambahkan')
    </script>
    ";
  } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>halaman registrasi</title>
  <link rel="stylesheet" href="../../style/style.css">
  <style>
    label {
      display: block;
    }
  </style>
</head>
<body>
  <center><h1>halaman registrasi</h1></center>
  
  <span>sudah punya akun? jika sudah mari login <a href="login.php">di sini</a></span>
  <form action="" method="post">
    <ul>
      <li>
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
      </li>
      <li>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
      </li>
      <li>
        <label for="password2">Konfirmasi Password</label>
        <input type="password" id="password2" name="password2">
      </li>
    </ul>
    <button type="submit" name="register">buatkan akun</button>
  </form>
</body>
</html>