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
  <title>Tambah</title>
</head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Tambah -->
  <!-- Upload Gambar -->
  <?php
  function uploadGambarFasilitasKamar()
  {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
      echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
      return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
      return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
      echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
      return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/fasilitas_kamar/' . $namaFileBaru);

    return $namaFileBaru;
  }
  ?>
  <!-- Upload Gambar -->

  <?php
  function tambahFasilitasKamar($data)
  {
    global $conn;

    $id_kamar = htmlspecialchars($data["id_kamar"]);
    $fasilitas = htmlspecialchars($data["fasilitas"]);
    // upload gambar
    $gambarFasilitasKamar = uploadGambarFasilitasKamar();
    if (!$gambarFasilitasKamar) {
      return false;
    }

    // $result = mysqli_query($conn, "SELECT fasilitas FROM fasilitas_kamar WHERE fasilitas = '$fasilitas'");

    // if (mysqli_fetch_assoc($result)) {
    //   echo "<script>
    //         alert('Sudah terdaftar!')
    //         </script>";
    //   return false;
    // }


    $queryTamabahFasilitasKamar = "INSERT INTO fasilitas_kamar
          VALUES
          ('','$id_kamar','$fasilitas','$gambarFasilitasKamar')
        ";
    mysqli_query($conn, $queryTamabahFasilitasKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["tambah_fasilitas_kamar"])) {

    if (tambahFasilitasKamar($_POST) > 0) {
      echo "<script>
              alert('Data berhasil ditambahkan!');
              document.location.href = './fasilitas_kamar.php';
            </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post" enctype="multipart/form-data">

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

      <div class="mb-2">
        <label for="fasilitas" class="form-label">Fasilitas</label>
        <input name="fasilitas" type="text" class="form-control" id="fasilitas" placeholder="Fasilitas">
      </div>

      <div class="mb-2">
        <label for="gambar" class="form-label">Gambar</label>
        <input name="gambar" class="form-control" type="file" id="gambar">
      </div>

      <!-- Tombol Tambah -->
      <button class="btn btn-success" type="submit" name="tambah_fasilitas_kamar">Tambah</button>

    </form>
  </div>
  <!-- Tambah -->

  <!-- Bootstrap JS -->
  <script src="../vendor/bootstrap.bundle.min.js"></script>

</body>

</html>