<!-- Tambah -->
<?php
function tambahKamar($data)
{
  global $conn;

  $nama_kamar = htmlspecialchars($data["nama_kamar"]);
  $total_kamar = htmlspecialchars($data["total_kamar"]);

  $resultKamar = mysqli_query($conn, "SELECT nama_kamar FROM kamar WHERE nama_kamar = '$nama_kamar'");

  if (mysqli_fetch_assoc($resultKamar)) {
    echo "<script>
            alert('Sudah terdaftar!')
            </script>";
    return false;
  }

  $queryTambahKamar = "INSERT INTO kamar
          VALUES
          ('','$nama_kamar','$total_kamar')
        ";
  mysqli_query($conn, $queryTambahKamar);

  return mysqli_affected_rows($conn);
}

if (isset($_POST["tambah_kamar"])) {

  if (tambahKamar($_POST) > 0) {
    echo "<script>
                  alert('Data berhasil ditambahkan!');
                  document.location.href = '';
                  </script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>

<form action="" method="post">

  <div class="mb-2">
    <label for="nama_kamar" class="form-label">Nama Kamar</label>
    <input name="nama_kamar" type="text" class="form-control" id="nama_kamar" placeholder="Nama Kamar">
  </div>

  <div class="mb-2">
    <label for="total_kamar" class="form-label">Total Kamar</label>
    <input name="total_kamar" type="number" class="form-control" id="total_kamar" placeholder="total kamar">
  </div>

  <!-- Modal footer -->
  <div class="modal-footer">
    <button class="btn btn-success" type="submit" name="tambah_kamar">Tambah</button>
  </div>

</form>
<!-- Tambah -->