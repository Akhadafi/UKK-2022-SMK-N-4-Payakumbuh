<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="./img/a.jpeg">
  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <title>Hotel</title>
</head>

<body style="margin-top: 70px;">
  <!-- Navbar -->
  <?php
  include './navbar.php'
  ?>
  <!-- Navbar -->

  <main class="container">
    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
      <div class="col-md-6 px-0">
        <h1 class="display-4 fst-italic">TENTANG KAMI</h1>
        <p class="lead my-3"><b>Hotel Hebat</b> terkenal dengan keramahan kelas dunia, desain hotel yang mengagumkan dan standar layanan yang tak tertandingi di Bali dan Jakarta, AYANA adalah resort bintang lima yang pertama di Pantai Waecicu, Pulau Flores, hanya dengan satu jam penerbangan dari Pulau Bali yang sangat indah.</p>
        <p class="lead mb-0"><a href="pesan.php" class="btn btn-outline-light">Mulai Pesan Sekarang</a></p>
      </div>
    </div>

    <div class="row mb-2">
      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <?php
          $result1 = mysqli_query($conn, "SELECT * FROM fasilitas_kamar,kamar WHERE fasilitas_kamar.id_kamar = kamar.id_kamar AND nama_kamar = 'Deluxe' LIMIT 1");
          ?>
          <?php $row1 = mysqli_fetch_assoc($result1) ?>
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">Tipe Kamar</strong>
            <h3 class="mb-0"><?= $row1['nama_kamar']; ?></h3>
            <div class="mb-1 text-muted">Total kamar: <?= $row1['total_kamar']; ?></div>
            <p class="card-text mb-auto">Desain hotel yang mengagumkan dan standar layanan yang tak tertandingi di Bali dan Jakarta</p>
            <a href="pesan.php" class="btn btn-outline-primary">Pesan Kamar</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="./img/fasilitas_kamar/<?= $row1['gambar']; ?>" alt="<?= $row1['nama_kamar']; ?>" width="200" height="250">
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <?php
          $result2 = mysqli_query($conn, "SELECT * FROM fasilitas_kamar,kamar WHERE fasilitas_kamar.id_kamar = kamar.id_kamar AND nama_kamar = 'Superior' LIMIT 1");
          ?>
          <?php $row2 = mysqli_fetch_assoc($result2) ?>
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-success">Tipe Kamar</strong>
            <h3 class="mb-0"><?= $row2['nama_kamar']; ?></h3>
            <div class="mb-1 text-muted">Total kamar: <?= $row2['total_kamar']; ?></div>
            <p class="mb-auto">Desain hotel yang mengagumkan dan standar layanan yang tak tertandingi di Bali dan Jakarta</p>
            <a href="pesan.php" class="btn btn-outline-primary">Pesan Kamar</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img src="./img/fasilitas_kamar/<?= $row2['gambar']; ?>" alt="<?= $row2['nama_kamar']; ?>" width="200" height="250">
          </div>
        </div>
      </div>
    </div>

    <div class="row g-5">
      <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
          FASILITAS UMUM HOTEL HEBAT
        </h3>

        <?php
        $resultFasilitasUmum = mysqli_query($conn, "SELECT * FROM fasilitas_umum LIMIT 3");
        ?>
        <?php while ($rowFasilitasUmum = mysqli_fetch_assoc($resultFasilitasUmum)) : ?>
          <article class="blog-post">
            <div class="card p-3 mb-2">
              <img src="./img/fasilitas_umum/<?= $rowFasilitasUmum['gambar']; ?>" class="card-img-top rounded border border-light" alt="...">
              <h2 class="blog-post-title"><?= $rowFasilitasUmum['nama_fasilitas']; ?></h2>
              <p class="blog-post-meta"><?= $rowFasilitasUmum['keterangan']; ?></p>
            </div>
          </article>
        <?php endwhile; ?>

      </div>

      <div class="col-md-4">
        <div class="position-sticky" style="top: 7rem;">
          <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">About</h4>
            <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
          </div>

          <div class="p-4">
            <h4 class="fst-italic">Social Media</h4>
            <ol class="list-unstyled">
              <li><a href="#">Instagram</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

  </main>

  <footer class="blog-footer">
    <div class="p-1 bg-dark text-white text-center">
      <h5>HOTEL HEBAT</h5>
      <p>Selamat datang di Hotel Hebat Payakumbuh Indonesia!</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="./vendor/bootstrap.bundle.min.js"></script>

</body>

</html>