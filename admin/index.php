<?php
session_start();

require 'functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}
if ($_SESSION['role'] != "Admin") {
  echo "
            <script>
                // alert('Anda bukan admin!');
                window.location.href = '../logout.php';
            </script>
        ";
}
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../asset/datatabels/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="../asset/datatabels/dataTables.bootstrap5.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

  <!-- <script src="../asset/datatabels/jquery-3.5.1.js"></script> -->
  <!-- <script src="../asset/datatabels/jquery.dataTables.min.js"></script> -->
  <!-- <script src="../asset/datatabels/dataTables.bootstrap5.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

  <title>Hello, <?= $_SESSION['nama']; ?></title>
</head>

<body style="background-color: black;">
  <!-- Navbar -->
  <?php
  include './navbar.php';
  ?>
  <!-- Navbar -->

  <div class="container-fluid" style="margin-top: 90px;">
    <div class="row">
      <div class="col-lg-6 mb-3">
        <!-- tabel -->
        <div class="card border-light container-fluid pb-1 text-light" style="width:auto; background-color:black;">
          <div class="card-header bg-transparent text-center border-light text-light">KAMAR</div>
          <div class="mt-1">
            <table id="kamar" class="table border-start border-end border-top text-nowrap table-sm" style="width:100%">
              <thead class="bg-dark text-light">
                <tr>
                  <th>Nomor Kamar</th>
                  <th>Tipe</th>
                  <th>Harga</th>
                  <th>Fasilitas</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody class="text-light">
                <?php
                $resepsionis = query("SELECT * FROM kamar
                                      INNER JOIN tipe_fasilitas_kamar
                                      ON kamar.tipe_kamar = tipe_fasilitas_kamar.tipe_kamar
                                      INNER JOIN tipe_kamar
                                      ON kamar.tipe_kamar = tipe_kamar.tipe_kamar GROUP BY no_kamar
                ");
                ?>
                <?php foreach ($resepsionis as $row) : ?>
                  <tr>
                    <td><?= $row['no_kamar']; ?></td>
                    <td><?= $row['tipe_kamar']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td>
                      <?php
                      $fasilitass = query("SELECT * FROM tipe_fasilitas_kamar");
                      ?>
                      <?php foreach ($fasilitass as $fas) : ?>
                        <?= $fas['fasilitas_kamar']; ?>,
                      <?php endforeach; ?>
                    </td>
                    <td><?= $row['status_kamar']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- tabel -->
      </div>
      <div class="col-lg-6 mb-3">
        <!-- tabel -->
        <div class="card border-light container-fluid pb-1 text-light" style="width:auto; background-color:black;">
          <div class="card-header bg-transparent text-center border-light text-light">TIPE FASILITAS KAMAR</div>
          <div class="mt-1">
            <table id="tipeFasilitas" class="table border-start border-end border-top text-nowrap table-sm" style="width:100%">
              <thead class="bg-dark text-light">
                <tr>
                  <th>Tipe Kamar</th>
                  <th>Fasilitas Kamar</th>
                </tr>
              </thead>
              <tbody class="text-light">
                <?php
                $resepsionis = query("SELECT * FROM tipe_fasilitas_kamar");
                ?>
                <?php foreach ($resepsionis as $row) : ?>
                  <tr>
                    <td><?= $row['tipe_kamar']; ?></td>
                    <td><?= $row['fasilitas_kamar']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- tabel -->
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 mb-3">
        <!-- tabel -->
        <div class="card border-light container-fluid pb-1 text-light" style="width:auto; background-color:black;">
          <div class="card-header bg-transparent text-center border-light text-light">TIPE KAMAR
            <!-- Tambah -->
            <a type="button" class="mx-4 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah_tipe_kamar">
              Tambah
            </a>

            <!-- The Modal -->
            <div class="modal fade" id="tambah_tipe_kamar">
              <div class="modal-dialog modal-md">
                <div class="modal-content border border-light" style="background-color:black;">

                  <!-- Modal Header -->
                  <div class="modal-header text-light">
                    <h4 class="modal-title">Tambah Tipe Kamar</h4>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Kembali</button>
                  </div>

                  <form action="" method="post">

                    <!-- Modal body -->
                    <div class="modal-body">
                      <?php

                      if (isset($_POST["ti_kamar"])) {

                        if (tambahTipeKamar($_POST) > 0) {
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
                        <label for="tipe_kamar" class="form-label">Kamar</label>
                        <input name="tipe_kamar" type="text" class="text-light btn-outline-info form-control" style="background-color:transparent" id="tipe_kamar" placeholder="Tipe Kamar">
                      </div>

                      <div class="mb-2">
                        <label for="harga_kamar" class="form-label">Harga Kamar</label>
                        <input name="harga_kamar" type="text" class="text-light btn-outline-info form-control" style="background-color:transparent" id="harga_kamar" placeholder="Harga Kamar">
                      </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" name="ti_kamar" class="btn btn-success">Tambah</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
            <!-- Tambah -->
          </div>
          <div class="mt-1">
            <table id="tipeKamar" class="table border-start border-end border-top text-nowrap table-sm" style="width:100%">
              <thead class="bg-dark text-light">
                <tr>
                  <th>Tipe Kamar</th>
                  <th>Harga Kamar</th>
                </tr>
              </thead>
              <tbody class="text-light">
                <?php
                $resepsionis = query("SELECT * FROM tipe_kamar");
                ?>
                <?php foreach ($resepsionis as $row) : ?>
                  <tr>
                    <td><?= $row['tipe_kamar']; ?></td>
                    <td><?= $row['harga']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- tabel -->
      </div>
      <div class="col-lg-6 mb-3">
        <!-- tabel -->
        <div class="card border-light container-fluid pb-1 text-light" style="width:auto; background-color:black;">
          <div class="card-header bg-transparent text-center border-light text-light">FASILITAS KAMAR
            <!-- Tambah -->
            <a type="button" class="mx-4 btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah_fasilitas">
              Tambah
            </a>

            <!-- The Modal -->
            <div class="modal fade" id="tambah_fasilitas">
              <div class="modal-dialog modal-md">
                <div class="modal-content border border-light" style="background-color:black;">

                  <!-- Modal Header -->
                  <div class="modal-header text-light">
                    <h4 class="modal-title">Tambah Fasilitas Kamar</h4>
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Kembali</button>
                  </div>

                  <form action="" method="post">

                    <!-- Modal body -->
                    <div class="modal-body">
                      <?php

                      if (isset($_POST["fa_kamar"])) {

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
                        <label for="fasilitas_kamar" class="form-label">Fasilitas</label>
                        <input name="fasilitas_kamar" type="text" class="text-light btn-outline-info form-control" style="background-color:transparent" id="fasilitas_kamar" placeholder="Nama Fasilitas">
                      </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" name="fa_kamar" class="btn btn-success">Tambah</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
            <!-- Tambah -->
          </div>
          <div class="mt-1">
            <table id="fasilitasKamar" class="table border-start border-end border-top text-nowrap table-sm" style="width:100%">
              <thead class="bg-dark text-light">
                <tr>
                  <th>Fasilitas Kamar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="text-light">
                <?php
                $fasilitas = query("SELECT * FROM fasilitas_kamar");
                ?>
                <?php foreach ($fasilitas as $row) : ?>
                  <tr>
                    <td><?= $row['fasilitas_kamar']; ?></td>
                    <td>
                      <a href="./hapus_fasilitas.php?fasilitas=<?= $row['fasilitas_kamar']; ?>" class="btn btn-outline-danger d-block">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- tabel -->
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#kamar').DataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#tipeFasilitas').DataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#tipeKamar').DataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#fasilitasKamar').DataTable();
    });
  </script>

</body>

</html>