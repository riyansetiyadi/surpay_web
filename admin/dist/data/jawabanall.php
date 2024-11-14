 

<?php 
//error_reporting(0);



if (isset($_POST['submit'])) 

{
	$kata=$_POST["keyword"];
	$ambil=$koneksi->query("SELECT* from jawaban WHERE nama LIKE '%$kata%' OR pertanyaan LIKE '%$kata%' order by idjawab desc "); 


}
else {
$ambil=$koneksi->query("SELECT* from jawaban  order by idjawab desc  ;  "); 
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
			<th>nama</th>
			<th>idtanya</th>
			<th>pertanyaan</th>
			<th>jawaban</th>
			<th>komentar</th>
			
			
			<th>aksi</th>
		</tr>

	</thead>
	<tbody>
		<?php  ?>
		<?php while ($pecah=$ambil->fetch_assoc())  { ?>
		<tr>

			<td><?php echo $pecah["idtanya"]; ?></td>
			<td><?php echo $pecah["nama"]; ?></td>
			<td><?php echo $pecah["idtanya"]; ?></td>
			<td><?php echo $tanya=$pecah["pertanyaan"]; ?></td>
			<td><?php echo $tanya=$pecah["jawaban"]; ?></td>
			<td><?php echo $tanya=$pecah["komentar"]; ?></td>



 
		</tr>
		<?php } ?>
		
	</tbody>

</table>









