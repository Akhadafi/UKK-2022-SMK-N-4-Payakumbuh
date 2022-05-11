<!-- Hapus -->
<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

$id_fasilitas_umum = $_GET["id_fasilitas_umum"];

function hapusFasilitasUmum($id_fasilitas_umum)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM fasilitas_umum WHERE id = '$id_fasilitas_umum'");
  return mysqli_affected_rows($conn);
}

if (hapusFasilitasUmum($id_fasilitas_umum) > 0) {
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