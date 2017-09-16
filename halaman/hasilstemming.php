<div class="">
  <div class="clearfix"></div>
        <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><h2 style="color: green">Stemming</h2></a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse">
            <div class="panel-body">Proses untuk menemukan kata dasar dari sebuah kata. Dengan cara menghilangkan semua imbuhan (affixes) baik yang terdiri dari awalan (prefixes), sisipan (infixes), akhiran
(suffixes) dan confixes (kombinasi dari awalan dan akhiran) pada kata turunan.
 </div>
          </div>
        </div>
      </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Hasil Stemming</h2>
          <div class="clearfix"></div>
        </div>
        <?php
        include 'koneksi.php';  
include "tambahan/stemming.php";     
mysqli_query($koneksi,"TRUNCATE TABLE tb_stemming");
        ?>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Term</th>
                <th>Doc-ID</th>
                <th>TF</th>
              </tr>
            </thead>
            <tbody>
              <?php
                    $i=1; 
      $warna = "#DFE3FF";
 $result = mysqli_query($koneksi,"SELECT * FROM tb_proses ORDER BY Id");
      while($row = mysqli_fetch_array($result)) {                
             
          $a=$row['Term'];
          $docId=$row['DocId'];
          $freq=$row['Count'];
 $awal = microtime(true);
 


 foreach((array)$a as $kata){
   if($warna=="#DFE3FF"){$warna="#DFF0D8";}else{$warna="#DFE3FF";}  
 echo "<tr align='center' bgcolor='$warna' class='col'>
        <td>$i</td>
        <td>".hapusakhiran(hapusawalan2(hapusawalan1(hapuspp(hapuspartikel($kata)))))."</td>
        <td>$docId</td>
        <td>$freq</td>
      </tr>";
       //simpan ke inverted index (tbindex)
      $hsl_stem=hapusakhiran(hapusawalan2(hapusawalan1(hapuspp(hapuspartikel($kata)))));
                     $aberita = explode(" ", trim($hsl_stem));
                     foreach ($aberita as $j => $value) {                         
                           //hanya jika Term tidak null atau nil, tidak kosong                        
                           if ($aberita[$j] != "") {                      
                           
                                  //berapa baris hasil yang dikembalikan query tersebut?                           
                                  $rescount = mysqli_query($koneksi,"SELECT Count FROM tb_stemming 
WHERE Term = '$aberita[$j]' AND DocId = $docId");                  
                                  $num_rows = mysqli_num_rows($rescount);
                          
                                 
Count (+1);                 //jika sudah ada DocId dan Term tersebut , naikkan 
                                  if ($num_rows > 0) {                           
                                         $rowcount = mysqli_fetch_array($rescount);                                               
                                         $count = $rowcount['Count'];
                                         $count++;
                                                                    
                                         mysqli_query($koneksi,"UPDATE tb_stemming SET Count = $count 
WHERE Term = '$aberita[$j]' AND DocId = $docId");
                                  }
                                  //jika belum ada, langsung simpan ke tbindex                 
                                  else {                    
                                         mysqli_query($koneksi,"INSERT INTO tb_stemming (Term, DocId, 
Count) VALUES ('$aberita[$j]', $docId, $freq)");
                                  }
                           } //end if
                     } //end foreach 
                      }                     
$i++;
}
              ?>
            </tbody>
          </table>
        </div>
        <?php
        $akhir = microtime(true);
?>
      </div>
      <center><?php $lama = $akhir-$awal; echo "Lama Proses Stemming : $lama detik"; ?></center>
    </div>
  </div>
</div>