<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-sm navbar-dark border-bottom border-top" style="background-color: black;">
  <div class="container-fluid">
    <div class="d-flex" href="#">
      <img src="../img/user/pp/<?= $_SESSION['gambar']; ?>" alt="Avatar Logo" style="width: 50px;" class="rounded-pill border border-2 border-warning">
      <div class="navbar-brand mx-1 text-warning"><?= $_SESSION['nama']; ?> | role : <?= $_SESSION['role']; ?></div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse" id="mynavbar">
    <div class="mx-auto container">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" id="tombol_resepsionis">Resepsionis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="tombol_kamar">Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="tombol_tipe_fasiliats_kamar">TipeFasilitasKamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="tombol_tipe_kamar">TipeKamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="tombol_fasilitas_kamar">FasilitasKamar</a>
        </li>
        <li class="nav-item">
          <a href="../logout.php" class="btn btn-outline-danger" onclick="return confirm('yakin keluar?');">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar -->