<?php  
$id=$_GET['id'];

?>


<form method="post">    <div class="col-md-2">
						<div class="form-group">
							<label for="" class="control-label">nomer</label>
							<input type="text" name="nomer" class="form-control" required >
						</div>
						</div>

						<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">pertanyaan</label>
							<input type="text" name="pertanyaan" class="form-control" required >
						</div>
						</div>

						<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label"> pilihan A</label>
							<input type="text" name="a" class="form-control" required >
						</div>
						</div>

						<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label"> pilihan B</label>
							<input type="text" name="b" class="form-control" required >
						</div>
						</div>

						<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label"> pilihan C</label>
							<input type="text" name="c" class="form-control"  >
						</div>
						</div>

						<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label"> pilihan D</label>
							<input type="text" name="d" class="form-control" >
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


$pertanyaan=htmlspecialchars($_POST["pertanyaan"]);
$nomer=htmlspecialchars($_POST["nomer"]);
$a=htmlspecialchars($_POST["a"]);
$b=htmlspecialchars($_POST["b"]);
$c=htmlspecialchars($_POST["c"]);
$d=htmlspecialchars($_POST["d"]);


	$koneksi->query("INSERT INTO pertanyaan
	(idsurvey, nomer, pertanyaan, a, b, c, d )
	VALUES ('$id', '$nomer', '$pertanyaan', '$a', '$b', '$c', '$d')
		");

	
	if (mysqli_affected_rows($koneksi)>0) {
	echo "
	<script>
	document.location.href='index.php?halaman=tanyaall&id=$id';
	</script>
	";

} else {
	echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=tamtanyaall&id=$id';
	</script>
	";

}

}//kurung pertama

?>