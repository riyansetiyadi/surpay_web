 <?php
	//error_reporting(0);



	$ambil = $koneksi->query("SELECT idsurvey, pertanyaan, jawaban, count(jawaban) from jawaban group by pertanyaan ");
	$pecah = $ambil->fetch_assoc();

	if (isset($_POST['submit'])) {
		$kata = $_POST["keyword"];
		$ambil = $koneksi->query("SELECT * FROM survey_set WHERE title LIKE '%$kata%' OR description LIKE '%$kata%' ");
	} else {
		$ambil = $koneksi->query("SELECT idsurvey, pertanyaan, jawaban, count(jawaban) as jumlah, idtanya from jawaban group by idtanya, jawaban order by idtanya desc  ;  ");
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

 </div>
 <br>
 <br>
 <table class="table table-bordered">

 	<thead>

 		<tr>
 			<th>idsuvey</th>
 			<th>idtanya</th>
 			<th>pertanyaan</th>
 			<th>jawaban</th>
 			<th>jumlah</th>


 			<th>aksi</th>
 		</tr>

 	</thead>
 	<tbody>
 		<?php  ?>
 		<?php while ($pecah = $ambil->fetch_assoc()) { ?>
 			<tr>

 				<td><?php echo $pecah["idsurvey"]; ?></td>
 				<td><?php echo $pecah["idtanya"]; ?></td>
 				<td><?php echo $tanya = $pecah["pertanyaan"]; ?></td>
 				<td><?php echo $tanya = $pecah["jawaban"]; ?></td>
 				<td><?php echo $tanya = $pecah["jumlah"]; ?></td>




 			</tr>
 		<?php } ?>

 	</tbody>

 </table>