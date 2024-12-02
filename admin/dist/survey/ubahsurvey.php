<?php

$id = $_GET['id'];

$ambil = $koneksi->query("SELECT * from survey_set where id='$id' ");

$pecah = $ambil->fetch_assoc();


?>
<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label for="" class="control-label">Title</label>
			<input type="text" name="title" class="form-control" required value="<?php echo $pecah['title'] ?>">
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">Start</label>
			<input type="date" name="start_date" class="form-control" required value="<?php echo $pecah['start_date'] ?>">
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">End</label>
			<input type="date" name="end_date" class="form-control" required value="<?php echo $pecah['end_date'] ?>">
		</div>
	</div>


	<div class="form-group">
		<label class="control-label">Description</label>
		<input name="description" class="form-control" required value="<?php echo $pecah['description'] ?>"></input>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">poin</label>
			<input type="text" name="poin" class="form-control" value="<?php echo $pecah['poin'] ?>">
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">undian</label>
			<input type="text" name="undian" class="form-control" value="<?php echo $pecah['undian'] ?>">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">Limit responden</label>
			<input type="text" name="limit_respondents" class="form-control" value="<?php echo $pecah['limit_respondents'] ?>">
		</div>
	</div>
	<hr>
	<div class="col-lg-12 text-right justify-content-center d-flex">
		<button class="btn btn-primary" name="save">simpan</button>

	</div>
</form>

<?php

if (isset($_POST['save'])) {


	$title = htmlspecialchars($_POST["title"]);
	$description = htmlspecialchars($_POST["description"]);
	$start_date = htmlspecialchars($_POST["start_date"]);
	$end_date = htmlspecialchars($_POST["end_date"]);
	$poin = htmlspecialchars($_POST["poin"]);
	$undian = htmlspecialchars($_POST["undian"]);
	$limit_respondents = htmlspecialchars($_POST["limit_respondents"]);

	$koneksi->query("UPDATE survey_set SET title='$title', description='$description', start_date='$start_date', end_date='$end_date',poin='$poin', undian='$undian', limit_respondents='$limit_respondents' WHERE id='$_GET[id]' ");


	if (mysqli_affected_rows($koneksi) > 0) {
		echo "
	<script>
	document.location.href='index.php?halaman=surveyall';
	</script>
	";
	} else {
		echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=ubahsurvey';
	</script>
	";
	}
}

?>