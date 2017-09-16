<div class="">
  <div class="clearfix"></div>
           <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><h2 style="color: green">Pencarian Bobot</h2></a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse">
            <div class="panel-body">W = (TF * IDF)
 </div>
          </div>
        </div>
      </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Hasil Pencarian Bobot</h2>
          <div class="clearfix"></div>
        </div>
        <form class="form-inline" action="" method="post">Cari Bobot :
    <input type="text" class="form-control" size="50" name="input_cari" placeholder="Masukkan term . . ." required>
    <input type="submit" name="cari" value="Cari" class="btn btn-success" />
  </form>

   
              <?php
              //$key=
                  $input_cari = @$_POST['input_cari']; 
   $cari = @$_POST['cari'];
  // jika tombol cari di klik
   if($cari) {
    ?>
     <h4>Pencarian dengan term: <b>"<?php echo @$_POST['input_cari']; ?>"</b></h4>
  <hr>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Term</th>
                <th>Doc-ID</th>
                <th>TF</th>
                <th>DF</th>
                <th>N</th>
                <th>IDF</th>
                <th>W=TF * IDF</th>
              </tr>
            </thead>
            <tbody>
<?php
    // jika kotak pencarian tidak sama dengan kosong
    if($input_cari != "") {
      $keyword = $_POST["input_cari"]; // ambil keyword

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
   
      $result = mysqli_query($koneksi,"select b.Id as Id,b.Term,b.DocId AS DocId,b.TF AS TF,a.DF AS DF, a.N as N, log10(a.N/a.DF) AS IDF,b.TF *log10(a.N/a.DF) AS TFIDF from
  (select Id,Term,Count(Distinct Id) AS DF ,(SELECT Count(Distinct DocId)FROM tb_stemming) AS N from tb_stemming Group By Term) a
left join
  (select Id,Term,DocId, Count AS TF  from tb_stemming Group By Id) b
on b.Term = a.Term where $construct Order by TFIDF DESC");

    }
    else{
        $result = mysqli_query($koneksi,"select b.Id as Id,b.Term,b.DocId AS DocId,b.TF AS TF,a.DF AS DF, a.N as N, log10(a.N/a.DF) AS IDF,b.TF *log10(a.N/a.DF) AS TFIDF from
  (select Id,Term,Count(Distinct Id) AS DF ,(SELECT Count(Distinct DocId)FROM tb_stemming) AS N from tb_stemming Group By Term) a
left join
  (select Id,Term,DocId, Count AS TF  from tb_stemming Group By Id) b
on b.Term = a.Term");
      }
      $warna = "#DFE3FF";
$no=1;
      while($row = mysqli_fetch_array($result)) {
           if($warna=="#DFE3FF"){$warna="#DFF0D8";}else{$warna="#DFE3FF";}
            print("<tr bgcolor='$warna'>");
            print("<td>" . $no++ .
                      "</td><td>" . $row['Term'] .
                      "</td><td>" . $row['DocId'] .
                      "</td><td>" . $row['TF'] .
                      "</td><td>" . $row['DF'] .
                      "</td><td>" . $row['N'] .
                      "</td><td>" . $row['IDF'] .
                      "</td><td>" . $row['TFIDF'] .
                      "</td>");
            print("</tr>");
      }          

              echo" </tbody>
          </table>
        </div>";
      }

      // jika tombol cari tidak di klik
    else{
      echo "<br><center><font color=red>Pencarian Masih kosong !</font></center>";
    }

              ?>

      </div>
    </div>
  </div>
</div>