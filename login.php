<?php

session_start();

require 'functions.php';

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
  header("Location: tamu.php");
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
        header("location:admin/");
      } else if ($role == 'Resepsionis') {
        header("location:resepsionis/");
      } else if ($role == 'Tamu') {
        header("location:tamu/");
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../asset/datatabels/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="../asset/datatabels/dataTables.bootstrap5.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

  <!-- <script src="../asset/datatabels/jquery-3.5.1.js"></script> -->
  <!-- <script src="../asset/datatabels/jquery.dataTables.min.js"></script> -->
  <!-- <script src="../asset/datatabels/dataTables.bootstrap5.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

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
          <button type="button" class="btn btn-dark">Cancel</button>
        </form>
      </div>

      <!-- Tambah -->
      <div class="card mt-3 pt-3">
        <p>Belum punya akun?
          <a type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#TbResepsionis">
            Registrasi
          </a>
        </p>
      </div>

      <!-- The Modal -->
      <div class="modal fade" id="TbResepsionis">
        <div class="modal-dialog modal-lg">
          <div class="modal-content border border-dark container">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Registrasi Akun Hotel Hebat :</h4>
              <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Kembali</button>
            </div>

            <form action="" method="post" enctype="multipart/form-data">

              <!-- Modal body -->
              <div class="modal-body">
                <?php

                if (isset($_POST["register"])) {

                  if (registrasi($_POST) > 0) {
                    echo "<script>
                                alert('user baru berhasil ditambahkan!');
                                document.location.href = '';
                                </script>";
                  } else {
                    echo mysqli_error($conn);
                  }
                }

                ?>

                <div class="row text-dark">
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" name="username" id="username" class="form-control" placeholder="name@example.com" autocomplete="off">
                      <label for="username" class="form-label">Username :</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" name="nama" id="nama" class="form-control" placeholder="name@example.com" autocomplete="off">
                      <label for="nama" class="form-label">Nama :</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="password" id="password" class="form-control" placeholder="name@example.com" autocomplete="off">
                      <label for="password" class="form-label">Password :</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="password2" id="password2" class="form-control" placeholder="name@example.com" autocomplete="off">
                      <label for="password2" class="form-label">Konfirmasi Password :</label>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <input type="hidden" name="role" id="role" value="tamu">
                    <div class="form-floating mb-3">
                      <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="name@example.com" autocomplete="off">
                      <label for="no_hp" class="form-label">No Hp :</label>
                    </div>
                    <div class="form-floating mb-3">
                      <textarea name="alamat" class="form-control" placeholder="Leave a comment here" id="alamat"></textarea>
                      <label for="alamat">Alamat :</label>
                    </div>
                    <div class="mb-3">
                      <label for="gambar" class="form-label text-dark">Photo :</label>
                      <input type="file" name="gambar" id="gambar" class="form-control" placeholder="name@example.com" autocomplete="off">
                    </div>
                  </div>
                </div>

              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" name="register" class="btn btn-success">Tambah</button>
              </div>

            </form>

          </div>
        </div>
        <!-- Tambah -->
      </div>
    </div>
  </div>

  <!-- SCRIPT JAVASCRIPT -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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