<?php
$id = $_SESSION['id'];
$user_data = $koneksi->query("SELECT * FROM user WHERE iduser='$id';")->fetch_assoc();

$koneksi->query("DROP TABLE utama");

$koneksi->query(" 
CREATE TABLE IF NOT EXISTS utama
SELECT nama_lengkap, ket, jumlah, tanda as hadiah, bukti, date_format(bikin, '%d/%m/%Y') as bikin FROM tarik WHERE iduser='$id'
UNION 
SELECT pemenang, ket, jumlah, hadiah, bukti, date_format(waktu, '%d/%m/%Y') FROM undian WHERE pemenang='$id'
");

$koneksi->query("DROP TABLE utama2");

$koneksi->query(" 
CREATE TABLE IF NOT EXISTS utama2
SELECT *, str_to_date(bikin, '%Y/%m/%d') as bikin2 from utama order by bikin2 desc
");

$ambil = $koneksi->query("SELECT * from utama order by bikin desc;");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<div class="card mt-3 px-3 mx-3">
	<div class="card-body">
		<table class="table table-light table-striped">
			<thead>
				<tr>
					<th>Tanggal Pembuatan</th>
					<th>Nama Lengkap</th>
					<th>Bukti</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($pecah = $ambil->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $pecah['bikin'] ?></td>
						<td><?php echo $pecah["nama_lengkap"]; ?> </td>
						<?php if ($pecah['bukti'] != ''): ?>
							<td>
								<a class="btn btn-warning" style="color: white;" href="../admin/dist/pencairan/bukti/<?php echo $pecah['bukti'] ?>">
									<?php echo $pecah["ket"]; ?>
									<?php echo $pecah["jumlah"]; ?>
									<?php echo $pecah["hadiah"]; ?>
								</a>
							</td>
						<?php else: ?>
							<td>
							</td>
						<?php endif ?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>