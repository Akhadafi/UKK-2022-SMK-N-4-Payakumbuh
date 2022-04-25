<html lang="en">

<head>
  <title>WELCOME - HOTEL HEBAT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="hotel.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

  <!------------------------------ISI BODY----------------------------- -->

  <!------------------AWAL BAGIAN HEADER----------------- -->
  <div class="p-2 bg-secondary text-white text-center">
    <h1>HOTEL HEBAT</h1>
    <p>Selamat datang di Hotel Hebat Labuan Bajo Indonesia!</p>
  </div>
  <!------------------AKHIR BAGIAN HEADER----------------- -->

  <!------------------------------AWAL BAGIAN NAVBAR(MENU)----------------------------- -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">@Hebat</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <h5><a class="nav-link" href="">Home</a></h5>
          </li>
          <li class="nav-item">
            <h5><a class="nav-link" href="#" id="tombol_kamar">Kamar</a></h5>
          </li>
          <li class="nav-item">
            <h5><a class="nav-link" href="#" id="tombol_fasilitas">Fasilitas</a></h5>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  <!------------------------------AKHIR BAGIAN NAVBAR(MENU)----------------------------- -->


  <!------------------------------AWAL BAGIAN CAROUSEL(SLIDESHOW)----------------------------- -->
  <div id="demo_slide" class="carousel slide" data-bs-ride="carousel">
    <!-- INDIKATOR CAROUSEL -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class=""></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1" class="active" aria-current="true"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
      <!-- Mulai Script Panggil SlideShow Dari Tabel Fasilitas Umum menggunakan PHP -->
      <div class="carousel-item">
        <img src="image/KolamRenang320220313101049pm.jpg" alt="Los Angeles" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <h3>Kolam Renang 3</h3>
          <p>Ganti air setiap kali dipakai</p>
        </div>
      </div>

      <div class="carousel-item active">
        <img src="image/TempatSantai20220313101501pm.jpg" alt="Los Angeles" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <h3>Tempat Santai</h3>
          <p>Berada pada Lantai 12 menghadap Sunrise</p>
        </div>
      </div>

      <div class="carousel-item  ">
        <img src="image/LapanganBadminton20220313101526pm.jpeg" alt="Los Angeles" class="d-block" style="width:100%">
        <div class="carousel-caption">
          <h3>Kolam Renang Anak</h3>
          <p>Berada pada lantai 5 dengan luas 500m persegi</p>
        </div>
      </div>

      <!-- Akhir Script Panggil SlideShow Dari Tabel Fasilitas Umum menggunakan PHP -->

      <!-- KONTROL TOMBOL KIRI DAN KANAN SLIDESHOW -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>

    </div>
  </div>
  <!------------------------------AKHIR BAGIAN CAROUSEL(SLIDESHOW)----------------------------- -->

  <!-- SCRIPT TOMBOL PESAN SEKARANG -->
  <div class="container mt-2">
    <div class="d-flex justify-content-center">
      <div class="row">
        <div class="col-sm form-floating mb-3 mt-4">
          <button type="button" id="tombol_pesan" class="btn btn-outline-primary">Mulai Pesan Sekarang</button>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT CHECK IN, CHECK OUT, JUMLAH KAMAR -->
  <div class="container mt-2" id="panel_cek" style="display: none;">
    <div class="d-flex justify-content-center">
      <form>
        <div class="row">
          <div class="col-sm form-floating mb-3 mt-3">
            <input type="date" class="form-control" id="masuk" name="masuk">
            <label for="masuk"> Check In</label>
          </div>
          <div class="col-sm form-floating mb-3 mt-3">
            <input type="date" class="form-control" id="keluar" name="keluar">
            <label for="keluar"> Check Out</label>
          </div>
          <div class="col-sm form-floating mb-3 mt-3">
            <input type="number" class="form-control" id="jkamar" name="jkamar">
            <label for="jkamar">Jumlah Kamar</label>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- SCRIPT PEMESANAN -->
  <div class="container mt-4 col-sm-8" id="panel_pemesanan" style="display: none;">
    <div class="card d-flex justify-content-center">
      <div class="card-body bg-primary">
        <div class="row bg-primary text-white">
          <h4>Form Pemesanan</h4>
          <p>Silahkan memasukan data pada form ini untuk memulai pemesanan!</p>
        </div>
        <div class="row bg-white">
          <form id="form_pesan">
            <div class="form-floating mb-2 mt-3">
              <input type="text" class="form-control" id="nama" name="nama">
              <label for="nama">Nama Pemesanan</label>
            </div>
            <div class="form-floating mt-2 mb-2">
              <input type="email" class="form-control" id="email" name="email">
              <label for="pwd">Email</label>
            </div>
            <div class="form-floating mt-2 mb-2">
              <input type="text" class="form-control" id="hp" name="hp">
              <label for="hp">No. Telepon</label>
            </div>
            <div class="form-floating mt-2 mb-2">
              <input type="text" class="form-control" id="tamu" name="tamu">
              <label for="tamu">Nama Tamu</label>
            </div>
            <div class="form-floating mt-2 mb-2">
              <select class="form-select mt-3" id="idkamar" name="idkamar">
                <option value="5"> Superior </option>
                <option value="6"> Deluxe </option>
              </select>
              <label for="idkamar">Tipe Kamar</label>
            </div>
            <div class="mt-3 mb-3">
              <button type="button" id="konfirmasi" class="btn btn-outline-success">Konfirmasi Pemesanan</button>
              <button type="button" id="tombol_batal" class="btn btn-outline-danger">Batal</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT FASILITAS -->
  <div class="container mt-2" id="panel_fasilitas_kami" style="display: none;">
    <h2 class="text-center">FASILITAS KAMI</h2>
    <h5 class="text-center">Hotel Hebat</h5>

    <!-- Mulai Script Panggil SlideShow Dari Tabel Fasilitas Umum menggunakan PHP -->

    <div class="container mt-4">
      <div class="card">
        <h5>Kolam Renang 3</h5>
        <p>Ganti air setiap kali dipakai</p>
        <img class="img-fluid" max-width:="" 100%;="" height:="" auto;="" src="image/KolamRenang320220313101049pm.jpg" alt="Gambar">
      </div>
    </div>

    <div class="container mt-4">
      <div class="card">
        <h5>Tempat Santai</h5>
        <p>Berada pada Lantai 12 menghadap Sunrise</p>
        <img class="img-fluid" max-width:="" 100%;="" height:="" auto;="" src="image/TempatSantai20220313101501pm.jpg" alt="Gambar">
      </div>
    </div>

    <div class="container mt-4">
      <div class="card">
        <h5>Kolam Renang Anak</h5>
        <p>Berada pada lantai 5 dengan luas 500m persegi</p>
        <img class="img-fluid" max-width:="" 100%;="" height:="" auto;="" src="image/LapanganBadminton20220313101526pm.jpeg" alt="Gambar">
      </div>
    </div>
  </div>

  <!-- SCRIPT KAMAR -->
  <div class="container mt-2 col-sm-7" id="panel_kamar" style="display: none;">
    <h2 class="text-center">TIPE KAMAR KAMI</h2>
    <h5 class="text-center">Hotel Hebat</h5>

    <div class="justify-content-center">
      <!-- Mulai Script Panggil SlideShow Dari Tabel Fasilitas Umum menggunakan PHP -->
      <div class="card mt-2 mb-4">
        <div class="">
          <h5 class="card-title">Superior :</h5>
          <ul>
            <li>Kamar mandi shower</li>
          </ul>
          <img class="img-fluid" src="image/Kamarmandishower20220422050702am.jpg" alt="Card image">
        </div>
      </div>
      <div class="card mt-2 mb-4">
        <div class="">
          <h5 class="card-title">Superior :</h5>
          <ul>
            <li>Coffee Maker</li>
          </ul>
          <img class="img-fluid" src="image/CoffeeMaker20220422050852am.jpg" alt="Card image">
        </div>
      </div>
      <div class="card mt-2 mb-4">
        <div class="">
          <h5 class="card-title">Deluxe :</h5>
          <ul>
            <li>AC Pendingin Ruang</li>
          </ul>
          <img class="img-fluid" src="image/ACPendinginRuang20220313110855pm.jpg" alt="Card image">
        </div>
      </div>
      <div class="card mt-2 mb-4">
        <div class="">
          <h5 class="card-title">Deluxe :</h5>
          <ul>
            <li>TV 42 Inc</li>
          </ul>
          <img class="img-fluid" src="image/TV42Inc20220313110820pm.jpg" alt="Card image">
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPT TEANTANG KAMI -->
  <div class="container  mt-2" id="panel_tentang_kami">
    <div class="d-flex justify-content-center">
      <div class="row">
        <div class="col-sm-12 p-5">
          <h2 class="text-center">TENTANG KAMI</h2>
          <p> <b>Hotel Hebat</b> terkenal dengan keramahan kelas dunia, desain hotel yang mengagumkan dan standar layanan yang tak tertandingi di Bali dan Jakarta, HOTEL HEBAT adalah resort bintang lima yang pertama di Pantai Waecicu, Pulau Flores, hanya dengan satu jam penerbangan dari Pulau Bali yang sangat indah.
            HOTEL HEBAT Komodo Resort, Waecicu Beach memiliki 13 suites dan 192 kamar tamu yang premium. Terinspirasi dengan cahaya, kenyamanan dan ruang terbuka, setiap kamar yang kontemporer menawarkan pemandangan laut yang menawan dengan jendela besar untuk menikmati cahaya keemasan dari matahari yang terbenam di belakang Pulau Kukusan.

            Berlokasi di salah satu pulau berbukit dan indah dari kepulauan Indonesia, terdapat beragam agama, bahasa dan pemandangan yang luar biasa yang berpadu dengan laut berwarna biru kristal dan pantai dengan pasir putih yang asli.
          </p>
        </div>
      </div>

    </div>
  </div>

  <!-- SCRIPT FOOTER -->
  <div class="mt-5 p-2 bg-secondary text-white text-center">
    <p>@Desain by UKK RPL 2022</p>
  </div>

  <!-- PANGGIL FILE JAVASCRIPT DARI FOLDER js -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!------------------------------ AWAL KONDISI CODING JAVASCRIPT-------------------------------- -->
  <script>
    $(document).ready(function() {

      /*KONDISI SAAT WEBSITE DIJALANKAN PERTAMA KALI*/
      $('#panel_cek').hide();
      $('#panel_fasilitas_kami').hide();
      $('#panel_pemesanan').hide();
      $('#panel_tentang_kami').show();
      $('#panel_kamar').hide();

      /*KONDISI TOMBOL PESAN SEKARANG DI KLIK*/
      $("#tombol_pesan").click(function() {
        $('#panel_tentang_kami').hide();
        $('#panel_fasilitas_kami').hide();
        $('#panel_cek').show();
        $('#panel_pemesanan').show();
        $('#panel_kamar').hide();
        $('#demo_slide').hide();
      });

      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_batal").click(function() {
        $('#panel_cek').hide();
        $('#panel_fasilitas_kami').hide();
        $('#panel_pemesanan').hide();
        $('#panel_tentang_kami').show();
        $('#demo_slide').show();
        $('#panel_kamar').hide();
      });

      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_fasilitas").click(function() {
        $('#panel_cek').hide();
        $('#panel_fasilitas_kami').show();
        $('#panel_pemesanan').hide();
        $('#panel_tentang_kami').hide();
        $('#panel_kamar').hide();
        $('#demo_slide').hide();
      });
      /*KONDISI TOMBOL BATAL SAAT DI KLIK*/
      $("#tombol_kamar").click(function() {
        $('#panel_cek').hide();
        $('#panel_fasilitas_kami').hide();
        $('#panel_pemesanan').hide();
        $('#panel_tentang_kami').hide();
        $('#panel_kamar').show();
        $('#demo_slide').hide();
      });

    });
  </script>
  <!------------------------------ AWAL KONDISI CODING JAVASCRIPT-------------------------------- -->


  <!-- END BODY -->

</body>

</html>