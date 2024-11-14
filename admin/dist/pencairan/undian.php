 

<?php 
//error_reporting(0);



$ambil=$koneksi->query("SELECT undian, status, idsurvey from hadiah where status!='sudah diundi' and undian!='' group by undian order by idsurvey asc;  "); 

 ?>

	
<a href="index.php?halaman=dataundian" class="btn btn-primary" style="width: 10%">data undian</a>

<table class="table table-bordered">

	<thead>

		<tr>
			<th>idsurvey</th>
			<th>undian</th>
			
			
			
			
			<th>aksi</th>
		</tr>

	</thead>
	<tbody>
		<?php  ?>
		<?php while ($pecah=$ambil->fetch_assoc())  { ?>
		<tr>

			<td><?php echo $pecah["idsurvey"]; ?></td>
			<td><?php echo $pecah["undian"]; ?></td>
			
			<td><a href="index.php?halaman=undianpemenang&h=<?php echo $pecah['undian'] ?>" class="btn btn-primary">pemenang</a></td>



 
		</tr>
		<?php } ?>
		
	</tbody>

</table>









