<?php 

// $hal=$_GET['halaman'];
$hal = isset($_GET['halaman']) ? $_GET['halaman'] : '';

// $level=$_SESSION['admin']['level'];

// $username=$_SESSION['admin']['username'];



                   // survey
                   if ($hal=="surveyall"){include 'survey/surveyall.php';}
                   elseif ($hal=="tambahsurvey"){include 'survey/tambahsurvey.php';}
                   elseif ($hal=="ubahsurvey"){include 'survey/ubahsurvey.php';}
                   elseif ($hal=="hapussurvey"){include 'survey/hapussurvey.php';}
                   elseif ($hal=="entritanya"){include 'survey/entritanya.php';}
                   elseif ($hal=="tanyaall"){include 'survey/tanyaall.php';}

                   //rekap
                   elseif ($hal=="rekapjawaban"){include 'rekap/rekapjawaban.php';}
                   
                   //data
                  elseif ($hal=="jawabanall"){include 'data/jawabanall.php';} 
                  elseif ($hal=="datauser"){include 'data/datauser.php';} 
                  elseif ($hal=="hadiahall"){include 'data/hadiahall.php';} 
                  elseif ($hal=="dataundian"){include 'data/dataundian.php';} 
                  

                  //pencairan
                  elseif ($hal=="penarikan"){include 'pencairan/penarikan.php';} 
                  elseif ($hal=="undian"){include 'pencairan/undian.php';} 
                  elseif ($hal=="undianpemenang"){include 'pencairan/undianpemenang.php';} 
                  elseif ($hal=="buktitransfer"){include 'pencairan/buktitransfer.php';} 
                  

                   

                   ELSE {
                   include '../dist/halamanutama.php';};
                
// if(!isset($_GET['halaman'])){
//     include '../dist/halamanutama.php';
// }
              














 ?>