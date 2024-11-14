<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SurvPay</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
  <?php 
$id=$_GET['id'];
$nohp=$_SESSION['admin']['nohp'];
//var_dump($nohp);
$ambiluser=$koneksi->query("SELECT * from user where nohp='$nohp' ");
$pecahuser=$ambiluser->fetch_assoc();
$iduser=$pecahuser['iduser'];
//var_dump($iduser);

   ?>

<?php $ambil2=$koneksi->query("SELECT * from pertanyaan where idsurvey='$id' "); ?>
<?php while ($pecah2=$ambil2->fetch_assoc())  { ?>

<?php 
  $idkey=$pecah2['idsurvey'].$pecah2['nomer'];
//var_dump($idkey);
$idkeya=$idkey."a";
$idkeyb=$idkey."b";
$idkeyc=$idkey."c";
$idkeyd=$idkey."d";
?>
<div style="margin-bottom: 60px">
<form method="post">

   <div class="pilihan">
    <div class="title"><?php echo $pecah2['pertanyaan'] ?></div>

           <div class="kodeku"  >

            <input type="radio" name="<?php echo $idkey ?>" id="<?php echo $key ?>" value="<?php echo $pecah2['a'] ?>" required >
            <label for="<?php echo $key ?>"><?php echo $pecah2['a'] ?></label>
            </div>
            <div class="kodeku">
            <input type="radio" name="<?php echo $idkey ?>" id="<?php echo $key ?>" value="<?php echo $pecah2['b'] ?>" >
            <label for="<?php echo $key ?>"><?php echo $pecah2['b'] ?></label>
            </div>

<?php if ($pecah2['c']!=''):?>
             <div class="kodeku">
            <input type="radio" name="<?php echo $idkey ?>" id="<?php echo $key ?>" value="<?php echo $pecah2['c'] ?>" >
            <label for="<?php echo $key ?>"><?php echo $pecah2['c'] ?></label>
            </div>
<?php endif ?>

<?php if ($pecah2['d']!=''):?>
             <div class="kodeku">
            <input type="radio" name="<?php echo $idkey ?>" id="<?php echo $key ?>" value="<?php echo $pecah2['d'] ?>" >
            <label for="<?php echo $key ?>"><?php echo $pecah2['d'] ?></label>
            </div>
<?php endif ?>
<?php } ?>

            
            <div class="form-group">
              <label for="" class="control-label">komentar</label>
              <input type="text" name="komentar" class="form-control" maxlength="150" >
            </div>
            </div>

<br>
            <div class="col-lg-12 text-right justify-content-center d-flex">
            <button class="btn btn-primary" name="save">simpan</button>
            </div>
</form>
</div>
<?php 
if (isset ($_POST['save'])) 


{
?>
<?php $ambil=$koneksi->query("SELECT * from pertanyaan where idsurvey='$id' ") ; ?>

<?php while ($pecah=$ambil->fetch_assoc()) { 
$idsurvey=$pecah['idsurvey'];
var_dump($idsurvey);
$idkey=$pecah['idsurvey'].$pecah['nomer'];
$pertanyaan=$pecah['pertanyaan'];
$komentar=htmlspecialchars($_POST["komentar"]);
//var_dump($idkey);
//var_dump($pertanyaan);


$jawaban=$_POST[$idkey];
//var_dump($jawaban);
//var_dump($iduser);

$koneksi->query("INSERT INTO jawaban
  (nama, iduser, idsurvey,  pertanyaan, jawaban, komentar, idtanya )
  VALUES ('$nohp', '$iduser', '$idsurvey', '$pertanyaan', '$jawaban', '$komentar', '$idkey')
    ");
} 
?>
<?php  
$ambilhadiah=$koneksi->query("SELECT * from survey_set where id='$id' ");
$pecahhadiah=$ambilhadiah->fetch_assoc();
$poin=$pecahhadiah['poin'];
$undian=$pecahhadiah['undian'];

$jam=date('Y-m-d H:i:s');

$koneksi->query("INSERT INTO hadiah
  (nama, iduser, idsurvey,  poin, undian, jam )
  VALUES ('$nohp', '$iduser', '$idsurvey', '$poin', '$undian', '$jam')
    ");
?>

if (mysqli_affected_rows($koneksi)>0) {
  echo "
  <script>
  document.location.href='index.php?halaman=surveyaktif';
  </script>
  ";

} else {
  echo "
  <script>
  alert('GAGAL!');
  document.location.href='index.php?halaman=surveyaktif';
  </script>
  ";

}

<?php };  ?>

 
<hr>
</body>
</html>