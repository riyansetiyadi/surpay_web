 

<?php 

$nama=$username;
//var_dump($nama);

$ambil=$koneksi->query("SELECT nama, sum(poin) as total, hadiah.iduser, nama_lengkap from hadiah join user on hadiah.iduser=user.iduser where nama='$nama' group by nama ");


 ?>


<br> 
<?php $pecah=$ambil->fetch_assoc() ?>

<div class="row">
<div class="col-xs-4 col-md-4">
<div class="card" >
  <div class="card-body">
    <p>Total pendapatan dari: </p>
    <h5 class="card-title" style="font-weight: bold">username: <?php echo $pecah["nama"]; ?></h5>
   <p>nama: <?php echo $pecah['nama_lengkap'] ?></p>
    <hr>
    <div style="">
    <span style="color: red; font-size: 20px;">Total Pendapatan: Rp. <?php echo number_format($pecah['total']) ?></span> <br>
   
    </div>
<hr>
    <a href="index.php?halaman=tarikdana&id=<?php echo $pecah['nama'] ?>" class="btn btn-warning">Tarik Dana</a>
   
  </div>
</div>
</div>
</div>
  <br>  
  
  



	








