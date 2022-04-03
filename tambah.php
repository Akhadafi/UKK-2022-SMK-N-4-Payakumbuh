<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil di tambahkan atau tidak
  if (tambah($_POST) > 0) {
    echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
  } else {
    echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tambah</title>
  <style>
    label {
      display: block;
    }
  </style>
</head>

<body>
  <h1>Tambah Siswa</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <ul>
      <l1>
        <label for="nisn">NISN :</label>
        <input type="text" name="nisn" id="nisn">
      </l1>
      <br>
      <l1>
        <label for="nama">Nama :</label>
        <input type="text" name="nama" id="nama">
      </l1>
      <br>
      <l1>
        <label for="agama">Agama :</label>
        <select name="id_agama" id="agama">
          <option selected>agama..</option>
          <?php
          $agama = mysqli_query($conn, "SELECT * FROM agama");
          while ($row = mysqli_fetch_assoc($agama)) : ?>
            <option value="<?= $row['id_agama']; ?>"><?= $row['agama']; ?></option>
          <?php endwhile; ?>
        </select>
      </l1>
      <br>
      <l1>
        <label for="tgl_lahir">Tanggal Lahir :</label>
        <input type="date" name="tgl_lahir" id="tgl_lahir">
      </l1>
      <br>
      <l1>
        <label for="gambar">Gambar :</label>
        <input type="file" name="gambar" id="gambar">
      </l1>
      <br>
      <l1>
        <label for="alamat">Alamat :</label>
        <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
      </l1>
      <li>
        <button type="submit" name="submit">Tambah</button>
      </li>
    </ul>
  </form>
</body>

</html>