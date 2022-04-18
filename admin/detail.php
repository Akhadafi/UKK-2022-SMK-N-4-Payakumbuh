<?php
session_start();

require 'functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
if ($_SESSION['role'] != "Admin") {
  echo "
            <script>
                alert('Anda bukan admin!');
                window.location.href = './index.php';
            </script>
        ";
}
$user = $_GET['user'];

// query data resepsionis berdasarkan user
$resepsionis = query("SELECT * FROM user WHERE username = '$user'")[0];
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
  <style>
    .bg {
      background-image: url(../img/a3.jpg);
      /* background-color: darkgray; */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  </style>
</head>

<body class="bg">
  <!-- Navbar -->
  <?php
  include './navbar.php';
  ?>
  <!-- Navbar -->

  <div class="container-fluid" style="margin-top: 90px;">
    <div class="row">
      <div class="col">
        <div class="card border-light container-fluid pb-1 text-light" style="width: 26rem; background-color:black;">
          <h5 class="card-header bg-transparent text-center border-light text-light">Data <span class="text-warning"><?= $resepsionis['username']; ?></span></h5>
          <div class="row">
            <div class="col-4">
              <img src="../img/user/pp/<?= $resepsionis['gambar']; ?>" style="width: 122px;" class="card mt-1 mb-1" alt="PP">
            </div>
            <div class="col-8 mt-1">
              <div class="border rounded px-2">
                <p class="card-text bg-transparent text-start border-light text-light">
                  Nama : <span class="text-warning"><?= $resepsionis['nama']; ?></span>
                  <br>
                  Level : <span class="text-warning"><?= $resepsionis['role']; ?></span>
                  <br>
                  No HP : <span class="text-warning"><?= $resepsionis['no_hp']; ?></span>
                  <br>
                  Alamat :
                  <br>
                  <span class="text-warning"><?= $resepsionis['alamat']; ?></span>
              </div>
              </p>
            </div>
            <p class="card-text bg-transparent text-start border-light text-light">
            </p>
          </div>

          <!-- Edit -->
          <div class="card" style="width:auto; background-color:black;">
            <a type="button" class="btn btn-outline-light d-block mb-1" data-bs-toggle="modal" data-bs-target="#TbResepsionis">Edit Data <span class="text-warning"><?= $resepsionis['nama']; ?></a>
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

                      // cek apakah tombol submit sudah ditekan atau belum
                      if (isset($_POST["submit"])) {

                        // cek apakah data berhasil diubah atau tidak
                        if (ubah($_POST) > 0) {
                          echo "
                                <script>
                                  // alert('data berhasil diubah!');
                                  document.location.href = '';
                                </script>
                              ";
                        } else {
                          echo "
                                <script>
                                  alert('data gagal diubah!');
                                </script>
                              ";
                        }
                      }

                      ?>

                      <div class="row text-dark">
                        <div class="container">
                          <input type="hidden" name="username" id="username" class="form-control" placeholder="name@example.com" autocomplete="off" value="<?= $resepsionis['username']; ?>">
                          <div class="form-floating mb-3">
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="name@example.com" autocomplete="off" value="<?= $resepsionis['nama']; ?>">
                            <label for="nama" class="form-label">Nama :</label>
                          </div>
                          <input type="hidden" name="password" id="password" class="form-control" placeholder="name@example.com" autocomplete="off" value="<?= $resepsionis['password']; ?>">
                          <input type="hidden" name="role" id="role" value="resepsionis">
                          <div class="form-floating mb-3">
                            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="name@example.com" autocomplete="off" value="<?= $resepsionis['no_hp']; ?>">
                            <label for="no_hp" class="form-label">No Hp :</label>
                          </div>
                          <div class="mb-3">
                            <label for="alamat" class="form-label text-light">Alamat :</label>
                            <textarea name="alamat" class="form-control" placeholder="Leave a comment here" id="alamat" style="height: 150px;"><?= $resepsionis['alamat']; ?></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="gambar" class="form-label text-light">Photo :</label>
                            <img src="../img/user/pp/<?= $resepsionis['gambar']; ?>" style="width: 120px;" class="card mb-1" alt="PP">
                            <input type="hidden" name="gambarLama" value="<?= $resepsionis['gambar']; ?>">
                            <input type="file" name="gambar" id="gambar" class="form-control" placeholder="name@example.com" autocomplete="off">
                          </div>
                        </div>
                      </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" href="./detail.php?email=<?= $resepsionis['username']; ?>" name="submit" class="btn btn-success">Edit Data</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>

          <a type="button" class="btn btn-outline-light d-block" data-bs-toggle="modal" data-bs-target="#va-hapus">
            Hapus Data <span class="text-danger"><?= $resepsionis['nama']; ?></span>
          </a>
          <!-- The Modal Validasi -->
          <div class="modal fade" id="va-hapus">
            <div class="modal-dialog">
              <div class="modal-content border border-light" style="background-color: black;">
                <!-- Modal body -->
                <div class="modal-body">
                  <h6>Yakin untuk menghapus data <span class="text-danger"><?= $resepsionis['nama']; ?></span> ?</h6>
                  <hr>
                  <div class="row">
                    <div class="col-6">
                      <a data-bs-dismiss="modal" class=" btn btn-outline-info d-block">Kembali</a>
                    </div>
                    <div class="col-6">
                      <a href="./hapus.php?user=<?= $resepsionis['username']; ?>" class="btn btn-outline-danger d-block">Hapus</a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!-- Edit -->

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>