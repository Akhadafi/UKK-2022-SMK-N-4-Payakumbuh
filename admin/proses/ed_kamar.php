<!-- Tambah -->
<form action="" method="post">

  <?php
  function editKamar($data)
  {
    global $conn;

    $id_kamar = $_GET["id_kamar"];
    $nama_kamar = htmlspecialchars($data["nama_kamar"]);
    $total_kamar = htmlspecialchars($data["total_kamar"]);

    $queryEditKamar = "UPDATE kamar SET
				id_kamar = $id_kamar,
				nama_kamar = '$nama_kamar',
				total_kamar = '$total_kamar'
			  WHERE id_kamar = $id_kamar
			";
    // var_dump($query); die;
    mysqli_query($conn, $queryEditKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["edit_kamar"])) {

    if (editKamar($_POST) > 0) {
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
    <label for="nama_kamar" class="form-label">Nama Kamar</label>
    <input name="nama_kamar" value="<?= $ResultDetailKamar['nama_kamar']; ?>" type="text" class="form-control" id="nama_kamar" placeholder="Nama Kamar">
  </div>

  <div class="mb-2">
    <label for="total_kamar" class="form-label">Total Kamar</label>
    <input name="total_kamar" value="<?= $ResultDetailKamar['total_kamar']; ?>" type="number" class="form-control" id="total_kamar" placeholder="Total Kamar">
  </div>

  <!-- Modal footer -->
  <div class="modal-footer">
    <button class="btn btn-success" type="submit" name="edit_kamar">Edit</button>
  </div>

</form>
<!-- Tambah -->