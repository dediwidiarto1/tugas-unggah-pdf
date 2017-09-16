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
<br><!-- Container (The Isi Section) -->

<?php
echo "<p align=center></p";
// konek ke database
include "koneksi.php";
@$keyword = $_GET["keyword"]; // ambil keyword

   $search_exploded = explode(" ",$keyword); // hilangkan keyword dari spasi

   // 
   $x=0;
   $construct="";   
   foreach($search_exploded as $search_each)
   {
   // membuat query utk pencarian
   $x++;
    if ($x==1){
     $construct .= " a.Term LIKE '%$search_each%'";
   //echo "$construct";
   //echo '<br/>';
   }
    else
     {
   $construct .= " OR a.Term LIKE '%$search_each%'"; // query jika kata lebih dari 1
   //echo "$construct";
   }
   
   }
   
  // tampilkan kotak pencarian dan jumlah hasil pencarian

    echo "<br /><br>
    <form action='hasil_pencarian.php' method='GET'>
         <div class='form-group'>
                        <div class='col-sm-9'>
                          <div class='input-group'>
                            <input class='form-control' type='text' name='keyword' value='$keyword' placeholder='masukkan keyword . . .''>
                            <span class='input-group-btn'>
                                              <input class='btn btn-primary' type='submit' value='Cari'>
                                          </span>
                          </div>
                        </div>
                      </div>
    </form>";
// select distinct utk mengambil Isi agar tdk duplikasi
   $sql2=mysqli_query($koneksi,"select b.Id as Id,b.Term,b.Id as Id,b.DocId AS DocId,b.TF AS TF,b.TF *log10(a.N/a.DF) AS Weight from
  (select Id,Term,Count(Distinct Id) AS DF ,(SELECT Count(Distinct DocId)FROM tb_stemming) AS N from tb_stemming Group By Term) a
left join
  (select Id,Term,DocId, Count AS TF  from tb_stemming Group By Id) b
on b.Term = a.Term where $construct");
// memeriksa apakah ada hasil pencarian, jika = 0 maka tampilkan kata "tdk ada"
    $foundnum = mysqli_num_rows($sql2);
  if ($foundnum==0)
   echo "Tidak ada hasil pencarian dari kata <b>$keyword</b>";
  else
  {
   echo "<table bgcolor='#e9e9e9' width='100%' height='1px'></table><table bgcolor='#e9e9e9' width='100%' height='10px'><tr><td><div align='right'>Terdapat <b>$foundnum</b> hasil pencarian dari kata <b>$keyword</b></div></td></tr></table><br>";
   
}
// tampilkan hasil pencarian ( judul, Isi, dan URL)
  while ($data2 = mysqli_fetch_assoc($sql2)){
$id_Isi = $data2['DocId'];
$bobot = $data2['Weight'];
$sql=mysqli_query($koneksi,"select distinct Id, Judul, Isi, URL from tb_dokumen where Id = '$id_Isi'");
$data=mysqli_fetch_array($sql);
 @$Isi=substr($data[Isi],0,200);
   echo "
   <a href=halaman/$data[URL]><b><font color='blue'>$data[Judul]</font></b> </a> --> <b>(Kata '$keyword' muncul sebanyak $data2[TF] kali, bobotnya = $data2[Weight]) </b><br />
   $Isi ...<br>
   <font color='00CC00'>halaman/$data[URL]</font><hr>
</h4>
   ";
}
  echo "</table>";

?>
  <br>
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