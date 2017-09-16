<div class="">
  <div class="clearfix"></div>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><h2 style="color: green">Stopword Removal</h2></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse">
        <div class="panel-body">Proses penghapusan atau pembuangan kata umum (common words) yang biasanya muncul dalam jumlah besar dan dianggap tidak memiliki makna dalam dokumen seperti: “yang”, “di”, “ke” dll.
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Hasil Stopword Removal</h2>
          <div class="clearfix"></div>
        </div>
        <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Term</th>
                <th>Doc-ID</th>
                <th>Freq</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query1 = "DELETE FROM tb_proses WHERE Term IN (SELECT stoplist FROM tb_stoplist)";
              $result = mysqli_query($koneksi,$query1);
              
              $query = "SELECT DocId,Term,count(Term) AS freq  FROM tb_proses where Term <> '' GROUP BY DocId,Term ORDER By DocId";
              $result = mysqli_query($koneksi,$query);
              $no=1;
              $numrows = mysqli_num_rows($result);
              $warna = "#DFE3FF";
              while($row = mysqli_fetch_array($result)){
              if($warna=="#DFE3FF"){$warna="#DFF0D8";}else{$warna="#DFE3FF";}
              print("<tr bgcolor='$warna'>");
                print("<td>" . $no++ . "</td><td>" . $row['Term'] . "</td><td>" . $row['DocId'] .
                "</td><td>" . $row['freq'] . "</td>");
              print("</tr>");
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>