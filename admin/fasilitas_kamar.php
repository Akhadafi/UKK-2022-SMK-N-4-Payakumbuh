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
  <title>Fasilitas Kamar</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Tampil -->
  <div class="card container">
    <div class="table-responsive p-2">
      <!-- Tombol Tambah -->
      <a href="tambah_fasilitas_kamar.php" class="btn btn-primary mb-2 d-block">Tambah
        Fasilitas Kamar</a>

      <table id="fasilitas-umum" class="table table-striped" style="width:100%">
        <thead class="bg-dark text-light">
          <tr>
            <th>Nama Kamar</th>
            <th>Fasilitas</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $resultFasilitasKamar = mysqli_query($conn, "SELECT * FROM fasilitas_kamar,kamar WHERE fasilitas_kamar.id_kamar = kamar.id_kamar");
          ?>
          <?php while ($rowFasilitasKamar = mysqli_fetch_assoc($resultFasilitasKamar)) : ?>
            <tr>
              <td><?= $rowFasilitasKamar['nama_kamar']; ?></td>
              <td><?= $rowFasilitasKamar['fasilitas']; ?></td>
              <td><img src="../img/fasilitas_kamar/<?= $rowFasilitasKamar['gambar']; ?>" alt="gambar" style="width: 120px; height: 70px;"></td>
              <td>
                <a href="detail_fasilitas_kamar.php?id=<?= $rowFasilitasKamar['id']; ?>" class="btn btn-outline-dark">Detail</a>
                <a href="edit_fasilitas_kamar.php?id=<?= $rowFasilitasKamar['id']; ?>" class="btn btn-outline-dark">Edit</a>
                <a href="hapus_fasilitas_kamar.php?id=<?= $rowFasilitasKamar['id']; ?>" class="btn btn-outline-dark">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Tampil -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>
  <!-- Data Tabel -->
  <script>
    $(document).ready(function() {
      $('#fasilitas-umum').DataTable();
    });
  </script>

</body>

</html>