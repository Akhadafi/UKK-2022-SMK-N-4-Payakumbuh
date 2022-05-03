<!-- koneksi data base -->
<?php
$conn = mysqli_connect("localhost", "root", "", "nama_database");
?>
<!-- koneksi data base -->


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
<form action="" method="post">
  <?php
  function tambah($data)
  {
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $field1 = htmlspecialchars($data["field1"]);
    $field2 = htmlspecialchars($data["field2"]);

    $result = mysqli_query($conn, "SELECT field1 FROM nama_tabel WHERE field1 = '$field1'");

    if (mysqli_fetch_assoc($result)) {
      echo "<script>
            alert('Sudah terdaftar!')
            </script>";
      return false;
    }


    $query = "INSERT INTO nama_tabel
          VALUES
          ('','$field1','$field2')
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
  <div class="mb-2">
    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
    <select class="form-select" aria-label="Default select example">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
  </div>

  <div class="mb-2">
    <label for="nama_kamar" class="form-label">Nama Kamar</label>
    <input name="nama_kamar" type="text" class="form-control" style="background-color:transparent" id="nama_kamar" placeholder="Nama Kamar">
  </div>

  <div class="mb-2">
    <label for="jumlah_kamar" class="form-label">Jumlah Kamar</label>
    <input name="jumlah_kamar" type="number" class="form-control" style="background-color:transparent" id="jumlah_kamar" placeholder="Jumlah Kamar">
  </div>
</form>
<!-- Tambah -->