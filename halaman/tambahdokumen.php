<?php

function buatID(){
	include 'koneksi.php';
	$inisial="";
            $struktur = mysqli_query($koneksi,"SELECT * FROM tb_dokumen");
            $fieldinfo=mysqli_fetch_field_direct($struktur,0);
            $field = $fieldinfo->name;
            $panjang = $fieldinfo->length;
            $row = mysqli_num_rows($struktur);
         
            $panjanginisial = strlen(@$inisial);
            $awal = $panjanginisial + 1;
            $bnyk = $panjang-$panjanginisial;
         
            if ($row >= 1){
              $query = mysqli_query($koneksi,"select max(substring($field,$awal,$bnyk)) as max from tb_dokumen") or die("query tidak dapat dijalankan!");
              $hasil = mysqli_fetch_assoc($query);
              $angka = intval($hasil['max']);
            }
            else{
              $angka = 0;
            }
         
            $angka++;
            $tmp= "";
            for ($i=0; $i < ($panjang-$panjanginisial-strlen($angka)) ; $i++){
              $tmp = $tmp."";
            }
            //return hasil generate ID
            return strval(@$inisial.$tmp.$angka);
          }
          
      ?>
<br>
<form class="form-horizontal" enctype="multipart/form-data" role="form" name="form1" method="post" action="halaman/hasil_upload.php" align="left">
        <div class="form-group">
            <label class="control-label col-xs-2" for="Id" >Id:</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="Id" placeholder="Id Anda" value="<?php echo buatID(); ?>" readonly>
            </div>
        </div>
		 <div class="form-group" >
            <label class="control-label col-xs-2" for="Judul">Judul :</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="Judul" placeholder="Judul Anda" required>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2" for="URL">File:</label>
            <div class="col-xs-9">
                <input type=file name="fupload" required>
            </div>
        </div>
		        <br>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-9">
                <input type="submit" class="btn btn-primary btn-block" value="Simpan">
            </div>
        </div>
    </form>