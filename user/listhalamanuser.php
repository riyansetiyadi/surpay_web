<?php 


$hal = isset($_GET['halaman']) ? $_GET['halaman'] : '';


                   // usersurvey
                 if ($hal=="surveyaktif"){include 'usersurvey/surveyaktif.php';}
                   elseif ($hal=="item"){include 'usersurvey/item.php';}
                  

                   //pendapatan
                   elseif ($hal=="hadiah"){include 'hadiah/hadiah.php';}
                   elseif ($hal=="tarik"){include 'hadiah/tarik.php';}
                   elseif ($hal=="tarikdana"){include 'hadiah/tarikdana.php';}
                  
                  //utama
                  elseif ($hal=="utama"){include 'utama/utama.php';}
                  elseif ($hal=="profil"){include 'utama/profil.php';}
                  elseif ($hal=="contact"){include 'utama/contact.php';}


                   ELSE {
                   include 'halamanutama.php';};
                









 ?>