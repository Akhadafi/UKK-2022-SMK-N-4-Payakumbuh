<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");


function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data)
{
	global $conn;

	$nisn = htmlspecialchars($data["nisn"]);
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$tgl_lahir = htmlspecialchars($data["tgl_lahir"]);
	$id_agama = htmlspecialchars($data["id_agama"]);

	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO siswa
				VALUES
			  ('$nisn', '$nama', '$alamat', '$tgl_lahir', '$id_agama','$gambar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function tambahTipeKamar($data)
{
	global $conn;

	$tipe_kamar = htmlspecialchars($data["tipe_kamar"]);
	$harga = htmlspecialchars($data["harga"]);

	$result = mysqli_query($conn, "SELECT tipe_kamar FROM tipe_kamar WHERE tipe_kamar = '$tipe_kamar'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Sudah terdaftar!')
		      </script>";
		return false;
	}


	$query = "INSERT INTO tipe_kamar
				VALUES
			  ('$tipe_kamar','$harga')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function editTipeKamar($data)
{
	global $conn;

	$tipe_kamar = mysqli_real_escape_string($conn, $data["tipe_kamar"]);
	$harga = mysqli_real_escape_string($conn, $data["harga"]);

	$query = "UPDATE tipe_kamar SET
                      tipe_kamar = '$tipe_kamar',
                      harga = '$harga'
                      WHERE tipe_kamar = '$tipe_kamar'
                      ";
	// var_dump($query); die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function tambahFasilitasKamar($data)
{
	global $conn;

	$fasilitas_kamar = htmlspecialchars($data["fasilitas_kamar"]);

	$result = mysqli_query($conn, "SELECT fasilitas_kamar FROM fasilitas_kamar WHERE fasilitas_kamar = '$fasilitas_kamar'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Sudah terdaftar!')
		      </script>";
		return false;
	}


	$query = "INSERT INTO fasilitas_kamar
				VALUES
			  ('$fasilitas_kamar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function edit_fasilitasKamar($data)
{
	global $conn;

	$fasilitas_kamar = strtolower(stripslashes($data["fasilitas_kamar"]));

	$result = mysqli_query($conn, "SELECT fasilitas_kamar FROM fasilitas_kamar WHERE fasilitas_kamar = '$fasilitas_kamar'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Sudah terdaftar!')
		      </script>";
		return false;
	}

	$query = "UPDATE fasilitas_kamar SET
                      fasilitas_kamar = '$fasilitas_kamar'
                      WHERE fasilitas_kamar = '$fasilitas_kamar'
                      ";
	// var_dump($query); die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahTipeFasilitasKamar($data)
{
	global $conn;

	$tipe_fasilitas_kamar = htmlspecialchars($data["tipe_fasilitas_kamar"]);

	$result = mysqli_query($conn, "SELECT tipe_fasilitas_kamar FROM tipe_fasilitas_kamar WHERE fasilitas_kamar = '$tipe_fasilitas_kamar'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Sudah terdaftar!')
		      </script>";
		return false;
	}


	$query = "INSERT INTO tipe_fasilitas_kamar
				VALUES
			  ('$tipe_fasilitas_kamar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function upload()
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

	move_uploaded_file($tmpName, '../img/user/pp/' . $namaFileBaru);

	return $namaFileBaru;
}


function hapus($username)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM user WHERE username = '$username'");
	return mysqli_affected_rows($conn);
}


function ubah($data)
{
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$nama = mysqli_real_escape_string($conn, $data["nama"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$role = mysqli_real_escape_string($conn, $data["role"]);
	$no_hp = mysqli_real_escape_string($conn, $data["no_hp"]);
	$alamat = mysqli_real_escape_string($conn, $data["alamat"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE user SET
				username = '$username',
				nama = '$nama',
				alamat = '$alamat',
				password = '$password',
				role = '$role',
				no_hp = '$no_hp',
				gambar = '$gambar'
			  WHERE username = '$username'
			";
	// var_dump($query); die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
	$query = "SELECT * FROM siswa
						INNER JOIN agama
						ON siswa.id_agama = agama.id_agama
						WHERE
			  		nisn LIKE '%$keyword%' OR
						nama LIKE '%$keyword%' OR
						alamat LIKE '%$keyword%' OR
						agama LIKE '%$keyword%' OR
						tgl_lahir LIKE '%$keyword%'
					";
	return query($query);
}


function registrasi($data)
{
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$role = strtolower(stripslashes($data["role"]));
	$nama = strtolower(stripslashes($data["nama"]));
	$no_hp = strtolower(stripslashes($data["no_hp"]));
	$alamat = strtolower(stripslashes($data["alamat"]));
	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('$username', '$password', '$gambar','$role','$nama','$no_hp','$alamat')");

	return mysqli_affected_rows($conn);
}
