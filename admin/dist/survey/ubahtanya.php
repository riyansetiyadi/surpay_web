<?php

$id = $_GET['id'];

$ambil = $koneksi->query("SELECT * from pertanyaan where id='$id'");

$pecah = $ambil->fetch_assoc();


?>
<form method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label for="" class="control-label">Nomor</label>
			<input type="text" name="nomor" class="form-control" required value="<?php echo $pecah['nomer'] ?>">
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">Pertanyaan</label>
			<input type="text" name="pertanyaan" class="form-control" required value="<?php echo $pecah['pertanyaan'] ?>">
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">A</label>
			<input type="text" type="date" name="a" class="form-control" value="<?php echo $pecah['a'] ?>">
		</div>
	</div>


	<div class="form-group">
		<label class="control-label">B</label>
		<input type="text" name="b" class="form-control" value="<?php echo $pecah['b'] ?>"></input>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">C</label>
			<input type="text" name="c" class="form-control" value="<?php echo $pecah['c'] ?>">
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">D</label>
			<input type="text" name="d" class="form-control" value="<?php echo $pecah['d'] ?>">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="" class="control-label">E</label>
			<input type="text" name="e" class="form-control" value="<?php echo $pecah['e'] ?>">
		</div>
	</div>
	<hr>
	<div class="col-lg-12 text-right justify-content-center d-flex">
		<button class="btn btn-primary" name="save">Simpan</button>

	</div>
</form>

<?php

if (isset($_POST['save'])) {


	$nomor = htmlspecialchars($_POST["nomor"]);
	$pertanyaan = htmlspecialchars($_POST["pertanyaan"]);
	$a = htmlspecialchars($_POST["a"]);
	$b = htmlspecialchars($_POST["b"]);
	$c = htmlspecialchars($_POST["c"]);
	$d = htmlspecialchars($_POST["d"]);
	$e = htmlspecialchars($_POST["e"]);

	$koneksi->query("UPDATE pertanyaan SET nomer='$nomor', pertanyaan='$pertanyaan', a='$a', b='$b', c='$c', d='$d', e='$e' WHERE id='$_GET[id]' ");


	if (mysqli_affected_rows($koneksi) > 0) {
		echo "
	<script>
	document.location.href='index.php?halaman=tanyaall&id=$pecah[idsurvey]';
	</script>
	";
	} else {
		echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=ubahtanya&id=$id';
	</script>
	";
	}
}

?>