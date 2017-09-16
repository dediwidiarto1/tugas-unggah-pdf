<?php
include 'koneksi.php';
mysqli_query($koneksi,"TRUNCATE TABLE tb_proses");
mysqli_query($koneksi,"TRUNCATE TABLE tb_dokumen");
mysqli_query($koneksi,"TRUNCATE TABLE tb_stemming");
$files = glob('halaman/files/*.pdf'); //get all file names
foreach($files as $file){
    if(is_file($file))
    unlink($file); //delete file
}

if($files){
	echo "<script>window.alert('Berhasil Reset Data !');
                    window.location=('index.php?link=datadokumen')</script>";
}else{
	echo "<script>window.alert('Reset Data Gagal Data Kosong !');
                    window.location=('index.php?link=datadokumen')</script>";
}
?>