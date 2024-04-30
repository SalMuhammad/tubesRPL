<?php 
require 'functions.php';
session_start();

// // cek session login
// if(isset($_COOKIE['login'])) {
//   if($_COOKIE['login'] === 'true') {
//     // echo 'ada';
//     $_SESSION['login'] = true;
//   }
// }

// cek cookie id dan fr_aria
if(isset($_COOKIE['id']) && isset($_COOKIE['fr_aria'])) {
  $id = $_COOKIE['id'];
  $fr_aria = $_COOKIE['fr_aria'];
  // cari username berdasarkan id dari cookie
  $hasil = mysqli_query($koneksi_ke_db, "SELECT username FROM users WHERE '$id'");
  $ngaran = mysqli_fetch_assoc($hasil);

  // cek id dan fr_aria di database dengan yang berada di cookie
  if($fr_aria === hash('sha256', $ngaran['username'])){
    $_SESSION['login'] = true;
  }
}

if(isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}




// ketika tombol login di klik.
if(isset($_POST["login"])) {
  $user = $_POST["username"];
  $pass = $_POST["password"];
  global $koneksi_ke_db;
  $error = false;
  // cek ambil data di database yang usernamenya sama dengan yang di inputkan user.
  $result = mysqli_query($koneksi_ke_db, "SELECT * FROM users WHERE username = '$user'");
  if(strlen($user) < 1 || strlen($pass) < 1) {
    var_dump(strlen($user));
    var_dump(strlen($pass));
    echo "
    <script>
    alert('username atau password tidak boleh kosong!')
    </script>
    ";
  }else {
    // cek apakah ada usrname yang sama di database dengan yang di tuliskan user?
    if(mysqli_num_rows($result) === 1) { 
      // jika ada, cek password nya sama gak dengan yang di tulis user?
      // var_dump(mysqli_num_rows($result));
      $rows = mysqli_fetch_assoc($result);
      var_dump($pass);
      var_dump($rows["password"]);
      // if(password_verify(trim($pass), trim($rows["password"]))) {
      if(trim($pass) === trim($rows["password"])) {
        echo 'jaalasfsfdsf';
          // cek apakah remember di centang?
          if(isset($_POST["remember"])) {
            setcookie('id', $rows['id'], time() + 31622400);
            setcookie('fr_aria', hash('sha256', $rows['username']),time() + 31622400);
          }
          $_SESSION["login"] = true;
          header('Location: index.php');
          exit;
        }
      }
      $error = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    label {
      display: block;
    }
  </style>
  <title>halaman login</title>
</head>
<body>
  <center><h1>halaman login</h1></center>
  <?php if(isset($error)) { ?>
    <p style="color: red; font-style: italic;">username atau password salah!! <span>x</span></p>
  <?php } ?>
  <form action="" method="post">
    <ul>
      <li>
        <label>Username: 
          <input type="text" name="username">
        </label>
      </li>
      <li>
        <label>Password: 
          <input type="password" name="password">
        </label>
      </li>
      <li>
        <input type="checkbox" name="remember" id="remember">
        <label  style="display: inline-block;" for="remember">ingat saya</label></li>
      <li>
        <button type="submit" name="login">login</button>
      </li>
    </ul>


    <span>belum punya akun?, registrasi <a href="register.php">di sini</a></span>
  </form>


</body>
</html>

