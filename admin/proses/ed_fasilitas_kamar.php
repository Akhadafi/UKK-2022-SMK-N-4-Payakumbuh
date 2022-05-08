<!-- Tambah -->
<form action="" method="post">

  <?php
  function editFasilitasKamar($data)
  {
    global $conn;

    $id = $_GET["id_fasilitas_kamar"];
    $id_kamar = htmlspecialchars($data["id_kamar"]);
    $fasilitas = htmlspecialchars($data["fasilitas"]);
    $gambarLamaFasilitasKamar = htmlspecialchars($data["gambarLamaFasilitasKamar"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarLamaFasilitasKamar;
    } else {
      $gambar = uploadGambar();
    }

    $queryEditKamar = "UPDATE fasilitas_kamar SET
				id = $id,
				id_kamar = '$id_kamar',
				fasilitas = '$fasilitas',
        gambar = '$gambar'
			  WHERE id = $id
			";
    // var_dump($query); die;
    mysqli_query($conn, $queryEditKamar);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["edit_fasilitas_kamar"])) {

    if (editFasilitasKamar($_POST) > 0) {
      echo "<script>
              alert('Data berhasil diubah!');
              document.location.href = '';
            </script>";
    } else {
      echo mysqli_error($conn);
    }
  }
  ?>


  <div class="mb-2">
    <label for="id_kamar" class="form-label">Nama Kamar</label>
    <select name="id_kamar" class="form-select" id="id_kamar">
      <?php
      $kamar = mysqli_query($conn, "SELECT * FROM kamar");
      ?>
      <?php while ($rowKamar = mysqli_fetch_assoc($kamar)) : ?>
        <?php if ($ResultDetailFasilitasKamar == $rowKamar['id_kamar']) { ?>
          <option selected value="<?= $rowKamar['id_kamar']; ?>"><?= $rowKamar['nama_kamar']; ?></option>
        <?php } else { ?>
          <option value="<?= $rowKamar['id_kamar']; ?>"><?= $rowKamar['nama_kamar']; ?></option>
        <?php } ?>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-2">
    <label for="fasilitas" class="form-label">Total Kamar</label>
    <input name="fasilitas" value="<?= $ResultDetailFasilitasKamar['fasilitas']; ?>" type="text" class="form-control" id="fasilitas" placeholder="Total Kamar">
  </div>

  <div class="mb-2">
    <label for="gambar" class="form-label">Gambar</label>
    <img src="../../vendor/img/fasilitas_kamar/<?= $ResultDetailFasilitasKamar['gambar']; ?>" style="width: 120px; height: 70px; margin-bottom: 10px;">
    <input name="gambarLamaFasilitasKamar" value="<?= $ResultDetailFasilitasKamar['gambar']; ?>" class="form-control" type="file" id="gambar">
  </div>

  <!-- Modal footer -->
  <div class="modal-footer">
    <button class="btn btn-warning" type="submit" name="edit_fasilitas_kamar">Edit</button>
  </div>

</form>
<!-- Tambah -->