<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

// ambil data di URL
$nisn = $_GET["nisn"];

// query data mahasiswa berdasarkan nisn
$siswa = query("SELECT * FROM siswa INNER JOIN agama
ON siswa.id_agama = agama.id_agama WHERE nisn = $nisn")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

	// cek apakah data berhasil diubah atau tidak
	if (ubah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ubah data Siswa</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>

<body>
	<h1>Ubah data Siswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="nisn" value="<?= $siswa["nisn"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $siswa["gambar"]; ?>">
		<ul>
			<l1>
				<label for="nama">Nama :</label>
				<input type="text" name="nama" id="nama" value="<?= $siswa["nama"]; ?>">
			</l1>
			<br>
			<l1>
				<label for="agama">Agama :</label>
				<select name="id_agama" id="agama">
					<?php
					$row = mysqli_query($conn, "SELECT * FROM agama");
					while ($agama = mysqli_fetch_assoc($row)) : ?>
						<option value="<?= $agama['id_agama']; ?>" <?php if ($agama['id_agama'] == $siswa['id_agama']) {
																													echo 'selected';
																												} else {
																													echo '';
																												} ?>><?= $agama['agama']; ?>
						</option>
					<?php endwhile; ?>
				</select>
			</l1>
			<br>
			<l1>
				<label for="tgl_lahir">Tanggal Lahir :</label>
				<input type="date" name="tgl_lahir" id="tgl_lahir" value="<?= $siswa['tgl_lahir']; ?>">
			</l1>
			<br>
			<l1>
				<label for="gambar">Gambar :</label>
				<img src="../asset/img/proile/<?= $siswa['gambar']; ?>" width="40">
				<input type="file" name="gambar" id="gambar">
			</l1>
			<br>
			<l1>
				<label for="alamat">Alamat :</label>
				<textarea name="alamat" id="alamat" cols="30" rows="10"><?= $siswa['alamat']; ?></textarea>
			</l1>
			<li>
				<button type="submit" name="submit">Tambah</button>
			</li>
		</ul>

	</form>




</body>

</html>