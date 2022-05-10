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
  <title>Tambah Kamar</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Tambah Kamar -->
  <?php
  function tambahKamar($data)
  {
    global $conn;

    $nama_kamar = htmlspecialchars($data["nama_kamar"]);
    $total_kamar = htmlspecialchars($data["total_kamar"]);

    $validasiKamar = mysqli_query($conn, "SELECT nama_kamar FROM kamar WHERE nama_kamar = '$nama_kamar'");

    if (mysqli_fetch_assoc($validasiKamar)) {
      echo "<script>
            alert('Sudah terdaftar!')
            </script>";
      return false;
    }

    $queryTambahKamar = "INSERT INTO kamar VALUES ('','$nama_kamar','$total_kamar')";
    mysqli_query($conn, $queryTambahKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["tambah_kamar"])) {

    if (tambahKamar($_POST) > 0) {
      echo "<script>
              alert('Data berhasil ditambahkan!');
              document.location.href = './kamar.php';
            </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post">

      <div class="mb-2">
        <label for="nama_kamar" class="form-label">Nama Kamar</label>
        <input name="nama_kamar" type="text" class="form-control" id="nama_kamar" placeholder="Nama Kamar">
      </div>

      <div class="mb-2">
        <label for="total_kamar" class="form-label">Total Kamar</label>
        <input name="total_kamar" type="number" class="form-control" id="total_kamar" placeholder="total kamar">
      </div>

      <!-- Tombol Tambah -->
      <button class="btn btn-success" type="submit" name="tambah_kamar">Tambah</button>

    </form>
  </div>
  <!-- Tambah Kamar -->

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