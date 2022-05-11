<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
// ambil data di URL
$id = $_GET["id"];
// query data berdasarkan id
$DetailFasilitasKamar = mysqli_query($conn, "SELECT * FROM fasilitas_kamar,kamar WHERE fasilitas_kamar.id_kamar = kamar.id_kamar AND id = $id");
// ambil baris dari query
$ResultDetailFasilitasKamar = mysqli_fetch_assoc($DetailFasilitasKamar);
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
  <title>Detail</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Detail -->
  <div class="container">
    <table class="table table-striped" style="width:100%">
      <tbody>
        <tr>
          <td>
            <h4>Nama kamar: </h4>
            <h5><?= $ResultDetailFasilitasKamar['nama_kamar']; ?></h5>
          </td>
          <td>
            <h4>Fasilitas: </h4>
            <h5><?= $ResultDetailFasilitasKamar['fasilitas']; ?></h5>
          </td>
          <td>
            <h4>Gambar: </h4>
            <img src="../img/fasilitas_kamar/<?= $ResultDetailFasilitasKamar['gambar']; ?>" alt="gambar" style="width: 120px; height: 70px;">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- Detail -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>

</body>

</html>