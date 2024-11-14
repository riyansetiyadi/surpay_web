 

<?php 

$nama=$username;
//var_dump($nama);

$ambil=$koneksi->query("SELECT * from hadiah where nama='$nama' order by idhadiah desc ");


 ?>


<br> 

<table class="table table-bordered">

  <thead>

    <tr style="background-color: grey">
      
      <th>idsurvey</th>
      <th>poin</th>
      <th>undian</th>
      <th>jam</th>
     
    </tr>

  </thead>
  <tbody>
    <?php  $total=0 ?>
    <?php while ($pecah=$ambil->fetch_assoc())  { ?>
    <tr>

      <td><?php echo $pecah["idsurvey"]; ?></td>
      <td><?php echo $poin=$pecah["poin"]; ?></td>
      <td><?php echo $pecah["undian"]; ?></td>
      <td><?php echo $pecah["jam"]; ?></td>
      <?php $total=$total+$poin ?>
    </tr>
    <?php } ?>
    <tr style="background-color: grey">
      <td>total</td>
      <td colspan="3">Rp.<?php echo number_format($total) ?></td>
    </tr>
    <hr>
  </tbody>

</table>

	








