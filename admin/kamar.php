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

  <!-- Tampil Kamar -->
  <div class="card container">
    <div class="table-responsive p-2">
      <!-- Tombol Tambah -->
      <a href="tambah_kamar.php" class="btn btn-primary mb-2 d-block">Tambah Kamar</a>

      <table id="kamar" class="table table-striped" style="width:100%">
        <thead class="bg-dark text-light">
          <tr>
            <th>Nama Kamar</th>
            <th>Jumlah Kamar</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $resultKamar = mysqli_query($conn, "SELECT * FROM kamar");
          ?>
          <?php while ($rowKamar = mysqli_fetch_assoc($resultKamar)) : ?>
            <tr>
              <td><?= $rowKamar['nama_kamar']; ?></td>
              <td><?= $rowKamar['total_kamar']; ?></td>
              <td>
                <a href="detail_kamar.php?id_kamar=<?= $rowKamar['id_kamar']; ?>" class="btn btn-outline-dark">Detail</a>
                <a href="edit_kamar.php?id_kamar=<?= $rowKamar['id_kamar']; ?>" class="btn btn-outline-dark">Edit</a>
                <a href="hapus_kamar.php?id_kamar=<?= $rowKamar['id_kamar']; ?>" class="btn btn-outline-dark">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Tampil Kamar -->

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