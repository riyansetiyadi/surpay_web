<?php

$id = $_GET['id'];
$idsurvey = $koneksi->query("SELECT * FROM pertanyaan WHERE id='$id'")->fetch_assoc()['idsurvey'];
$koneksi->query("DELETE FROM pertanyaan WHERE id='$id' ");

if (mysqli_affected_rows($koneksi) > 0) {
	echo "
	<script>
	document.location.href='index.php?halaman=tanyaall&id=$idsurvey';
	</script>
	";
} else {
	echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=tanyaall&id=$idsurvey';
	</script>
	";
}
