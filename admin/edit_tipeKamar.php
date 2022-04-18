<?php
session_start();

require 'functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
if ($_SESSION['role'] != "Admin") {
  echo "
            <script>
                alert('Anda bukan admin!');
                window.location.href = './index.php';
            </script>
        ";
}
$id = $_GET['tipe_kamar'];

// query data resepsionis berdasarkan tipe_kamar
$tipe_kamar = query("SELECT * FROM tipe_kamar WHERE tipe_kamar = '$id'")[0];
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

  <title>Hello, <?= $_SESSION['nama']; ?></title>
  <style>
    .bg {
      background-image: url(../img/a3.jpg);
      /* background-color: darkgray; */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
</head>

<body class="bg">
  <!-- Navbar -->
  <?php
  include './navbar.php';
  ?>
  <!-- Navbar -->

  <div class="container" style="margin-top: 90px;">
    <div class="card border-light container-fluid pb-1 text-light" style="width: 25rem;; background-color:black;">
      <form action="" method="post">

        <!-- Modal body -->
        <div class="modal-body">
          <?php

          // cek apakah tombol submit sudah ditekan atau belum
          if (isset($_POST["edit"])) {

            // cek apakah data berhasil diubah atau tidak
            if (editTipeKamar($_POST) > 0) {
              echo "
          <script>
            alert('data berhasil diubah!');
            document.location.href = './';
          </script>
        ";
            } else {
              echo "
          <script>
            alert('data gagal diubah!');
          </script>
        ";
              echo mysqli_error($conn);
            }
          }

          ?>

          <div class="mb-2">
            <label for="tipe_kamar" class="form-label">Kamar</label>
            <input name="tipe_kamar" type="text" class="text-light btn-outline-info form-control" style="background-color:transparent" id="tipe_kamar" placeholder="Tipe Kamar" value="<?= $tipe_kamar['tipe_kamar']; ?>">
          </div>

          <div class="mb-2">
            <label for="harga" class="form-label">Harga Kamar</label>
            <input name="harga" type="text" class="text-light btn-outline-info form-control" style="background-color:transparent" id="harga" placeholder="Harga Kamar" value="<?= $tipe_kamar['harga']; ?>">
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="./" class="btn btn-danger">Kembali</a>
          <button type="submit" name="edit" class="btn btn-info">Edit Data</button>
        </div>

      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>