<h1>ubah profil</h1>

<?php 

//ambil tangggal skr
date_default_timezone_set('Asia/Jakarta');


if(!isset($_SESSION['login'])){
  header("location:login.php");
  exit;}

var_dump($nama);





	$ambil=$koneksi->query("SELECT * FROM  user WHERE nohp='$nama'  "); 

 ?>

<div class="container">
<form method="post">

	

 <?php while ($pecah=$ambil->fetch_assoc())  { ?>

<div class="col-md-6">
	<div class="form-group row">
		<label class="col-md-3 col-form-label">no Hp</label>
		<div class="col-md-4">
		<input type="text" name="nohp" class="form-control" required="" value="<?php echo $pecah['nohp'] ?>" readonly>
	</div>
	</div>
	</div>


<div class="col-md-6">
	<div class="form-group row">
		<label class="col-md-3 col-form-label">nama lengkap</label>
		<div class="col-md-4">
		<input type="text" name="nama_lengkap" class="form-control" required="" value="<?php echo $pecah['nama_lengkap'] ?>">
	</div>
	</div>
	</div>

<div class="col-md-6">
	<div class="form-group row">
		<label class="col-md-3 col-form-label">password</label>
		<div class="col-md-4">
		<input type="text" name="password" class="form-control" required="" value="<?php echo $pecah['password'] ?>">
	</div>
	</div>
	</div>

<?php } ?>	
<br>



	<button class="btn btn-primary" name="save">simpan</button>
</form>
</div>
</div>

<?php 




if (isset ($_POST['save'])) 

{

date_default_timezone_set('Asia/Jakarta');
$tanggal=date('Y-m-d H:m:s');	

$nama_lengkap=htmlspecialchars($_POST["nama_lengkap"]);
$password=htmlspecialchars($_POST["password"]);
$nohp=htmlspecialchars($_POST["nohp"]);




$koneksi->query ("UPDATE user SET nama_lengkap='$nama_lengkap', password='$password' where nohp='$nohp' ");

	 echo "<script> location='index.php?halaman=profil'; </script> ";
	
};

?>