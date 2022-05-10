<!-- koneksi data base -->
<?php
$conn = mysqli_connect("localhost", "root", "", "nama_database");
?>
<!-- koneksi data base -->


<!-- Upload Gambar -->
<?php
function uploadGambar()
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

  move_uploaded_file($tmpName, '../asset/img/' . $namaFileBaru);

  return $namaFileBaru;
}
?>
<!-- Upload Gambar -->


<!-- Tampil -->
<?php
$result = mysqli_query($conn, "SELECT * FROM nama_tabel");
?>

<?php while ($baris = mysqli_fetch_assoc($result)) : ?>
  <tr>
    <td><?= $baris['field']; ?></td>
  </tr>
<?php endwhile; ?>
<!-- Tampil -->


<!-- Tambah -->
<?php
function tambah($data)
{
  global $conn;

  $field1 = htmlspecialchars($data["field1"]);
  $field2 = htmlspecialchars($data["field2"]);
  // upload gambar
  $gambar = uploadGambar();
  if (!$gambar) {
    return false;
  }

  $result = mysqli_query($conn, "SELECT field1 FROM nama_tabel WHERE field1 = '$field1'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Sudah terdaftar!')
            </script>";
    return false;
  }


  $query = "INSERT INTO nama_tabel
          VALUES
          ('','$field1','$field2','$gambar')
        ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if (isset($_POST["tambah"])) {

  if (tambah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = '';
          </script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-2">
    <label for="field1" class="form-label">Tipe Kamar</label>
    <select name="field1" class="form-select" id="field1">
      <option selected>Open this select menu</option>
      <?php
      $field = mysqli_query($conn, "SELECT * FROM field1");
      ?>
      <?php while ($row = mysqli_fetch_assoc($field)) : ?>
        <option value="<?= $row['field1']; ?>"><?= $row['field']; ?></option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-2">
    <label for="field2" class="form-label">Field 2</label>
    <input name="field2" type="text" class="form-control" id="field2" placeholder="Field 2">
  </div>

  <div class="mb-2">
    <label for="gambar" class="form-label">Gambar</label>
    <input name="gambar" class="form-control" type="file" id="gambar">
  </div>

  <button class="btn btn-success" type="submit" name="tambah">Tambah</button>
</form>
<!-- Tambah -->


<!-- Edit -->
<?php
// ambil data di URL
$id = $_GET["id"];
// query data berdasarkan id
$field = mysqli_query($conn, "SELECT * FROM nama_tabel WHERE id = $id");
?>

<?php
function ubah($data)
{
  global $conn;

  $id = $_GET["id"];
  $field1 = htmlspecialchars($data["field1"]);
  $field2 = htmlspecialchars($data["field2"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar baru atau tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = uploadGambar();
  }

  $query = "UPDATE nama_tabel SET
				id = '$id',
				field1 = '$field1',
				field2 = '$field2',
        gambar = '$gambar'
			  WHERE id = $id
			";
  // var_dump($query); die;
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if (isset($_POST["ubah"])) {

  if (ubah($_POST) > 0) {
    echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = '';
          </script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="mb-2">
    <label for="id_field" class="form-label">Nama Kamar</label>
    <select name="id_field" class="form-select" id="id_field">
      <?php
      $field = mysqli_query($conn, "SELECT * FROM nama_tabel");
      ?>
      <?php while ($rowfield = mysqli_fetch_assoc($field)) : ?>
        <?php if ($resultField == $rowfield['id_field']) { ?>
          <option selected value="<?= $rowfield['id_field']; ?>"><?= $rowfield['nama_field']; ?></option>
        <?php
        } else { ?>
          <option value="<?= $rowfield['id_field']; ?>"><?= $rowfield['nama_field']; ?></option>
        <?php } ?>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-2">
    <label for="field2" class="form-label">Field 2</label>
    <input name="field2" value="field2" type="text" class="form-control" id="field2" placeholder="Field 2">
  </div>

  <div class="mb-2">
    <label for="gambar" class="form-label">Gambar</label>
    <img src="../asset/img/<?= $field['gambar']; ?>" width="40">
    <input name="gambarLama" value="<?= $field['gambar']; ?>" class="form-control" type="file" id="gambar">
  </div>

  <button class="btn btn-warning" type="submit" name="ubah">Tambah</button>

</form>
<!-- Edit -->


<!-- Hapus -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

$id = $_GET["id"];

function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM nama_tabel WHERE id = $id");
  return mysqli_affected_rows($conn);
}

if (hapus($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>
	";
} else {
  echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'index.php';
		</script>
	";
}
?>
<!-- Hapus -->


<!-- Login -->
<?php
// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if ($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1) {

    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      // set session
      $_SESSION["login"] = true;

      // cek remember me
      if (isset($_POST['remember'])) {
        // buat cookie
        setcookie('id', $row['id'], time() + 60);
        setcookie('key', hash('sha256', $row['username']), time() + 60);
      }

      header("Location: index.php");
      exit;
    }
  }

  $error = true;
}
?>


<?php if (isset($error)) : ?>
  <p style="color: red; font-style: italic;">username / password salah</p>
<?php endif; ?>

<form action="" method="post">

  <ul>
    <li>
      <label for="username">Username :</label>
      <input type="text" name="username" id="username">
    </li>
    <li>
      <label for="password">Password :</label>
      <input type="password" name="password" id="password">
    </li>
    <li>
      <input type="checkbox" name="remember" id="remember">
      <label for="remember">Remember me</label>
    </li>
    <li>
      <button type="submit" name="login">Login</button>
    </li>
  </ul>

</form>
<!-- Login -->


<!-- Logout -->
<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

header("Location: login.php");
exit;

?>
<!-- Logout -->