 

<?php 



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
</div>	
<br>
<br>	

<?php while ($pecah=$ambil->fetch_assoc())  { ?>

<div class="row">
<div class="col-xs-4 col-md-4">
<div class="card" >
  <div class="card-body">
    <h5 class="card-title" style="font-weight: bold"><?php echo $pecah["title"]; ?></h5>
    <?php echo $pecah["description"]; ?>
    <hr>
    <div style="">
    <span style="color: blue">Poin: <?php echo $pecah['poin'] ?></span> <br>
    <span style="color: red">Undian: <?php echo $pecah['undian'] ?></span>
    </div>
<hr>
    <a href="index.php?halaman=item&id=<?php echo $pecah['id'] ?>" class="btn btn-warning">ikut survey</a>
   
  </div>
</div>
</div>
</div>
	<br>	
	
		<?php } ?>


<br>

	








