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

$username = $_GET["user"];

if (hapus($username) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'resepsionis.php';
		</script>
	";
} else {
  echo "
		<script>
			alert('data gagal dihapus!');
			document.location.href = '';
		</script>
	";
}
