<?php include '../koneksi.php'; ?>

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

  <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <div class="container-fluid">
      <h4><a class="nav-link text-white">ADMIN</a></h4>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <h5><a class="nav-link" href="#" id="tombol_kamar">Kamar</a></h5>
          </li>
          <li class="nav-item">
            <h5><a class="nav-link" href="#" id="tombol_fasilitas_kamar">Fasilitas Kamar</a></h5>
          </li>
          <li class="nav-item">
            <h5><a class="nav-link" href="#" id="tombol_fasilitas_umum">Fasilitas Umum</a></h5>
          </li>
          <li class="nav-item">
            <h5><a class="nav-link" href="logout.php" id="">Logout</a></h5>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <div class="container-fluid" id="panel_kamar">
    <?php
    include './proses/kamar.php'
    ?>
  </div>

  <div class="container-fluid" id="panel_fasilitas_kamar">
    <?php
    include './proses/fasilitas_kamar.php'
    ?>
  </div>

  <div class="container-fluid" id="panel_fasilitas_umum">
    <?php
    include './proses/fasilitas_umum.php'
    ?>
  </div>


  <!-- SCRIPT FOOTER -->
  <div class="mt-5 p-2 bg-dark text-white text-center">
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