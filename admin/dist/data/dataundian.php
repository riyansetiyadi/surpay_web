 

<?php 
//error_reporting(0);



$ambil=$koneksi->query("SELECT * from undian order by  id desc;  "); 

 ?>

	


<table class="table table-bordered">

	<thead>

		<tr>
			<th>id</th>
			<th>waktu</th>
			<th>hadiah</th>
			<th>pemenang</th>
			<th>nama_lengkap</th>
			<th>status</th>
			<th>bukti</th>
			
		</tr>

	</thead>
	<tbody>
		<?php  ?>
		<?php while ($pecah=$ambil->fetch_assoc())  { ?>
		<tr>

			<td><?php echo $pecah["id"]; ?></td>
			<td><?php echo $pecah["waktu"]; ?></td>
			<td><?php echo $pecah["hadiah"]; ?></td>
			<td><?php echo $pecah["pemenang"]; ?></td>
			<td><?php echo $pecah["nama_lengkap"]; ?></td>
			<td><?php echo $pecah["status"]; ?></td>
			<td><a href="pencairan/bukti/<?php echo $pecah['bukti']; ?>"><img src="pencairan/bukti/<?php echo $pecah['bukti'] ?>" width=80></a></td>
			
			



 
		</tr>
		<?php } ?>
		
	</tbody>

</table>









