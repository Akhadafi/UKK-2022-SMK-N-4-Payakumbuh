<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php
  // koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
  // ambil data di URL
  $id = $_GET["id"];
  // query data berdasarkan id
  $DetailFasilitasUmum = mysqli_query($conn, "SELECT * FROM fasilitas_umum WHERE id = '$id'");
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
    <title>Edit</title>
  </head>

<body style="margin-top: 80px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <!-- Edit -->
  <!-- Upload Gambar -->
  <?php
  function uploadGambarFasilitasUmum()
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

    move_uploaded_file($tmpName, '../img/fasilitas_umum/' . $namaFileBaru);

    return $namaFileBaru;
  }
  ?>
  <!-- Upload Gambar -->

  <?php
  function editFasilitasUmum($data)
  {
    global $conn;

    $id = $_GET["id"];
    $nama_fasilitas = htmlspecialchars($data["nama_fasilitas"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLama;
    } else {
      $gambar = uploadGambarFasilitasUmum();
    }

    $queryEditFasilitasUmum = "UPDATE fasilitas_umum SET
				id = $id,
				nama_fasilitas = '$nama_fasilitas',
				keterangan = '$keterangan',
				gambar = '$gambar'
			  WHERE id = $id
			";
    // var_dump($query); die;
    mysqli_query($conn, $queryEditFasilitasUmum);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["fasilitas_umum"])) {

    if (editFasilitasUmum($_POST) > 0) {
      echo "<script>
        alert('Data berhasil diubah!');
        document.location.href = './fasilitas_umum.php';
        </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>

  <div class="container card p-2">
    <form action="" method="post" enctype="multipart/form-data">

      <input type="hidden" name="gambarLama" value="<?= $ResultDetailFasilitasUmum["gambar"]; ?>">

      <div class="mb-2">
        <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
        <input name="nama_fasilitas" type="text" class="form-control" id="nama_fasilitas" placeholder="Nama Fasilitas" value="<?= $ResultDetailFasilitasUmum['nama_fasilitas']; ?>">
      </div>

      <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control" id="keterangan" rows="3"><?= $ResultDetailFasilitasUmum['keterangan']; ?></textarea>
      </div>

      <div class="mb-2">
        <label for="gambar" class="form-label">Gambar</label>
        <img src="../img/fasilitas_umum/<?= $ResultDetailFasilitasUmum['gambar']; ?>" style="width: 120px; height: 70px; margin-bottom: 10px;">
        <input type="file" class="form-control" name="gambar" id="gambar">
      </div>

      <!-- Tombol Edit -->
      <button class="btn btn-warning" type="submit" name="fasilitas_umum">Edit</button>

    </form>
  </div>
  <!-- Edit -->

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