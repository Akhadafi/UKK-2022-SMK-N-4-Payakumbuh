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
            <h4>Nama Fasilitas: </h4>
            <h5><?= $ResultDetailFasilitasUmum['nama_fasilitas']; ?></h5>
          </td>
          <td>
            <h4>Keterangan: </h4>
            <h5><?= $ResultDetailFasilitasUmum['keterangan']; ?></h5>
          </td>
          <td>
            <h4>Gambar: </h4>
            <img src="../img/fasilitas_umum/<?= $ResultDetailFasilitasUmum['gambar']; ?>" alt="gambar" style="width: 120px; height: 70px;">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- Detail -->

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