<?php

//ambil tangggal skr
date_default_timezone_set('Asia/Jakarta');
if (!isset($_SESSION['id'])) {
	header("location:login.php");
	exit;
}
$ambil = $koneksi->query("SELECT * FROM  user WHERE nohp='$phone_number'  ");
$pecah = $ambil->fetch_assoc();

?>

<script>
	// Fungsi untuk menyalin teks ke clipboard
	function copyToClipboard() {
		var copyText = document.getElementById("referralCode");
		copyText.select();
		copyText.setSelectionRange(0, 99999); // Untuk perangkat mobile
		document.execCommand("copy"); // Menyalin teks ke clipboard

		// Menampilkan notifikasi salin sukses
		alert("Kode Referral disalin: " + copyText.value);
	}

	function shareLink() {
		var url = document.getElementById("referralLink").value;
		if (navigator.share) {
			navigator.share({
				title: 'Kode Referral',
				text: 'Dapatkan manfaat dengan menggunakan kode referral saya!',
				url: url
			}).then(() => {
				console.log('Shared successfully');
			}).catch((error) => {
				console.log('Error sharing', error);
			});
		} else {
			alert('Fitur share tidak didukung oleh browser ini.');
		}
	}
</script>

<div class="card mt-3 px-3 mx-3" style="width: 70%">
	<div class="card-body">
		<div class="container">
			<h3><b>Ubah Profil</b></h3>

			<form method="post" class="mt-3">
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
				<?php
				if ($pecah['referrer_code'] === null || empty($pecah['referrer_code'])) {
				?>
					<div class="col-md-12 mb-2">
						<div class="form-group row">
							<label class="col-md-3 col-form-label">Masukkan kode referral teman anda (optional)</label>
							<div class="col-md-4">
								<input type="text" name="referrer_code" class="form-control">
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="col-md-12 mb-2">
						<div class="form-group row">
							<label class="col-md-3 col-form-label">Kode Referral yang Dipakai</label>
							<div class="col-md-4">
								<input type="text" class="form-control" value="<?php echo $pecah['referrer_code'] ?>" readonly>
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
<div class="card mt-3 px-3 mx-3" style="width: 70%">
	<div class="card-body">
		<div class="container">
			<h3><b>Kode Referral</b></h3>

			<div class="mt-3">
				<div class="input-group">
					<input type="text" class="form-control" id="referralCode" value="<?= htmlspecialchars($pecah['referral_code']); ?>" readonly>
					<button class="btn btn-primary" onclick="copyToClipboard()">Salin</button>
				</div>
			</div>
			<div class="mt-3">
				<div class="input-group">
					<input type="text" class="form-control" id="referralLink" value="https://pfsmytj.localto.net/surpay_web/user/register.php?code_referral=<?= htmlspecialchars($pecah['referral_code']); ?>" readonly>
					<button class="btn btn-primary" onclick="shareLink()">Bagikan</button>
				</div>
			</div>
			<br>
		</div>
	</div>
</div>

<br>
<br>
<br>
<?php

if (isset($_POST['save'])) {

	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('Y-m-d H:m:s');

	$nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
	$password = htmlspecialchars($_POST["password"]);
	$nohp = htmlspecialchars($_POST["nohp"]);
	$referrer_code = htmlspecialchars($_POST["referrer_code"]);

	$koneksi->query("UPDATE user SET nama_lengkap='$nama_lengkap', password='$password', referrer_code='$referrer_code' where nohp='$nohp' ");

	echo "<script> location='index.php?halaman=profil'; </script> ";
};

?>