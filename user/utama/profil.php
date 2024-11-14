<?php

//ambil tangggal skr
date_default_timezone_set('Asia/Jakarta');
if (!isset($_SESSION['login'])) {
	header("location:login.php");
	exit;
}
$ambil = $koneksi->query("SELECT * FROM  user WHERE nohp='$nama'  ");

?>
<div class="card mt-3 px-3 mx-3" style="width: 70%">
	<div class="card-body">
		<div class="container">
			<h3><b>Ubah Profil</b></h3>

			<form method="post" class="mt-3">
				<?php while ($pecah = $ambil->fetch_assoc()) { ?>
					<div class="col-md-12 mb-2">
						<div class="form-group row">
							<label class="col-md-3 col-form-label">No Hp</label>
							<div class="col-md-4">
								<input type="text" name="nohp" class="form-control" required="" value="<?php echo $pecah['nohp'] ?>" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-12 mb-2">
						<div class="form-group row">
							<label class="col-md-3 col-form-label">Nama Lengkap</label>
							<div class="col-md-4">
								<input type="text" name="nama_lengkap" class="form-control" required="" value="<?php echo $pecah['nama_lengkap'] ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12 mb-2">
						<div class="form-group row">
							<label class="col-md-3 col-form-label">Password</label>
							<div class="col-md-4">
								<input type="text" name="password" class="form-control" required="" value="<?php echo $pecah['password'] ?>">
							</div>
						</div>
					</div>
				<?php } ?>
				<br>
				<button class="btn btn-primary" name="save">Simpan</button>
			</form>
		</div>
	</div>
</div>
</div>
<?php

if (isset($_POST['save'])) {

	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('Y-m-d H:m:s');

	$nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
	$password = htmlspecialchars($_POST["password"]);
	$nohp = htmlspecialchars($_POST["nohp"]);




	$koneksi->query("UPDATE user SET nama_lengkap='$nama_lengkap', password='$password' where nohp='$nohp' ");

	echo "<script> location='index.php?halaman=profil'; </script> ";
};

?>