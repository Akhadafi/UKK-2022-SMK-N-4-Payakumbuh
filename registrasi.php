<?php
require 'functions.php';

if (isset($_POST["register"])) {

  if (registrasi($_POST) > 0) {
    echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
  } else {
    echo mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Halaman Registrasi</title>
  <style>
    label {
      display: block;
    }
  </style>
</head>

<body>

  <h1>Halaman Registrasi</h1>

  <form action="" method="post" enctype="multipart/form-data">

    <ul>
      <li>
        <label for="username">username :</label>
        <input type="text" name="username" id="username">
      </li>
      <li>
        <label for="password">password :</label>
        <input type="password" name="password" id="password">
      </li>
      <li>
        <label for="password2">konfirmasi password :</label>
        <input type="password" name="password2" id="password2">
      </li>
      <input type="hidden" name="role" id="role" value="Tamu">
      <li>
        <label for="nama">Nama :</label>
        <input type="text" name="nama" id="nama">
      </li>
      <li>
        <label for="no_hp">No HP :</label>
        <input type="text" name="no_hp" id="no_hp">
      </li>
      <li>
        <label for="alamat">Alamat :</label>
        <textarea name="alamat" id="alamat" rows="5"></textarea>
      </li>
      <l1>
        <label for="gambar">Gambar :</label>
        <input type="file" name="gambar" id="gambar">
      </l1>
      <li>
        <button type="submit" name="register">Register!</button>
      </li>
    </ul>

  </form>

</body>

</html>