<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

// ambil data di URL
$id_fasilitas_umum = $_GET["id"];
// query data berdasarkan id
$DetailFasilitasUmum = mysqli_query($conn, "SELECT * FROM fasilitas_umum WHERE id = $id_fasilitas_umum");
// ambil baris dari query
$ResultDetailFasilitasUmum = mysqli_fetch_assoc($DetailFasilitasUmum);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <title>Detail</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Detail -->
  <div class="container mt-2">
    <h2 class="text-center">FASILITAS UMUM</h2>
    <h5 class="text-center">Hotel Hebat</h5>
    <div class="container mt-4">
      <div class="card bg-secondary border-light p-3">
        <h5><?= $ResultDetailFasilitasUmum['nama_fasilitas']; ?></h5>
        <p><?= $ResultDetailFasilitasUmum['keterangan']; ?></p>
        <img class="img-fluid rounded" style="max-width: 100%; height: auto;" src="./img/fasilitas_umum/<?= $ResultDetailFasilitasUmum['gambar']; ?>" alt="Gambar">
      </div>
    </div>
  </div>
  <!-- Detail -->

  <!-- Bootstrap JS -->
  <script src="./vendor/bootstrap.bundle.min.js"></script>

</body>

</html>