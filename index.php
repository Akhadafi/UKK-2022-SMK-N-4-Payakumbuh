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
  <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <title>Hotel</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- SCRIPT TOMBOL PESAN SEKARANG -->
  <div class="container mt-2">
    <div class="d-flex justify-content-center">
      <div class="row">
        <div class="col-sm form-floating mb-3 mt-4">
          <a href="pesan.php" class="btn btn-primary">Mulai Pesan Sekarang</a>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT TEANTANG KAMI -->
  <div class="container  mt-2" id="panel_tentang_kami">
    <div class="d-flex justify-content-center">
      <div class="row">
        <div class="col-sm-12 p-5">
          <h2 class="text-center">TENTANG KAMI</h2>
          <p> <b>Hotel Hebat</b> terkenal dengan keramahan kelas dunia, desain hotel yang mengagumkan dan standar layanan yang tak tertandingi di Bali dan Jakarta, AYANA adalah resort bintang lima yang pertama di Pantai Waecicu, Pulau Flores, hanya dengan satu jam penerbangan dari Pulau Bali yang sangat indah. AYANA Komodo Resort, Waecicu Beach memiliki 13 suites dan 192 kamar tamu yang premium. Terinspirasi dengan cahaya, kenyamanan dan ruang terbuka, setiap kamar yang kontemporer menawarkan pemandangan laut yang menawan dengan jendela besar untuk menikmati cahaya keemasan dari matahari yang terbenam di belakang Pulau Kukusan. Berlokasi di salah satu pulau berbukit dan indah dari kepulauan Indonesia, terdapat beragam agama, bahasa dan pemandangan yang luar biasa yang berpadu dengan laut berwarna biru kristal dan pantai dengan pasir putih yang asli.
          </p>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="./vendor/bootstrap.bundle.min.js"></script>

</body>

</html>