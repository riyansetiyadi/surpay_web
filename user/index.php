<?php session_start(); ?>

<?php
include '../admin/dist/function.php';
$username = $_SESSION['admin']['nohp'];
date_default_timezone_set('Asia/Jakarta');
if (!isset($_SESSION['login'])) {
    echo "<script> location='login.php'; </script> ";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SurvPay</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/styles2.css" rel="stylesheet" />

    <!-- bikin icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <style type="text/css">
        .navbarr {
            position: fixed;
            bottom: 0%;
            width: 100%;
            height: 55px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
            background-color: #ffffff;
            display: flex;
            overflow-x: auto;
        }

        .nav__link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            min-width: 50px;
            overflow: hidden;
            white-space: nowrap;
            font-family: sans-serif;
            font-size: 13px;
            color: #444444;
            text-decoration: none;
        }

        .nav__link:hover {
            background-color: #eeeeee;
        }

        .nav__link--active {
            color: #009579;
        }
    </style>
</head>

<body style="background-color: lightblue;">
    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
            <?php
            $nama = $username;
            $ambilh = $koneksi->query("SELECT sum(poin) as uang from hadiah where nama='$nama' order by idhadiah desc ");
            $pecahh = $ambilh->fetch_assoc();
            ?>
            <div style="background-color: white; height: 90px; width: 96%; margin-top: 3%; margin-left: 2%; border-radius: 30px"> <br>
                <span style="margin-left: 3%; font-size: 20px; text-align: start;"><b>Saldo Anda: </b><span style="font-size: 25px; font-weight: bold; color: red">Rp. <?php echo $pecahh['uang'] ?></span></span>
            </div>
            <!-- Page content-->
            <div class="container-fluid">
                <?php include 'listhalamanuser.php' ?>
            </div>

            <!-- bottom bar -->
            <nav class="navbarr">
                <a href="index.php?halaman=utama" class="nav__link">
                    <i class="material-icons nav__icon">dashboard</i>
                    <span class="nav__text">Dashboard</span>
                </a>

                <a href="index.php?halaman=surveyaktif" class="nav__link">
                    <i class="material-icons nav__icon">request_quote</i>
                    <span class="nav__text">Survey</span>
                </a>

                <a href="index.php?halaman=hadiah" class="nav__link">
                    <i class="material-icons nav__icon">paid</i>
                    <span class="nav__text">Poinku</span>
                </a>

                <a href="index.php?halaman=tarik" class="nav__link">
                    <i class="material-icons nav__icon">currency_exchange</i>
                    <span class="nav__text">Penarikan</span>
                </a>

                <a href="index.php?halaman=profil" class="nav__link">
                    <i class="material-icons nav__icon">person</i>
                    <span class="nav__text">Profil</span>
                </a>

                <a href="index.php?halaman=contact" class="nav__link">
                    <i class="material-icons nav__icon">contact_support</i>
                    <span class="nav__text">Kontak</span>
                </a>
            </nav>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>