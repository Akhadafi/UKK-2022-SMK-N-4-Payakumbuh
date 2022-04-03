<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

$nisn = $_GET["nisn"];

if (hapus($nisn) > 0) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'index.php';
		</script>
	";
}
