<?php
session_start();

require '../admin/functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}
if ($_SESSION['role'] != "Resepsionis") {
  echo "
            <script>
                alert('Anda bukan resepsionis!');
                window.location.href = '../logout.php';
            </script>
        ";
}
?>

<!doctype html>
<html lang="en">

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
</head>

<body style="background-color: black;">
  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-sm navbar-dark border-bottom border-top" style="background-color: black;">
    <div class="container-fluid">
      <div class="d-flex" href="#">
        <img src="../img/user/pp/<?= $_SESSION['gambar']; ?>" alt="Avatar Logo" style="width: 50px;" class="rounded-pill border border-2 border-warning">
        <div class="navbar-brand mx-1 text-warning"><?= $_SESSION['nama']; ?> | role : <?= $_SESSION['role']; ?></div>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="mynavbar">
      <div class="mx-auto container">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="./">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./resepsionis.php">Resepsionis</a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="btn btn-outline-danger" onclick="return confirm('yakin keluar?');">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

  <div class="container-fluid" style="margin-top: 90px;">

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
</body>

</html>