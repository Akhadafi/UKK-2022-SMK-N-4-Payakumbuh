<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="../vendor/bootstrap.min.css">
  <!-- Data Tabel -->
  <link rel="stylesheet" href="../vendor/dataTables.bootstrap5.min.css">
  <script src="../vendor/jquery-3.5.1.js"></script>
  <script src="../vendor/jquery.dataTables.min.js"></script>
  <script src="../vendor//dataTables.bootstrap5.min.js"></script>
  <title>Kamar</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->


  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#kamar').DataTable();
    });
  </script>

</body>

</html>