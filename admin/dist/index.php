<?php session_start(); ?>


<?php

$session_duration = 8 * 60 * 60;
date_default_timezone_set('Asia/Jakarta');
if (isset($_SESSION['login_time'])) {
  if (time() - $_SESSION['login_time'] > $session_duration) {
    // Redirect ke halaman login atau berikan pesan sesi kedaluwarsa
    header("location:logout.php");
  }
}
include 'function.php';
$username = $_SESSION['admin']['username'];
$level = $_SESSION['admin']['level'];



if (!isset($_SESSION['login'])) {

  echo "<script> location='login.php'; </script> ";

  exit;
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!-- <meta content="width=device-width, initial-scale=1.0" name="viewport"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


  <title>Dashboard - Surpay</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/khm.png" rel="icon">
  <link href="assets/img/icons8-hospital-3-100.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
  <?php if (!isset($_GET['halaman'])) { ?>
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
  <?php } ?>
  <!-- DATATABLES -->
  <link href="https://code.jquery.com/jquery-3.5.1.js" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">



  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logokhm.png" alt="">
        <span class="d-none d-lg-block">SurPay</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/messages-2.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $username ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <?php //if($level == 'perawat' or $level == 'ceo'  or $level == 'sup' or $level == 'inap' or $level == 'gizi' or $level == 'apoteker') {
      ?>

      <li class="nav-heading">Survey</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?halaman=surveyall">
          <i class="bi bi-journal-text"></i><span>Survey All</span></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?halaman=rekapjawaban">
          <i class="bi bi-journal-text"></i><span>Rekap Jawaban</span></i>
        </a>
      </li>
      <?php //} 
      ?>




      <li class="nav-heading">Data-data</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?halaman=jawabanall">
          <i class="bi bi-journal-text"></i><span>Jawaban All</span></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?halaman=datauser">
          <i class="bi bi-journal-text"></i><span>Data User</span></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?halaman=hadiahall">
          <i class="bi bi-journal-text"></i><span>Hadiah All</span></i>
        </a>
      </li>



      <!-- End  -->



      <li class="nav-heading">Pencairan dan Undian</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?halaman=penarikan">
          <i class="bi bi-cash"></i>
          <span>Penarikan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php?halaman=undian">
          <i class="bi bi-list"></i>
          <span>Undian</span>
        </a>
      </li>


      <!-- End Profile Page Nav -->




      <li class="nav-item">
        <a class="nav-link collapsed" href="registrasi.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="logout.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->
      <!-- End Blank Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">


        <?php include 'list.php' ?>

      </div>

    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php if (isset($_GET['halaman'])) { ?>
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

  <?php } ?>

</body>

</html>