<?php 

$id=$_GET['id'];
$ambil=$koneksi->query("SELECT nama, sum(poin) as total, hadiah.iduser, nama_lengkap from hadiah join user on hadiah.iduser=user.iduser where nama='$id' group by nama ");
$pecah=$ambil->fetch_assoc();
$namauser=$pecah['nama_lengkap'];
$jumlahmax=$pecah['total'];
$iduser=$pecah['iduser']
 ?>
<form method="post">   
						
						 <div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">jumlah yang ditarik</label>
							<input type="text" name="jumlah" class="form-control" required value="<?php echo $pecah['total'] ?>">
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">no rekening</label>
							<input type="text" name="rekening" class="form-control" required >
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Nama Rekening</label>
							<input type="text" name="namarekening" class="form-control" required >
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Nama Bank</label>
							<input type="text" name="bank" class="form-control" required >
						</div>
						</div>

						
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary" name="save">simpan</button>
			
				</div>
			</form>

<?php 
if (isset ($_POST['save'])) 


{



$jumlah=htmlspecialchars($_POST["jumlah"]);
$jumlahtarik=htmlspecialchars($_POST["jumlah"])*-1;
var_dump($jumlahtarik);
$rekening=htmlspecialchars($_POST["rekening"]);
$namarekening=htmlspecialchars($_POST["namarekening"]);
$bank=htmlspecialchars($_POST["bank"]);
$bikin=date('Y-m-d H:i:s');
var_dump($id);
//die;
if (($jumlahmax < $jumlah) OR $jumlah<=0) {
	echo "
	<script>
	alert('jumlah yang anda tarik melebihi total pendapatan anda');
	document.location.href='index.php?halaman=tarikdana&id=$id';
	</script>
	";
} else {
	$koneksi->query("INSERT INTO tarik
	(user, nama_lengkap, jumlah, rekening, namarekening, bank, bikin, iduser )
	VALUES ('$id', '$namauser', '$jumlah', '$rekening', '$namarekening', '$bank', '$bikin', '$iduser')
		");

	$koneksi->query("INSERT INTO hadiah
  (nama, iduser, idsurvey,  poin, undian, jam )
  VALUES ('$id', '$iduser', 'penarikan', '$jumlahtarik', '', '$bikin')
    ");
	
	if (mysqli_affected_rows($koneksi)>0) {
	echo "
	<script>
	document.location.href='index.php?halaman=hadiah';
	</script>
	";

} else {
	echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=tarikdana&id=$id';
	</script>
	";

};
}


	

}//kurung pertama

?>