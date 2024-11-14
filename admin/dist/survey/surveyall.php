 

<?php 
//error_reporting(0);


$ambil=$koneksi->query("SELECT * from survey_set order by id desc ");
$pecah=$ambil->fetch_assoc();

if (isset($_POST['submit'])) 

{
	$kata=$_POST["keyword"];
	$ambil=$koneksi->query("SELECT * FROM survey_set WHERE title LIKE '%$kata%' OR description LIKE '%$kata%' "); 


}
else {
$ambil=$koneksi->query("SELECT * from survey_set order by id desc  ;  "); 
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
<a href="index.php?halaman=tambahsurvey" class="btn btn-primary">tambah data</a>
</div>	
<br>
<br>	
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
			<th>tanya</th>
			
			<th>aksi</th>
		</tr>

	</thead>
	<tbody>
		<?php  ?>
		<?php while ($pecah=$ambil->fetch_assoc())  { ?>
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
			<a href="index.php?halaman=tanyaall&id=<?php echo $pecah['id'] ?> " class="btn btn-warning btn-sm">view</a></td>		
						
			<td>
				<a href="index.php?halaman=ubahsurvey&id=<?php echo $pecah['id'] ?> " class="btn btn-warning btn-sm">ubah</a> <br>
				<a href="index.php?halaman=hapussurvey&id=<?php echo $pecah['id'] ?> " class="btn btn-danger btn-sm">hapus</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>









