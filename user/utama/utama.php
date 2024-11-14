
<?php 

$koneksi->query("DROP TABLE utama");

$koneksi->query(" 

CREATE TABLE IF NOT EXISTS utama

SELECT nama_lengkap, ket, jumlah, tanda as hadiah, bukti, date_format(bikin, '%d/%m/%Y') as bikin FROM tarik

UNION 
SELECT pemenang, ket, jumlah, hadiah, bukti, date_format(waktu, '%d/%m/%Y')  FROM undian


");

$koneksi->query("DROP TABLE utama2");

$koneksi->query(" 
CREATE TABLE IF NOT EXISTS utama2

SELECT *, str_to_date(bikin, '%Y/%m/%d') as bikin2 from utama order by bikin2 desc

");

$ambil=$koneksi->query("SELECT * from utama order by bikin desc;  "); 



 ?>


<br> <br>	
	
	
<table class="table">

	<thead>

		<tr>
			
			
			
			
		
		</tr>

	</thead>
	<tbody>
		<?php  ?>
		<?php while ($pecah=$ambil->fetch_assoc())  { ?>
		<tr>
			<td><?php echo $pecah['bikin'] ?></td>
			<td><?php echo $pecah["nama_lengkap"]; ?> </td>
			<?php if($pecah['bukti']!=''): ?>
			<td><a href="../admin/dist/pencairan/bukti/<?php echo $pecah['bukti'] ?>">
			<?php echo $pecah["ket"]; ?>
			<?php echo $pecah["jumlah"]; ?>
			<?php echo $pecah["hadiah"]; ?>
			</a></td>
			<?php endif ?>

			

			<?php if($pecah['bukti']=''): ?>
			<td></td>
			<?php endif ?>



 
		</tr>
		<?php } ?>
		
	</tbody>

</table>









