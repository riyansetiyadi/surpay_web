 <?php
  //var_dump($phone_number);

  $ambil = $koneksi->query("SELECT * FROM transactions where phone_number='$phone_number' order by idhadiah desc ");

  $translations = [
    "survey_reward" => "Hadiah Survey",
    "withdrawal" => "Penarikan",
    "reward_referral" => "Hadiah referral",
  ];
  ?>

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <div class="card mt-3 px-3 mx-3">
   <div class="card-body">
     <table class="table table-light table-striped">
       <thead>
         <tr>
           <th>Tipe</th>
           <th>ID Survey</th>
           <th>Undian</th>
           <th>Tanggal</th>
           <th>Poin</th>
         </tr>
       </thead>
       <tbody>
         <?php $total = 0 ?>
         <?php while ($pecah = $ambil->fetch_assoc()) { ?>
           <tr>
             <td><?= $translations[$pecah['type']]; ?></td>
             <td><?php echo $pecah["idsurvey"]; ?></td>
             <td><?php echo $pecah["undian"]; ?></td>
             <td><?php echo $pecah["jam"]; ?></td>
             <td><?php echo $poin = $pecah["poin"]; ?></td>
             <?php $total = $total + $poin ?>
           </tr>
         <?php } ?>
         <tr style="background-color: grey">
           <td colspan="4">Total</td>
           <td>Rp.<?php echo number_format($total) ?></td>
         </tr>
       </tbody>
     </table>
   </div>
 </div>