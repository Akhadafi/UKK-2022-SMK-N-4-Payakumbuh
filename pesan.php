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
  <title>Pesan</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Tambah -->
  <?php
  function pesanKamar($data)
  {
    global $conn;

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

    // $validasiKamar = mysqli_query($conn, "SELECT nama_kamar FROM kamar WHERE nama_kamar = '$nama_kamar'");

    // if (mysqli_fetch_assoc($validasiKamar)) {
    //   echo "<script>
    //         alert('Sudah terdaftar!')
    //         </script>";
    //   return false;
    // }

    $querypesanKamar = "INSERT INTO pelanggan VALUES ('','$nama_pemesan','$email','$hp','$nama_tamu','$tgl_pesan','$checkin','$checkout','$jml_kamar','$status','$id_kamar')";
    mysqli_query($conn, $querypesanKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["pesan_kamar"])) {

    if (pesanKamar($_POST) > 0) {
      echo "<script>
              alert('Data berhasil dikirim, mohon untuk menunngu kofirmasi dari resepsionis!');
              document.location.href = './';
            </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post">

      <div class="mb-2">
        <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
        <input name="nama_pemesan" type="text" class="form-control" id="nama_pemesan" placeholder="Nama Pemesan">
      </div>

      <div class="mb-2">
        <label for="email" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
      </div>

      <div class="mb-2">
        <label for="hp" class="form-label">HP</label>
        <input name="hp" type="text" class="form-control" id="hp" placeholder="HP">
      </div>

      <div class="mb-2">
        <label for="nama_tamu" class="form-label">Nama Tamu</label>
        <input name="nama_tamu" type="text" class="form-control" id="nama_tamu" placeholder="Nama Tamu">
      </div>

      <div class="mb-2">
        <label for="tgl_pesan" class="form-label">Tanggal Pesan</label>
        <input name="tgl_pesan" type="date" class="form-control" id="tgl_pesan" placeholder="Tanggal Pesan">
      </div>

      <div class="mb-2">
        <label for="checkin" class="form-label">Checkin</label>
        <input name="checkin" type="date" class="form-control" id="checkin" placeholder="Checkin">
      </div>

      <div class="mb-2">
        <label for="checkout" class="form-label">Checkout</label>
        <input name="checkout" type="date" class="form-control" id="checkout" placeholder="Checkout">
      </div>

      <div class="mb-2">
        <label for="jml_kamar" class="form-label">Jumlah Kamar</label>
        <input name="jml_kamar" type="number" class="form-control" id="jml_kamar" placeholder="Jumlah kamar">
      </div>

      <div class="mb-2">
        <label class="form-label">Status :</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status1" value="Sedang Diproses">
          <label class="form-check-label" for="status1">
            Sedang Diproses
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status2" value="Telah Diproses">
          <label class="form-check-label" for="status2">
            Telah Diproses
          </label>
        </div>
      </div>

      <div class="mb-2">
        <label for="id_kamar" class="form-label">Nama Kamar</label>
        <select name="id_kamar" class="form-select" id="id_kamar">
          <option selected>Pilih Kamar</option>
          <?php
          $kamar = mysqli_query($conn, "SELECT * FROM kamar");
          ?>
          <?php while ($row = mysqli_fetch_assoc($kamar)) : ?>
            <option value="<?= $row['id_kamar']; ?>"><?= $row['nama_kamar']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- Tombol Tambah -->
      <button class="btn btn-success" type="submit" name="pesan_kamar">Pesan</button>

    </form>
  </div>
  <!-- Tambah -->

  <!-- Bootstrap JS -->
  <script src="./vendor/bootstrap.bundle.min.js"></script>

</body>

</html>