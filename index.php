<?php 
include "tambahan/header.php"
 ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php
include "tambahan/menubar.php"
?>

        <!-- page content -->
        <div class="right_col" role="main">
       <!-- isi konten -->
           <?php
         include 'koneksi.php';
   $pages_dir = 'halaman/';
    if(!empty($_GET['link'])){
     $pages = scandir($pages_dir, 0);
      unset($pages[0], $pages[1]);
      
      $p = $_GET['link'];
      if(in_array($p.'.php', $pages)){
        include($pages_dir.$p.'.php');
      } else {
        echo 'Halaman tidak ditemukan!';
      }
    } else {
      include($pages_dir.'pencariandokumen.php');
    }
    ?>  
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            STBI Perundang-undangan 2017 - <a href="https://fti.unisbank.ac.id">FTI UNISBANK</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php 
include "tambahan/footer.php";
 ?>
  </body>
</html>