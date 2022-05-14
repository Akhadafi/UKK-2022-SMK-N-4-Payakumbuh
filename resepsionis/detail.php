<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
session_start();

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

if (!isset($_SESSION["login"])) {
  header("Location: ./pelanggan.php");
  exit;
}
if ($_SESSION['role'] != "Resepsionis") {
  echo "
            <script>
                alert('Anda bukan resepsionis!');
                window.location.href = '../admin/kamar.php';
            </script>
        ";
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
// ambil data di URL
$id = $_GET["id"];
// query data berdasarkan id
$DetailProses = mysqli_query($conn, "SELECT * FROM pelanggan,kamar WHERE pelanggan.id_kamar = kamar.id_kamar AND  id = '$id'");
// ambil baris dari query
$ResultDetailProses = mysqli_fetch_assoc($DetailProses);
?>

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
  <title>Cetak</title>
</head>

<body style="margin-top: 70px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Cetak -->

  <div class="toolbar hidden-print container-fluid">
    <div class="text-right">
      <!-- <a href="./pelanggan.php" class="btn btn-warning"><i class="fa fa-print"></i>Kembali</a> -->
      <button id="cetakBukti" class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Print as PDF</button>
    </div>
    <hr>
  </div>
  <div id="cetakBukti" class="container-fluid">
    <div class="row">
      <h1 class="card p-2 mb-3 text-center"><?= $ResultDetailProses['status']; ?></h1>
      <div class="col-lg-6 mb-2">
        <div class="card p-3">
          <a target="_blank" href="">
            <img src="../img/a.jpeg" class="rounded-circle" alt="" width="100" height="100">
          </a>
          <h4>Hotel Hebat</h4>
          <div>Payakumbuh, AZ 0000, EE</div>
          <div>(+62) 800 0000 0000</div>
          <div>hotelhebat@gmail.com</div>
          <div class="date">Date: <?php echo date("F j, Y, g:i a"); ?></div>
          <br>
          <b>Thank you!</b>
          <div>
            NOTICE:
            <p>
              Pastikan berada di hotel kami 30 menit sebelum check in.
              Bukti pemesanan kamar Hotel Hebat - Payakumbuh - Indonesia.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card p-3">
          <h4>Nama pemesan : <?= $ResultDetailProses['nama_pemesan']; ?></h4>
          <div class="email"><a href="mailto:<?= $ResultDetailProses['email']; ?> "><?= $ResultDetailProses['email']; ?></a></div>
          <div>Tipekamar yg dipesan : <?= $ResultDetailProses['nama_kamar']; ?></div>
          <div>Tanggal Pesan : <?= $ResultDetailProses['tgl_pesan']; ?></div>
          <div>Jumlah kamar dipesan : <?= $ResultDetailProses['jml_kamar']; ?></div>
          <div>Chekin : <?= $ResultDetailProses['checkin']; ?></div>
          <div>Chekout : <?= $ResultDetailProses['checkout']; ?></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Cetak -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#cetakBukti').click(function() {
        window.print();
      });
    });
  </script>

</body>

</html>