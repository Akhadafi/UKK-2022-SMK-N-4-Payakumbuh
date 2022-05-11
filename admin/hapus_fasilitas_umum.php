<!-- Hapus -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

$id = $_GET["id"];

function hapusFasilitasUmum($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM fasilitas_umum WHERE id = '$id'");
  return mysqli_affected_rows($conn);
}

if (hapusFasilitasUmum($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = './fasilitas_umum.php';
		</script>
	";
} else {
  echo mysqli_error($conn);
}
?>
<!-- Hapus -->