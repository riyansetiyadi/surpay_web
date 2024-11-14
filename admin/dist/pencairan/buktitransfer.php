<?php  
$id=$_GET['id'];

?>


<form method="post"  enctype="multipart/form-data">    

						

						<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">bukti</label>
							<input type="file" name="bukti" class="form-control"  >
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



$status='transfered';

$bukti = $_FILES['bukti']['name'];
$lokasibukti = $_FILES['bukti']['tmp_name'];


if (!empty($lokasibukti)) {

move_uploaded_file($lokasibukti, 'pencairan/bukti/'.$bukti);

};


		$koneksi->query("UPDATE tarik SET bukti='$bukti' , status='$status' where idtarik='$id' ");

	
	if (mysqli_affected_rows($koneksi)>0) {
	echo "
	<script>
	document.location.href='index.php?halaman=penarikan';
	</script>
	";

} else {
	echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=penarikan';
	</script>
	";

}

}//kurung pertama

?>