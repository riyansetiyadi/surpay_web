<?php 


$koneksi->query("DELETE FROM survey_set WHERE id='$_GET[id]' "); 

if (mysqli_affected_rows($koneksi)>0) {
	echo "
	<script>
	document.location.href='index.php?halaman=surveyall';
	</script>
	";

} else {
	echo "
	<script>
	alert('GAGAL!');
	document.location.href='index.php?halaman=surveyall';
	</script>
	";

}


 ?>