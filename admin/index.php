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
  <div class="container-fluid" id="panel_resepsionis" style="margin-top: 90px;">

    <div class="row">
      <div class="col-lg-3">
        <div class="row">
          <div class="col">
            <div class="card border-light mb-3" style="width:auto; background-color:black;">
              <div class="card-header bg-transparent text-center border-light text-light">RSEEPSIONIS</div>
              <div class="card-body text-light">
                <div class="card-title">Jumlah Resepsionis :
                  <p class="card-text text-warning">
                    <?php
                    $query = mysqli_query($conn, "SELECT COUNT(username) as jumlah FROM user WHERE role = 'Resepsionis'");
                    $result = mysqli_fetch_assoc($query);
                    echo $result['jumlah'];
                    ?> Orang
                  </p>
                </div>

              </div>
              <div class="card-footer bg-transparent border-light">
                <!-- Tambah -->
                <a type="button" class="btn btn-sm btn-primary d-block" data-bs-toggle="modal" data-bs-target="#TbResepsionis">
                  Tambah Resepsionis
                </a>

                <!-- The Modal -->
                <div class="modal fade" id="TbResepsionis">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content border border-light container" style="width:auto; background-color:black;">

                      <!-- Modal Header -->
                      <div class="modal-header text-light">
                        <h4 class="modal-title">Tambah Resepsionis</h4>
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Kembali</button>
                      </div>

                      <form action="" method="post" enctype="multipart/form-data">

                        <!-- Modal body -->
                        <div class="modal-body">
                          <?php

                          if (isset($_POST["register"])) {

                            if (registrasi($_POST) > 0) {
                              echo "<script>
                                    alert('Data resepsionis baru berhasil ditambahkan!');
                                    document.location.href = '';
                                    </script>";
                            } else {
                              echo mysqli_error($conn);
                            }
                          }

                          ?>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-floating mb-3">
                                <input type="email" name="username" id="username" class="form-control" placeholder="name@example.com" autocomplete="off">
                                <label for="username" class="form-label">Email :</label>
                              </div>
                              <div class="form-floating mb-3">
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" autocomplete="off">
                                <label for="nama" class="form-label">Nama :</label>
                              </div>
                              <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="name@example.com" autocomplete="off">
                                <label for="password" class="form-label">Password :</label>
                              </div>
                              <div class="form-floating mb-3">
                                <input type="password" name="password2" id="password2" class="form-control" placeholder="name@example.com" autocomplete="off">
                                <label for="password2" class="form-label">Konfirmasi Password :</label>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <input type="hidden" name="role" id="role" value="Resepsionis">
                              <div class="form-floating mb-3">
                                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="name@example.com" autocomplete="off">
                                <label for="no_hp" class="form-label">No Hp :</label>
                              </div>
                              <div class="form-floating mb-3">
                                <textarea name="alamat" class="form-control" placeholder="Leave a comment here" id="alamat"></textarea>
                                <label for="alamat">Alamat :</label>
                              </div>
                              <div class="mb-3">
                                <label for="gambar" class="form-label text-light">Photo :</label>
                                <input type="file" name="gambar" id="gambar" class="form-control" placeholder="name@example.com" autocomplete="off">
                              </div>
                            </div>
                          </div>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="submit" name="register" class="btn btn-success">Tambah</button>
                        </div>

                      </form>

                    </div>
                  </div>
                </div>
                <!-- Tambah -->
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-9">
        <!-- tabel -->
        <div class="card border-light container-fluid pb-1 text-light" style="width:auto; background-color:black;">
          <div class="card-header bg-transparent text-center border-light text-light">DAFTAR RSEEPSIONIS</div>
          <div class="table-responsive mt-1">
            <table id="resepsionis" class="table border-start border-end border-top text-nowrap table-sm" style="width:100%">
              <thead class="bg-dark text-light">
                <tr>
                  <th>Email</th>
                  <th>Nama</th>
                  <th>Level</th>
                  <th>No HP</th>
                </tr>
              </thead>
              <tbody class="text-light">
                <?php
                $resepsionis = query("SELECT * FROM user WHERE role = 'Resepsionis'");
                ?>
                <?php foreach ($resepsionis as $row) : ?>
                  <tr>
                    <td>
                      <div class="d-flex">
                        <img src="../img/user/pp/<?= $row['gambar']; ?>" style="width: 35px;" class="rounded" alt="PP">
                        <a class="mx-1 " style="text-decoration: none;" href="./detail.php?user=<?= $row['username']; ?>"><?= $row['username']; ?></a>
                      </div>
                    </td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['role']; ?></td>
                    <td><?= $row['no_hp']; ?></td>
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

  <div class="container-fluid" id="panel_kamar" style="margin-top: 90px;">
    <!-- tabel -->
    <div class="card border-light container-fluid pb-1 text-light" style="width:auto; background-color:black;">
      <div class="card-header bg-transparent text-center border-light text-light">KAMAR</div>
      <div class="mt-1">
        <div class="table-responsive">
          <table id="kamar" class="table border-start border-end border-top text-nowrap table-sm" style="width:100%">
            <thead class="bg-dark text-light">
              <tr>
                <th>No Kamar</th>
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
                    $no_kamar = $row['no_kamar'];
                    $fasilitass = mysqli_query($conn, "SELECT * FROM tipe_fasilitas_kamar,kamar,fasilitas_kamar where kamar.tipe_kamar = tipe_fasilitas_kamar.tipe_kamar and tipe_fasilitas_kamar.fasilitas_kamar = fasilitas_kamar.fasilitas_kamar and kamar.no_kamar='$no_kamar'");

                    while ($result = mysqli_fetch_array($fasilitass)) {
                      echo $result['fasilitas_kamar'] . "<br>";
                    }
                    ?>
                  </td>
                  <td><?= $row['status_kamar']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- tabel -->
  </div>

  <div class="container-fluid" id="panel_tipe_fasiliats_kamar" style="margin-top: 90px;">
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

  <div class="container-fluid" id="panel_tipe_kamar" style="margin-top: 90px;">
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
                    <label for="harga" class="form-label">Harga Kamar</label>
                    <input name="harga" type="text" class="text-light btn-outline-info form-control" style="background-color:transparent" id="harga" placeholder="Harga Kamar">
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
              <th>Aksi</th>
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
                <td>
                  <center>
                    <a href="edit_tipeKamar.php?tipe_kamar=<?= $row['tipe_kamar']; ?>" class="btn btn-sm btn-outline-warning text-light">Edit</a>
                    <a href="hapus_tipeKamar.php?tipe_kamar=<?= $row['tipe_kamar']; ?>" class="btn btn-sm btn-outline-danger">Hapus</a>
                  </center>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- tabel -->
  </div>

  <div class="container-fluid" id="panel_fasilitas_kamar" style="margin-top: 90px;">
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
                  <div class="mb-3">
                    <label for="gambar" class="form-label text-light">Gambar :</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" placeholder="name@example.com" autocomplete="off">
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
                  <a href="edit_fasilitasKamar.php?fasilitas=<?= $row['fasilitas_kamar']; ?>" class="btn btn-sm btn-outline-warning text-light">Edit</a>
                  <a href="hapus_fasilitasKamar.php?fasilitas=<?= $row['fasilitas_kamar']; ?>" class="btn btn-sm btn-outline-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- tabel -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!------------------------------ AWAL KONDISI CODING JAVASCRIPT-------------------------------- -->
  <script>
    $(document).ready(function() {

      /*KONDISI SAAT WEBSITE DIJALANKAN PERTAMA KALI*/
      $('#panel_resepsionis').show();
      $('#panel_kamar').hide();
      $('#panel_tipe_fasiliats_kamar').hide();
      $('#panel_tipe_kamar').hide();
      $('#panel_fasilitas_kamar').hide();

      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_resepsionis").click(function() {
        $('#panel_resepsionis').show();
        $('#panel_kamar').hide();
        $('#panel_tipe_fasiliats_kamar').hide();
        $('#panel_tipe_kamar').hide();
        $('#panel_fasilitas_kamar').hide();
      });

      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_kamar").click(function() {
        $('#panel_kamar').show();
        $('#panel_resepsionis').hide();
        $('#panel_tipe_fasiliats_kamar').hide();
        $('#panel_tipe_kamar').hide();
        $('#panel_fasilitas_kamar').hide();
      });

      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_tipe_fasiliats_kamar").click(function() {
        $('#panel_tipe_fasiliats_kamar').show();
        $('#panel_resepsionis').hide();
        $('#panel_kamar').hide();
        $('#panel_tipe_kamar').hide();
        $('#panel_fasilitas_kamar').hide();
      });

      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_tipe_kamar").click(function() {
        $('#panel_tipe_kamar').show();
        $('#panel_resepsionis').hide();
        $('#panel_kamar').hide();
        $('#panel_tipe_fasiliats_kamar').hide();
        $('#panel_fasilitas_kamar').hide();
      });

      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_fasilitas_kamar").click(function() {
        $('#panel_fasilitas_kamar').show();
        $('#panel_resepsionis').hide();
        $('#panel_kamar').hide();
        $('#panel_tipe_kamar').hide();
        $('#panel_tipe_fasiliats_kamar').hide();
      });

    });
  </script>
  <!------------------------------ AWAL KONDISI CODING JAVASCRIPT-------------------------------- -->
  <script>
    $(document).ready(function() {
      $('#resepsionis').DataTable();
    });

    $(document).ready(function() {
      $('#kamar').DataTable();
    });

    $(document).ready(function() {
      $('#tipeFasilitas').DataTable();
    });

    $(document).ready(function() {
      $('#tipeKamar').DataTable();
    });

    $(document).ready(function() {
      $('#fasilitasKamar').DataTable();
    });
  </script>

</body>

</html>