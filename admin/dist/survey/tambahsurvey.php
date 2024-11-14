
<form method="post">    <div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Title</label>
							<input type="text" name="title" class="form-control" required value="<?php echo isset($stitle) ? $stitle : '' ?>">
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">Start</label>
							<input type="date" name="start_date" class="form-control" required value="<?php echo isset($start_date) ? $start_date : '' ?>">
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">End</label>
							<input type="date" name="end_date" class="form-control" required value="<?php echo isset($end_date) ? $end_date : '' ?>">
						</div>
						</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea name="description" id="" cols="30" rows="4" class="form-control" required><?php echo isset($description) ? $description : '' ?></textarea>
						</div>
					</div>
				
						<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">poin</label>
							<input type="text" name="poin" class="form-control" >
						</div>
						</div>

						<div class="col-md-4">
						<div class="form-group">
							<label for="" class="control-label">undian</label>
							<input type="text" name="undian" class="form-control" >
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


$title=htmlspecialchars($_POST["title"]);
$description=htmlspecialchars($_POST["description"]);
$start_date=htmlspecialchars($_POST["start_date"]);
$end_date=htmlspecialchars($_POST["end_date"]);
$poin=htmlspecialchars($_POST["poin"]);
$undian=htmlspecialchars($_POST["undian"]);

$bikin=date('d-m-y');

	$koneksi->query("INSERT INTO survey_set
	(title, description, start_date, end_date, date_created, poin, undian )
	VALUES ('$title', '$description', '$start_date', '$end_date', '$bikin', '$poin', '$undian')
		");

	
	if (mysqli_affected_rows($koneksi)>0) {
	echo "
	<script>
	document.location.href='index.php?halaman=surveyall';
	</script>
	";

} else {
	echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=tambahsurvey';
	</script>
	";

}

}//kurung pertama

?>