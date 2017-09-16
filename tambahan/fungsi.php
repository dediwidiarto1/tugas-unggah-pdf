 <?php
//--------------------------------------------------------------------------------------------
//fungsi untuk membuat index
function buatindex() {
              //hapus index sebelumnya
   include 'koneksi.php';
              mysqli_query($koneksi,"TRUNCATE TABLE tb_proses");

              //ambil semua Isi (teks)      
              $resIsi = mysqli_query($koneksi,"SELECT * FROM tb_dokumen ORDER BY Id");
              $num_rows = mysqli_num_rows($resIsi);
              while($row = mysqli_fetch_array($resIsi)) {                
                     $docId = $row['Id']; 
                     $teks = $row['Isi']; 
                    
                    $teks = preg_replace("/[^a-zA-Z]+/"," ",$teks); //menghapus semua punctuation mark
                    
       //kembalikan teks yang telah dipreproses
       $teks = strtolower(trim($teks));
                    
                     //simpan ke inverted index (tb_proses)
                     $aIsi = explode(" ", trim($teks));
                    
                     foreach ($aIsi as $j => $value) {                         
                           //hanya jika Term tidak null atau nil, tidak kosong                        
                           if ($aIsi[$j] != "") {                      
                           
                                  //berapa baris hasil yang dikembalikan query tersebut?                           
                                  $rescount = mysqli_query($koneksi,"SELECT Count FROM tb_proses 
WHERE Term = '$aIsi[$j]' AND DocId = $docId");                  
                                  $num_rows = mysqli_num_rows($rescount);
                          
                                 
Count (+1);                 //jika sudah ada DocId dan Term tersebut , naikkan 
                                  if ($num_rows > 0) {                           
                                         $rowcount = mysqli_fetch_array($rescount);                                               
                                         $count = $rowcount['Count'];
                                         $count++;
                                                                    
                                         mysqli_query($koneksi,"UPDATE tb_proses SET Count = $count 
WHERE Term = '$aIsi[$j]' AND DocId = $docId");
                                  }
                                  //jika belum ada, langsung simpan ke tb_proses                 
                                  else {                    
                                         mysqli_query($koneksi,"INSERT INTO tb_proses (Term, DocId, 
Count) VALUES ('$aIsi[$j]', $docId, 1)");
                                  }
                           } //end if
                     } //end foreach                  
              } //end while
} //end function buatindex()
//--------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------
//fungsi untuk membuat index
function stoplist() {
              //hapus index sebelumnya
   include 'koneksi.php';
              mysqli_query($koneksi,"TRUNCATE TABLE tb_proses");

              //ambil semua Isi (teks)      
              $resIsi = mysqli_query($koneksi,"SELECT * FROM tb_dokumen ORDER BY Id");
              $num_rows = mysqli_num_rows($resIsi);
              while($row = mysqli_fetch_array($resIsi)) {                
                     $docId = $row['Id']; 
                     $teks = $row['Isi']; 
                    
                    //bersihkan tanda baca, ganti dengan space
       $teks = preg_replace("/[^a-zA-Z]+/"," ",$teks); //menghapus semua punctuation mark
                    
       //ubah ke huruf kecil                   
       $teks = strtolower(trim($teks));
   //terapkan stop word removal
      
         
     $teks = explode(" ",$teks);
 for($i=0;$i<count($teks);$i++){
 //$q[$i].'<p/>';// parsing
 $result = $koneksi->query("SELECT * FROM tb_stoplist WHERE stoplist = '$teks[$i]'");
 if($result->num_rows > 0 ){// stopword removal
 $y[$i] = '';
 }else{
 $y[$i] = $teks[$i];
 };
 }
 $teks = implode(" ",$y);

                  
       //kembalikan teks yang telah dipreproses
       $teks = strtolower(trim($teks));
                    
                     //simpan ke inverted index (tb_proses)
                     $aIsi = explode(" ", trim($teks));
                    
                     foreach ($aIsi as $j => $value) {                         
                           //hanya jika Term tidak null atau nil, tidak kosong                        
                           if ($aIsi[$j] != "") {                      
                           
                                  //berapa baris hasil yang dikembalikan query tersebut?                           
                                  $rescount = mysqli_query($koneksi,"SELECT Count FROM tb_proses 
WHERE Term = '$aIsi[$j]' AND DocId = $docId");                  
                                  $num_rows = mysqli_num_rows($rescount);
                          
                                 
Count (+1);                 //jika sudah ada DocId dan Term tersebut , naikkan 
                                  if ($num_rows > 0) {                           
                                         $rowcount = mysqli_fetch_array($rescount);                                               
                                         $count = $rowcount['Count'];
                                         $count++;
                                                                    
                                         mysqli_query($koneksi,"UPDATE tb_proses SET Count = $count 
WHERE Term = '$aIsi[$j]' AND DocId = $docId");
                                  }
                                  //jika belum ada, langsung simpan ke tb_proses                 
                                  else {                    
                                         mysqli_query($koneksi,"INSERT INTO tb_proses (Term, DocId, 
Count) VALUES ('$aIsi[$j]', $docId, 1)");
                                  }
                           } //end if
                     } //end foreach                  
              } //end while
} //end function buatindex()
//--------------------------------------------------------------------------------------------

?>