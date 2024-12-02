 <?php
	//error_reporting(0);

	$id = $_GET['id'];

	$ambil = $koneksi->query("SELECT * from pertanyaan where idsurvey=$id order by nomer asc ");
	$pecah = $ambil->fetch_assoc();

	if (isset($_POST['submit'])) {
		$kata = $_POST["keyword"];
		$ambil = $koneksi->query("SELECT * FROM survey_set WHERE title LIKE '%$kata%' OR description LIKE '%$kata%' ");
	} else {
		$ambil = $koneksi->query("SELECT * from pertanyaan where idsurvey=$id order by nomer asc  ;  ");
	}


	?>


 <br> <br>

 <div class="row" style="margin-left: 20px; width: 25%">

 	<form method="post">
 		<input type="text" name="keyword" placeholder="cari" class="col-xs-8">
 		<button class="btn-kecil" name="submit" class="col-xs-4">cari</button>
 	</form>
 	<br>
 	<br>
 	<a href="index.php?halaman=entritanya&id=<?php echo $id ?>" class="btn btn-primary">tambah data</a>
 </div>
 <br>
 <br>
 <table class="table table-bordered">

 	<thead>

 		<tr>
 			<th>nomor</th>
 			<th>pertanyaan</th>
 			<th>A</th>
 			<th>B</th>
 			<th>C</th>
 			<th>D</th>
 			<th>E</th>

 			<th>aksi</th>
 		</tr>

 	</thead>
 	<tbody>
 		<?php  ?>
 		<?php while ($pecah = $ambil->fetch_assoc()) { ?>
 			<tr>

 				<td><?php echo $pecah["nomer"]; ?></td>
 				<td><?php echo $pecah["pertanyaan"]; ?></td>
 				<td><?php echo $pecah["a"]; ?></td>
 				<td><?php echo $pecah["b"]; ?></td>
 				<td><?php echo $pecah["c"]; ?></td>
 				<td><?php echo $pecah["d"]; ?></td>
 				<td><?php echo $pecah["e"]; ?></td>


 				<td>
 					<a href="index.php?halaman=ubahtanya&id=<?php echo $pecah['id'] ?> " class="btn btn-warning">ubah</a>
 					<a href="index.php?halaman=hapustanya&id=<?php echo $pecah['id'] ?> " class="btn btn-danger">hapus</a>
 				</td>
 			</tr>
 		<?php } ?>
 	</tbody>

 </table>