<!-- Hapus -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

$id_kamar = $_GET["id_kamar"];

function hapusKamar($id_kamar)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM kamar WHERE id_kamar = '$id_kamar'");
  return mysqli_affected_rows($conn);
}

if (hapusKamar($id_kamar) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = './kamar.php';
		</script>
	";
} else {
  echo mysqli_error($conn);
}
?>
<!-- Hapus -->