<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>
<?php
function Proses($data)
{
  global $conn;

  $id = $_GET["id"];
  $nama_pemesan = htmlspecialchars($data["nama_pemesan"]);
  $email = htmlspecialchars($data["email"]);
  $hp = htmlspecialchars($data["hp"]);
  $nama_tamu = htmlspecialchars($data["nama_tamu"]);
  $tgl_pesan = htmlspecialchars($data["tgl_pesan"]);
  $checkin = htmlspecialchars($data["checkin"]);
  $checkout = htmlspecialchars($data["checkout"]);
  $jml_kamar = htmlspecialchars($data["jml_kamar"]);
  $status = htmlspecialchars($data["status"]);
  $id_kamar = htmlspecialchars($data["id_kamar"]);

  $queryProses = "UPDATE pelanggan SET
      id = $id,
      nama_pemesan = '$nama_pemesan',
      email = '$email',
      hp = '$hp',
      nama_tamu = '$nama_tamu',
      tgl_pesan = '$tgl_pesan',
      checkin = '$checkin',
      checkout = '$checkout',
      jml_kamar = '$jml_kamar',
      status = '$status',
      id_kamar = '$id_kamar'
      WHERE id = $id
    ";
  // var_dump($query); die;
  mysqli_query($conn, $queryProses);

  return mysqli_affected_rows($conn);
}

if (isset($_POST["proses"])) {

  if (Proses($_POST) > 0) {
    echo "<script>
      alert('Data berhasil di proses,silahkan cetak bukti pemesanan!');
      document.location.href = './pelanggan.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }
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
$DetailProses = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = '$id'");
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

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <div class="container card p-2">
    <form action="" method="post">
      <input type="hidden" name="nama_pemesan" value="<?= $ResultDetailProses["nama_pemesan"]; ?>">
      <input type="hidden" name="email" value="<?= $ResultDetailProses["email"]; ?>">
      <input type="hidden" name="hp" value="<?= $ResultDetailProses["hp"]; ?>">
      <input type="hidden" name="nama_tamu" value="<?= $ResultDetailProses["nama_tamu"]; ?>">
      <input type="hidden" name="tgl_pesan" value="<?= $ResultDetailProses["tgl_pesan"]; ?>">
      <input type="hidden" name="checkin" value="<?= $ResultDetailProses["checkin"]; ?>">
      <input type="hidden" name="checkout" value="<?= $ResultDetailProses["checkout"]; ?>">
      <input type="hidden" name="jml_kamar" value="<?= $ResultDetailProses["jml_kamar"]; ?>">
      <input type="hidden" name="id_kamar" value="<?= $ResultDetailProses["id_kamar"]; ?>">
      <?php if ($ResultDetailProses['status'] == 'Sedang Diproses') : ?>
        <label class="form-label">Status :</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status1" value="Sedang Diproses" style="background-color:transparent" checked>
          <label class="form-check-label" for="status1">
            Sedang Diproses
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status2" value="Telah Diproses" style="background-color:transparent">
          <label class="form-check-label" for="status2">
            Telah Diproses
          </label>
        </div>
      <?php endif; ?>
      <?php if ($ResultDetailProses['status'] == 'Telah Diproses') : ?>
        <label class="form-label">Jenis Kelamin res$ResultDetailProses :</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status1" value="Sedang Diproses" style="background-color:transparent">
          <label class="form-check-label" for="status1">
            Sedang Diproses
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status2" value="Telah Diproses" style="background-color:transparent" checked>
          <label class="form-check-label" for="status2">
            Telah Diproses
          </label>
        </div>
      <?php endif; ?>

      <button class="btn btn-info" type="submit" name="proses">Proses</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>

</body>

</html>