 

<?php 
//error_reporting(0);



if (isset($_POST['submit'])) 

{
	$kata=$_POST["keyword"];
	$ambil=$koneksi->query("SELECT* from tarik WHERE user LIKE '%$kata%' OR nama_lengkap LIKE '%$kata%' OR namarekening LIKE '%$kata%' order by idtarik desc "); 


}
else {
$ambil=$koneksi->query("SELECT * from tarik  order by idtarik desc  ;  "); 
}


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
			<th>Username</th>
			<th>Nama User</th>
			<th>Jumlah</th>
			<th>Nama Rekening</th>
			<th>Rekening</th>
			<th>Bank</th>
			<th>Bikin</th>
			<th>Status</th>
			<th>bukti</th>
			
			
			
			<th>aksi</th>
		</tr>

	</thead>
	<tbody>
		<?php  ?>
		<?php while ($pecah=$ambil->fetch_assoc())  { ?>
		<tr>

			<td><?php echo $pecah["idtarik"]; ?></td>
			<td><?php echo $pecah["user"]; ?></td>
			<td><?php echo $pecah["nama_lengkap"]; ?></td>
			<td><?php echo $pecah["jumlah"]; ?></td>
			<td><?php echo $pecah["namarekening"]; ?></td>
			<td><?php echo $pecah["rekening"]; ?></td>
			<td><?php echo $pecah["bank"]; ?></td>
			<td><?php echo $pecah["bikin"]; ?></td>
			<td><?php echo $pecah["status"]; ?></td>
			<td><a href="pencairan/bukti/<?php echo $pecah['bukti'] ?>" target='_blank'><img src="pencairan/bukti/<?php echo $pecah['bukti'] ?>" width=80></a></td>
			<td><a href="index.php?halaman=buktitransfer&id=<?php echo $pecah['idtarik'] ?>" class='btn btn-primary'>transfer</a></td>


 
		</tr>
		<?php } ?>
		
	</tbody>

</table>









