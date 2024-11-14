 

<?php 
//error_reporting(0);



$ambil=$koneksi->query("SELECT * from hadiah  order by idhadiah desc  ;  "); 

 ?>


<br> <br>	
	
<div class="row" style="margin-left: 20px; width: 25%">

    <form method="post">
      <input type="text" name="keyword" placeholder="cari" class="col-xs-8">
      <button class="btn-kecil" name="submit" class="col-xs-4" >cari</button>
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
			<th>idsurvey</th>
			<th>poin</th>
			<th>undian</th>
			<th>jam</th>
			<th>status</th>
			<th>bukti</th>
			
			
			
			<th>aksi</th>
		</tr>

	</thead>
	<tbody>
		<?php  ?>
		<?php while ($pecah=$ambil->fetch_assoc())  { ?>
		<tr>

			<td><?php echo $pecah["idhadiah"]; ?></td>
			<td><?php echo $pecah["nama"]; ?></td>
			<td><?php echo $pecah["idsurvey"]; ?></td>
			<td><?php echo $pecah["poin"]; ?></td>
			<td><?php echo $pecah["undian"]; ?></td>
			<td><?php echo $pecah["jam"]; ?></td>
			<td><?php echo $pecah["status"]; ?></td>
	
		<td><a href="pencairan/bukti/<?php echo $pecah['bukti'] ?>" target='_blank'><img src="pencairan/bukti/<?php echo $pecah['bukti'] ?>" width=80></a></td>
	



 
		</tr>
		<?php } ?>
		
	</tbody>

</table>









