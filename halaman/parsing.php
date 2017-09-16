    <div class="">
  <div class="clearfix"></div>
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><h2 style="color: green">Tokenisasi</h2></a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse">
            <div class="panel-body">Proses tokenisasi disebut juga sebagai parsing yaitu pengambilan kata-kata (term) dari kumpulan kalimat, paragraf , atau dokumen menjadi kumpulan term dengan cara menghapus karakter tanda baca yang terdapat pada dokumen dan mengubah kumpulan term menjadi lowercase. </div>
          </div>
        </div>
      </div>
        <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Hasil Tokenisasi</h2>
          <div class="clearfix"></div>
        </div>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Term</th>
              </tr>
            </thead>
            <tbody>
<?php 
$resBerita = mysqli_query($koneksi,"SELECT * FROM tb_dokumen ORDER BY Id");
$warna = "#DFE3FF";
while($row = mysqli_fetch_array($resBerita)) {                
                     $lines[] = $row['Isi']; 
  }                    
$no=1;
foreach ((array)$lines as $line_num => $line){
	$line = preg_replace("/[^a-zA-Z]+/"," ",$line); //menghapus semua punctuation mark
	$line = strtolower($line);

if ($start=1 && $line!="<text>") {
$kata = preg_split("/[\s]+/", $line);
	
foreach($kata as $token) {
  if($warna=="#DFE3FF"){$warna="#DFF0D8";}else{$warna="#DFE3FF";}
  print("<tr bgcolor='$warna'>");
print "<td><font color=blue>Line #{$no}</font> : " . $token . "</td>\n"; 

$no++;
 print("</tr>");
}
}
}

?>
</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>