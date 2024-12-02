 <?php

  $id = $_COOKIE['id'];

  $result = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = $id");
  $userdata = mysqli_fetch_assoc($result);

  $ambil = $koneksi->query("SELECT phone_number, sum(poin) as total, transactions.iduser, user.nama_lengkap FROM transactions join user on transactions.iduser=user.iduser where phone_number='$userdata[nohp]' group by phone_number ");
  $pecah = $ambil->fetch_assoc()

  ?>
 <br>

 <div class="row mx-2">
   <div class="col-xs-4 col-md-4">
     <div class="card">
       <div class="card-body">
         <p>Total pendapatan dari: </p>
         <h5 class="card-title" style="font-weight: bold">Nomor telepon: <?php echo $userdata["nohp"]; ?></h5>
         <p>nama: <?php echo $userdata['nama_lengkap'] ?></p>
         <hr>
         <div>
           <span style="color: red; font-size: 20px;">Total Pendapatan: Rp. <?php echo number_format($pecah['total'] ?? 0) ?></span> <br>

         </div>
         <hr>
         <a href="index.php?halaman=tarikdana&nohp=<?php echo $pecah['phone_number'] ?>" class="btn btn-warning">Tarik Dana</a>

       </div>
     </div>
   </div>
 </div>
 <br>