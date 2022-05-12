<?php
session_start();
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");


// cek cookie
if (isset($_COOKIE['username']) && isset($_COOKIE['key'])) {
  $username = $_COOKIE['username'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan username
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1) {

    // cek password
    $row = mysqli_fetch_assoc($result);
    $role = $row['role'];
    $nama = $row['nama'];
    $gambar = $row['gambar'];

    if (password_verify($password, $row["password"])) {

      // set session
      $_SESSION["login"] = true;
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $role;
      $_SESSION['nama'] = $nama;
      $_SESSION['gambar'] = $gambar;
      if ($role == 'Admin') {
        header("location:admin/kamar.php");
      } else if ($role == 'Resepsionis') {
        header("location:resepsionis/pelanggan.php");
      }

      // cek remember me
      if (isset($_POST['remember'])) {
        // buat cookie
        setcookie('username', $row['username'], time() + 60);
        setcookie('key', hash('sha256', $row['username']), time() + 60);
      }

      // header("Location: tamu.php");
      exit;
    }
  }

  $error = true;
}

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <title>Hello, world!</title>
  <style>
    .bg {
      background-image: url(./img/a3.jpg);
      /* background-color: darkgray; */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
</head>

<body>
  <div class="p-2 bg-secondary text-white text-center">
    <h1>HOTEL HEBAT</h1>
    <p>Selamat datang di Hotel Hebat Payakumbuh Indonesia!</p>
  </div>

  <div class="container mt-4 col-lg-4">
    <h2 class="text-center">LOGIN</h2>
    <h6 class="text-center">Silahkan masukan username dan password anda!</h6>

    <div class="row" id="dlogin">
      <div class="card pb-2">
        <form action="" id="flogin" method="post">
          <div class="input-group flex-nowrap mt-2 mb-2">
            <span class="input-group-text" id="addon-wrapping">U</span>
            <input type="text" name="username" class="form-control" placeholder="Username" id="username" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap mt-2 mb-2">
            <span class="input-group-text" id="addon-wrapping">P</span>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
          </div>
          <div class="input-group flex-nowrap mt-2 mb-2">
            <input type="checkbox" class="form-check-input mx-2" name="remember" id="remember">
            <label for="remember">Ingat saya</label>
          </div>
          <button type="submit" name="login" id="proses_login" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- SCRIPT JAVASCRIPT -->
  <!-- Bootstrap JS -->
  <script src="./vendor/jquery-3.5.1.js"></script>
  <script src="./vendor/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $("#proses_login").click(function() {
        var user = $("#username").val();
        var pass = $("#password").val();
        if ((user == "") || (pass == "")) {
          alert("Field belum diisi!");
          return;
        }
        $.ajax({
          url: "login_admin.php",
          method: "POST",
          data: {
            username: user,
            password: pass
          },
          success: function(data) {
            //alert(data); return;
            if (data == "OK") {
              alert("Login Successfuly!");
              window.location.href = "home.php";
            }
            if (data == "ERROR") {
              document.getElementById("flogin").reset();
              alert("Terjadi kesalahan! Error Username dan Password");
            }
          }
        });
      });

    });
  </script>

  <!-- END BODY -->

</body>

</html>