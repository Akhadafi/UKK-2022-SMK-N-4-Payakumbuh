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

$tipe_kamar = $_GET["tipe_kamar"];

function hapus_tipe_kamar($tipe_kamar)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tipe_kamar WHERE tipe_kamar = '$tipe_kamar'");
  return mysqli_affected_rows($conn);
}

if (hapus_tipe_kamar($tipe_kamar) > 0) {
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
