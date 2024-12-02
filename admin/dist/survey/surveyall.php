 <?php
	//error_reporting(0);

	if (isset($_POST['submit'])) {
		$kata = $_POST["keyword"];
		$ambil = $koneksi->query("SELECT * FROM survey_set WHERE title LIKE '%$kata%' OR description LIKE '%$kata%' ");
	} else {
		$ambil = $koneksi->query("SELECT * from survey_set order by id desc;");
	}


	?>


 <br> <br>

 <div class="" style="margin-left: 20px;">

 	<form method="post" style="width: 75%">
 		<div class="row">
 			<div class="col-8">
 				<input type="text" name="keyword" placeholder="cari" class="form-control form-control-sm">
 			</div>
 			<button name="submit" class="col-4 btn btn-sm btn-secondary">cari</button>
 		</div>
 	</form>
 	<br>
 	<a href="index.php?halaman=tambahsurvey" class="btn btn-primary" style="width: 25%">tambah data</a>
 </div>

 <table class="table table-bordered">

 	<thead>

 		<tr>
 			<th>id</th>
 			<th>judul</th>
 			<th>deskripsi</th>
 			<th>start</th>
 			<th>end</th>
 			<th>created</th>
 			<th>poin</th>
 			<th>undian</th>
 			<th>pertanyaan</th>
 			<th>Jumlah responden</th>
 			<th>Maksimal responden</th>

 			<th>aksi</th>
 		</tr>

 	</thead>
 	<tbody>
 		<?php  ?>
 		<?php while ($pecah = $ambil->fetch_assoc()) {
				$getCountResponden = $koneksi->query("SELECT COUNT(DISTINCT iduser) AS total_responden FROM `jawaban` WHERE idsurvey=$pecah[id];")->fetch_assoc();
			?>
 			<tr>

 				<td><?php echo $pecah["id"]; ?></td>
 				<td><?php echo $pecah["title"]; ?></td>
 				<td><?php echo $pecah["description"]; ?></td>
 				<td><?php echo $pecah["start_date"]; ?></td>
 				<td><?php echo $pecah["end_date"]; ?></td>
 				<td><?php echo $pecah["date_created"]; ?></td>
 				<td><?php echo $pecah["poin"]; ?></td>
 				<td><?php echo $pecah["undian"]; ?></td>
 				<td><a href="index.php?halaman=entritanya&id=<?php echo $pecah['id'] ?> " class="btn btn-primary btn-sm">entri</a><br>
 					<a href="index.php?halaman=tanyaall&id=<?php echo $pecah['id'] ?> " class="btn btn-warning btn-sm">view</a>
 				</td>
 				<td><?php echo $getCountResponden["total_responden"]; ?></td>
 				<td><?php echo $pecah["limit_respondents"]; ?></td>

 				<td>
 					<a href="index.php?halaman=ubahsurvey&id=<?php echo $pecah['id'] ?> " class="btn btn-warning btn-sm">ubah</a> <br>
 					<a href="index.php?halaman=hapussurvey&id=<?php echo $pecah['id'] ?> " class="btn btn-danger btn-sm">hapus</a>
 				</td>
 			</tr>
 		<?php } ?>
 	</tbody>

 </table>