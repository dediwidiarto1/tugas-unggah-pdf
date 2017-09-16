 <?php
// Baca lokasi file sementar dan nama file dari form (fupload)
include('class.pdf2text.php');
function preproses($isi,$nama_file) {
  
    //bersihkan tanda baca, ganti dengan underscore 
$nama_file = str_replace(" ", "_", $nama_file);

$konek = mysqli_connect("localhost","root","","stbi_uu");

 $query = "INSERT INTO tb_dokumen (Id, Judul, Isi, URL)
            VALUES('','$_POST[Judul]', '$isi', '$nama_file')"; 
  mysqli_query($konek, $query);	   

  if($query){
    echo "<script>window.alert('Data Tersimpan !');
                    window.location=('../index.php?link=datadokumen')</script>";
  }else{
    echo "<script>window.alert('Gagal Menyimpan Data !');
                    window.location=('../index.php?link=datadokumen')</script>";
  }
} //end function preproses



$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];
$nama_file = str_replace(" ", "_", $nama_file);
// Tentukan folder untuk menyimpan file
$folder = "files/$nama_file";
// tanggal sekarang
$tgl_upload = date("Ymd");
// Apabila file berhasil di upload
if (move_uploaded_file($lokasi_file,"$folder")){
  echo "Nama File : <b>$nama_file</b> sukses di upload<br>";
   
  $nama_filepdf = new PDF2Text();
 // $nama_file="./folder/"."uupangan2.pdf";
 $nama_file="files/".$nama_file;
    echo "Lokasi :".$nama_file;
 // $a->setFilename('./folder/uupangan.pdf');
  $nama_filepdf->setFilename($nama_file);
  echo "<br>";
  
$nama_filepdf->decodePDF();
//echo $nama_filepdf->output(); 
 preproses($nama_filepdf->output(),$nama_file);
  
}
else{
  echo "File gagal di upload";
}
?>