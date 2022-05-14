<!-- Hapus -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

$id = $_GET["id"];

function hapusKamar($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM pelanggan WHERE id = '$id'");
  return mysqli_affected_rows($conn);
}

if (hapusKamar($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = './pelanggan.php';
		</script>
	";
} else {
  echo mysqli_error($conn);
}
?>
<!-- Hapus -->