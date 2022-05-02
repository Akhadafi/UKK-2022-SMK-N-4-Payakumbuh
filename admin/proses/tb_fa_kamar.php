<form action="" method="post">
  <?php
  function tambahFasilitasKamar($data)
  {
    global $conn;

    $id_fasilitas_kamar = htmlspecialchars($data["id_fasilitas_kamar"]);
    $nama_kamar = htmlspecialchars($data["nama_kamar"]);
    $jumlah_kamar = htmlspecialchars($data["jumlah_kamar"]);

    $result = mysqli_query($conn, "SELECT nama_kamar FROM nama_kamar WHERE nama_kamar = '$nama_kamar'");

    if (mysqli_fetch_assoc($result)) {
      echo "<script>
          alert('Sudah terdaftar!')
            </script>";
      return false;
    }


    $query = "INSERT INTO kamar
          VALUES
          ('$id_fasilitas_kamar','$jumlah_kamar','$jumlah_kamar')
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  if (isset($_POST["ta_kamar"])) {

    if (tambahFasilitasKamar($_POST) > 0) {
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
    <label for="tipe_kamar" class="form-label">Nama Kamar</label>
    <input name="tipe_kamar" type="text" class="btn-outline-info form-control" style="background-color:transparent" id="tipe_kamar" placeholder="Nama Kamar">
  </div>

  <div class="mb-2">
    <label for="harga" class="form-label">Harga Kamar</label>
    <input name="harga" type="number" class="btn-outline-info form-control" style="background-color:transparent" id="harga" placeholder="Jumlah Kamar">
  </div>
</form>