<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
if ($_SESSION['role'] != "Admin") {
	echo "
            <script>
                alert('Anda bukan admin! Silahkan login sebagai admin');
                window.location.href = './login.php';
            </script>
        ";
}
require 'functions.php';
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="../asset/datatabels/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="../asset/datatabels/dataTables.bootstrap5.min.css"> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

	<!-- <script src="../asset/datatabels/jquery-3.5.1.js"></script> -->
	<!-- <script src="../asset/datatabels/jquery.dataTables.min.js"></script> -->
	<!-- <script src="../asset/datatabels/dataTables.bootstrap5.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

	<title>Hello, world!</title>
</head>

<body style="background-color: black;">

	<?php
	include './r_navbar.php';
	?>

	<div class="container-fluid" style="margin-top: 90px;">

		<div class="row">
			<div class="col-lg-3">
				<div class="row">
					<div class="col">
						<div class="card border-light mb-3" style="width:auto; background-color:black;">
							<div class="card-header bg-transparent text-center border-light text-light">RSEEPSIONIS</div>
							<div class="card-body text-light">
								<div class="card-title">Jumlah Tamu :
									<p class="card-text text-warning">
										<?php
										$query = mysqli_query($conn, "SELECT COUNT(username) as jumlah FROM user WHERE role = 'Tamu'");
										$result = mysqli_fetch_assoc($query);
										echo $result['jumlah'];
										?> Orang
									</p>
								</div>

							</div>
							<div class="card-footer bg-transparent border-light">
								<!-- Tambah -->
								<a type="button" class="btn btn-sm btn-primary d-block" data-bs-toggle="modal" data-bs-target="#TbResepsionis">
									Tambah Resepsionis
								</a>

								<!-- The Modal -->
								<div class="modal fade" id="TbResepsionis">
									<div class="modal-dialog modal-lg">
										<div class="modal-content border border-light container" style="width:auto; background-color:black;">

											<!-- Modal Header -->
											<div class="modal-header text-light">
												<h4 class="modal-title">Tambah Resepsionis</h4>
												<button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Kembali</button>
											</div>

											<form action="" method="post" enctype="multipart/form-data">

												<!-- Modal body -->
												<div class="modal-body">
													<?php

													if (isset($_POST["register"])) {

														if (registrasi($_POST) > 0) {
															echo "<script>
                                    alert('user baru berhasil ditambahkan!');
                                    document.location.href = '';
                                    </script>";
														} else {
															echo mysqli_error($conn);
														}
													}

													?>

													<div class="row">
														<div class="col-lg-6">
															<div class="form-floating mb-3">
																<input type="email" name="username" id="username" class="form-control" placeholder="name@example.com" autocomplete="off">
																<label for="username" class="form-label">Email :</label>
															</div>
															<div class="form-floating mb-3">
																<input type="text" name="nama" id="nama" class="form-control" placeholder="name@example.com" autocomplete="off">
																<label for="nama" class="form-label">Nama :</label>
															</div>
															<div class="form-floating mb-3">
																<input type="password" name="password" id="password" class="form-control" placeholder="name@example.com" autocomplete="off">
																<label for="password" class="form-label">Password :</label>
															</div>
															<div class="form-floating mb-3">
																<input type="password" name="password2" id="password2" class="form-control" placeholder="name@example.com" autocomplete="off">
																<label for="password2" class="form-label">Konfirmasi Password :</label>
															</div>
														</div>

														<div class="col-lg-6">
															<input type="hidden" name="role" id="role" value="resepsionis">
															<div class="form-floating mb-3">
																<input type="text" name="no_telp" id="no_telp" class="form-control" placeholder="name@example.com" autocomplete="off">
																<label for="no_telp" class="form-label">No Hp :</label>
															</div>
															<div class="form-floating mb-3">
																<textarea name="alamat" class="form-control" placeholder="Leave a comment here" id="alamat"></textarea>
																<label for="alamat">Alamat :</label>
															</div>
															<div class="mb-3">
																<label for="gambar" class="form-label text-light">Photo :</label>
																<input type="file" name="gambar" id="gambar" class="form-control" placeholder="name@example.com" autocomplete="off">
															</div>
														</div>
													</div>

												</div>

												<!-- Modal footer -->
												<div class="modal-footer">
													<button type="submit" name="register" class="btn btn-success">Tambah</button>
												</div>

											</form>

										</div>
									</div>
								</div>
								<!-- Tambah -->
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-lg-9">
				<!-- tabel -->
				<div class="card border-light container-fluid pb-1 text-light" style="width:auto; background-color:black;">
					<div class="card-header bg-transparent text-center border-light text-light">DAFTAR TAMU</div>
					<div class="table-responsive mt-1">
						<table id="example" class="table border-start border-end border-top text-nowrap table-sm" style="width:100%">
							<thead class="bg-dark text-light">
								<tr>
									<th>Email</th>
									<th>Nama</th>
									<th>No HP</th>
								</tr>
							</thead>
							<tbody class="text-light">
								<?php
								$tamu = query("SELECT * FROM user WHERE role = 'Tamu'");
								?>
								<?php foreach ($tamu as $row) : ?>
									<tr>
										<td>
											<div class="d-flex">
												<img src="./img/user/pp/<?= $row['gambar']; ?>" style="width: 35px;" class="rounded" alt="PP">
												<a class="mx-1 " style="text-decoration: none;" href="./detail.php?user=<?= $row['username']; ?>"><?= $row['username']; ?></a>
											</div>
										</td>
										<td><?= $row['nama']; ?></td>
										<td><?= $row['no_hp']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- tabel -->
			</div>
		</div>

	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
</body>

</html>