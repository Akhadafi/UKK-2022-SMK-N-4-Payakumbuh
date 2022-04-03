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
                window.location.href = '../logout.php';
            </script>
        ";
}

$fasilitas = $_GET["fasilitas"];

function hapus_fasilitas($fasilitas)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM fasilitas_kamar WHERE fasilitas_kamar = '$fasilitas'");
  return mysqli_affected_rows($conn);
}

if (hapus_fasilitas($fasilitas) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>
	";
} else {
  echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = 'index.php';
		</script>
	";
}
