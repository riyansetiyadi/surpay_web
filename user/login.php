<?php 
session_start();
$session_duration = 8000*60*60;   
// session_set_cookie_params($session_duration);
// ini_set('session.gc_maxlifetime', $session_duration);

//jalankan halaman fungsi

require '../admin/dist/function.php';



//jalankan session
//cek cookie

if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {

    $id=$_COOKIE['id'];
    $key=$_COOKIE['key'];



    //ambil nohp berdasarkan id

    $result = mysqli_query($koneksi, "SELECT nohp FROM user WHERE idadmin = $id");

    $row=mysqli_fetch_assoc($result);

    //cek cookie dan nohp

    if ($key===$row['nohp']) {

        $_SESSION['admin'] = $row;

        $_SESSION['login'] = $row;

    }

}


//jika tombol login di tekan

if (isset ($_POST["login"])) {

    $nohp=$_POST["nohp"];

    $password=$_POST["password"];

	 
    


    $result=mysqli_query($koneksi, "SELECT * FROM user WHERE nohp='$nohp'");

    $baris=mysqli_num_rows($result);

    // var_dump($baris);

    //cek nohp

    if (mysqli_num_rows($result)===1) {

    //cek password

        //ambil dulu data password dari db

        $row2=mysqli_fetch_assoc($result);

        //var_dump($row2['password']);

        if ($password==$row2['password']){

        //set sessionnya, sebelumnya jalankan session di code no 1

        
            $_SESSION['admin']= $row2;

            $_SESSION['login']= true;

			      $_SESSION['shift']=$shift;
			      $_SESSION['dokter_rawat']=$dokter_rawat;
            $_SESSION['login_time'] = time();
            
//remember
    setcookie("aku", $row2['idadmin'], time()+120000000);
    setcookie("aku2", $row2['nohp'], time()+120000000);
    setcookie("key2", $row2['password'], time()+120000000);

        
            echo "<script> location='index.php?halaman=utama'; </script> ";
      
        //header('location:home.php');

        exit;

        }
    }

$error=true;

}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - SurPay</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../admin/dist/assets/img/icon.png" rel="icon">
  <link href="../admin/dist/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../admin/dist/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../admin/dist/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              
              <h2  style="margin-top:1px; font-weight: bold; color:darkblue">SurPay: Survey Dibayar</h2>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">masukkan nohp & password Anda</p>
                  </div>

                  <form class="row g-3 needs-validation" method="post">

                    <div class="col-12">
                      <label for="yournohp" class="form-label">nohp</label>
                      <div class="input-group has-validation">
                        <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                        <input type="text" name="nohp" class="form-control" required>
                        <div class="invalid-feedback">Masukkan nohp</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control"  required>
                      <div class="invalid-feedback">Masukkan Password</div>
                    </div>

               
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">Login</button> 
                      <hr>
                      <a href="register.php" class="btn btn-danger" style="margin-left: 10%" >Daftar & dapatkan hadiah</a>
                    </div>
                    <div class="col-12">
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
               Solverra 
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>