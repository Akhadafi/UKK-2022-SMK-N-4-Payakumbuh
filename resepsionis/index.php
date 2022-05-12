<?php
session_start();

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel-hebat");

if (!isset($_SESSION["login"])) {
  header("Location: ../index.php");
  exit;
}
if ($_SESSION['role'] != "Resepsionis") {
  echo "
            <script>
                alert('Anda bukan resepsionis!');
                window.location.href = '../admin/kamar.php';
            </script>
        ";
}
