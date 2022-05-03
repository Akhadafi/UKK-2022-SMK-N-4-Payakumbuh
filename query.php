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

  <button class="btn btn-success" type="submit" name="tambah">Tambah</button>
</form>
<!-- Tambah -->

<!-- Edit -->
<form action="" method="post">
  <?php
  function ubah($data)
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

  if (isset($_POST["ubah"])) {

    if (ubah($_POST) > 0) {
      echo "<script>
                  alert('Data berhasil diubahkan!');
                  document.location.href = '';
                  </script>";
    } else {
      echo mysqli_error($conn);
    }
  }

  ?>
  <div class="mb-2">
    <label for="field1" class="form-label">Tipe Kamar</label>
    <select name="field1" class="form-select" id="field1">
      <option selected>Open this select menu</option>
      <?php
      $field = mysqli_query($conn, "SELECT * FROM field1");
      ?>
      <?php while ($row = mysqli_fetch_assoc($field)) : ?>
        <option value="<?= $row['field1']; ?>">
          <?php if ($row['field1'] == $field['field']) ?>
        </option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-2">
    <label for="field2" class="form-label">Field 2</label>
    <input name="field2" value="field2" type="text" class="form-control" id="field2" placeholder="Field 2">
  </div>

  <button class="btn btn-warning" type="submit" name="ubah">Tambah</button>
</form>
<!-- Edit -->