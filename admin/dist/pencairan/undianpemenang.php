<?php  
$h=$_GET['h'];

?>


<form method="post"  enctype="multipart/form-data">    

						<div class="col-md-2">
						<div class="form-group">
							<label for="" class="control-label">pemenang</label>
							<input type="text" name="pemenang" class="form-control" required >
						</div>
						</div>

						<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">bukti</label>
							<input type="file" name="bukti" class="form-control" required=""  >
						</div>
						</div>

						


						


					
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary" name="save">simpan</button>
			
				</div>
			</form>

<?php 
if (isset ($_POST['save'])) 


{


$pemenang=htmlspecialchars($_POST["pemenang"]);
$hadiah=$h;
$bikin=date('Y-m-d H:i:s');
$status='sudah diundi';

$bukti = $_FILES['bukti']['name'];
$lokasibukti = $_FILES['bukti']['tmp_name'];

$ambilp=$koneksi->query("SELECT * from user where nohp='$pemenang'  ;  "); 
$pecahp=$ambilp->fetch_assoc();
$nama_lengkap=$pecahp['nama_lengkap'];
var_dump($nama_lengkap);
//die;

if (!empty($lokasibukti)) {

move_uploaded_file($lokasibukti, 'pencairan/bukti/'.$bukti);

};

if ($nama_lengkap!='') {

	echo "
	<script>
	alert('$nama_lengkap');
	</script>
	";


	$koneksi->query("INSERT INTO undian
	(waktu, hadiah, pemenang, status, bukti, nama_lengkap )
	VALUES ('$bikin', '$hadiah', '$pemenang', '$status', '$bukti', '$nama_lengkap')
		");
	var_dump($status);
	var_dump($bukti);
	//die;

	$koneksi->query("UPDATE hadiah SET status='$status' , bukti='$bukti' where undian='$hadiah' ");

	
if (mysqli_affected_rows($koneksi)>0) {
	echo "
	<script>
	document.location.href='index.php?halaman=undian';
	</script>
	";

} else {
	echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=undian';
	</script>
	";

}
}

else {
echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=undian';
	</script>
	";
} 





	

}//kurung pertama

?>