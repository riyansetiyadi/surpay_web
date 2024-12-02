 <?php
	//error_reporting(0);



	if (isset($_POST['submit'])) {
		$kata = $_POST["keyword"];
		$ambil = $koneksi->query("SELECT* from user WHERE nama_lengkap LIKE '%$kata%' OR nohp LIKE '%$kata%' order by idjawab desc ");
	} else {
		$ambil = $koneksi->query("SELECT * from user  order by iduser desc  ;  ");
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
 			<th>id</th>
 			<th>username</th>
 			<th>nama</th>
 			<th>usia</th>
 			<th>JK</th>
 			<th>Kab</th>
 			<th>Kec</th>
 			<th>desa</th>
 		</tr>

 	</thead>
 	<tbody>
 		<?php
			while ($pecah = $ambil->fetch_assoc()) {
				$tahunSekarang = date("Y");
				$usia = $tahunSekarang - $pecah["lahir"];
			?>
 			<tr>
 				<td><?php echo $pecah["iduser"]; ?></td>
 				<td><?php echo $pecah["nohp"]; ?></td>
 				<td><?php echo $pecah["nama_lengkap"]; ?></td>
 				<td><?php echo $usia; ?></td>
 				<td><?php echo $pecah["kelamin"]; ?></td>
 				<td><?php echo $pecah["kota"]; ?></td>
 				<td><?php echo $pecah["kecamatan"]; ?></td>
 				<td><?php echo $pecah["kelurahan"]; ?></td>
 			</tr>
 		<?php } ?>

 	</tbody>

 </table>