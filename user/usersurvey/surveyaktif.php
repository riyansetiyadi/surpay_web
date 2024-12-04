<?php
$id = $_SESSION['id'];
$user_data = $koneksi->query("SELECT * FROM user WHERE iduser='$id';")->fetch_assoc();

if (isset($_POST['submit'])) {
  $kata = $_POST["keyword"];
  $ambil = $koneksi->query("SELECT * FROM survey_set WHERE title LIKE '%$kata%' OR description LIKE '%$kata%' ");
} else {
  $ambil = mysqli_query($koneksi, "SELECT * from survey_set WHERE NOT EXISTS (SELECT idsurvey, nama from jawaban where survey_set.id=jawaban.idsurvey and iduser='$user_data[iduser]')  order by id desc ");
}


?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="row mt-3 mx-2" style="width: 25%">
  <form method="post" class="d-flex">
    <input type="text" class="form-control" name="keyword" placeholder="cari" class="col-xs-8">
    <button class="btn btn-primary" name="submit" class="col-xs-4">cari</button>
  </form>
</div>

<div class="row mt-3 mx-2 my-5">
  <?php while ($pecah = $ambil->fetch_assoc()) { ?>
    <div class="col-xs-4 col-md-4 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title" style="font-weight: bold"><?php echo $pecah["title"]; ?></h5>
          <?php echo $pecah["description"]; ?>
          <hr>
          <div>
            <span style="color: blue">Poin: <?php echo $pecah['poin'] ?></span> <br>
            <span style="color: red">Undian: <?php echo $pecah['undian'] ?></span>
          </div>
          <hr>
          <a href="index.php?halaman=item&id=<?php echo $pecah['id'] ?>" class="btn btn-warning">ikut survey</a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>