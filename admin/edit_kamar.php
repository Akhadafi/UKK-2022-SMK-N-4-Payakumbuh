<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
// ambil data di URL
$id_kamar = $_GET["id_kamar"];
// query data berdasarkan id
$DetailKamar = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar = $id_kamar");
// ambil baris dari query
$ResultDetailKamar = mysqli_fetch_assoc($DetailKamar);
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
  <title>Edit Kamar</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Edit Kamar -->

  <?php
  function editKamar($data)
  {
    global $conn;

    $id_kamar = $_GET["id_kamar"];
    $nama_kamar = htmlspecialchars($data["nama_kamar"]);
    $total_kamar = htmlspecialchars($data["total_kamar"]);

    $queryEditKamar = "UPDATE kamar SET
				id_kamar = $id_kamar,
				nama_kamar = '$nama_kamar',
				total_kamar = '$total_kamar'
			  WHERE id_kamar = $id_kamar
			";
    // var_dump($query); die;
    mysqli_query($conn, $queryEditKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["edit_kamar"])) {

    if (editKamar($_POST) > 0) {
      echo "<script>
        alert('Data berhasil diubah!');
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
        <input name="nama_kamar" value="<?= $ResultDetailKamar['nama_kamar']; ?>" type="text" class="form-control" id="nama_kamar" placeholder="Nama Kamar">
      </div>

      <div class="mb-2">
        <label for="total_kamar" class="form-label">Total Kamar</label>
        <input name="total_kamar" value="<?= $ResultDetailKamar['total_kamar']; ?>" type="number" class="form-control" id="total_kamar" placeholder="Total Kamar">
      </div>

      <!-- Tombol Edit -->
      <button class="btn btn-warning" type="submit" name="edit_kamar">Edit</button>

    </form>
  </div>
  <!-- Edit Kamar -->

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