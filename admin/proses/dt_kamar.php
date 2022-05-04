<?php
include '../../koneksi.php';
// ambil data di URL
$id_kamar = $_GET["id_kamar"];
// query data berdasarkan id
$DetailKamar = mysqli_query($conn, "SELECT * FROM kamar WHERE id_kamar = $id_kamar");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin - Hotel Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>

  <div class="p-2 bg-secondary text-white text-center">
    <h1>HOTEL HEBAT</h1>
    <p>Selamat datang di Hotel Hebat Labuan Bajo Indonesia!</p>
  </div>

  <nav class="navbar navbar-dark bg-primary">
    <div class="container mt-2">
      <h4><a href="../home.php" class="btn btn-outline-dark">KEMBALI</a></h4>
      <h5 class="ml-auto">DETAIL KAMAR</h5>
    </div>
  </nav>


  <div class="container mt-3">
    <table class="table table-striped" style="width:100%">
      <tbody>
        <?php
        $ResultDetailKamar = mysqli_fetch_assoc($DetailKamar);
        ?>
        <tr>
          <td>
            <h4>Nama kamar: </h3>
              <h5><?= $ResultDetailKamar['nama_kamar']; ?></h5>
          </td>
          <td>
            <h4>Total kamar: </h3>
              <h5><?= $ResultDetailKamar['total_kamar']; ?></h5>
          <td>
            <div class="mt-3 d-flex">
              <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-warning text-light mx-2" data-bs-toggle="modal" data-bs-target="#modalEditKamar">
                Edit
              </button>

              <!-- The Modal -->
              <div class="modal fade" id="modalEditKamar">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Modal Heading</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <?php
                      include 'ed_kamar.php'
                      ?>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusKamar">
                Hapus
              </button>

              <!-- The Modal -->
              <div class="modal fade" id="modalHapusKamar">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Modal Heading</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <p>yakin hapus "<?= $ResultDetailKamar['nama_kamar']; ?>"</p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
                      <a href="./hp_kamar.php" class="btn btn-danger">Hapus</a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <!-- SCRIPT FOOTER -->
  <div class="fixed-bottom pt-3 bg-dark text-white text-center">
    <p>@Desain by UKK RPL 2022</p>
  </div>

  <!-- SCRIPT JAVASCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {

      /*KONDISI SAAT WEBSITE DIJALANKAN PERTAMA KALI*/
      $('#panel_kamar').show();
      $('#panel_fasilitas_kamar').hide();
      $('#panel_fasilitas_umum').hide();


      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_kamar").click(function() {
        $('#panel_kamar').show();
        $('#panel_fasilitas_kamar').hide();
        $('#panel_fasilitas_umum').hide();
      });


      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_fasilitas_kamar").click(function() {
        $('#panel_fasilitas_kamar').show();
        $('#panel_fasilitas_umum').hide();
        $('#panel_kamar').hide();
      });


      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_fasilitas_umum").click(function() {
        $('#panel_fasilitas_umum').show();
        $('#panel_fasilitas_kamar').hide();
        $('#panel_kamar').hide();
      });

    });

    $(document).ready(function() {
      $('#kamar').DataTable();
    });
    $(document).ready(function() {
      $('#fasilitas_kamar').DataTable();
    });
    $(document).ready(function() {
      $('#fasilitas_umum').DataTable();
    });
  </script>
  <!-- END BODY -->
</body>

</html>