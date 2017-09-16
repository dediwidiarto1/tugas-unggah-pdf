<?php
include("../koneksi.php");
$Id = $_POST['Id'];
$Judul = $_POST['Judul'];
$Berita = $_POST['Berita'];
$URL = $_POST['URL'];
$query = mysqli_query($koneksi,"insert into tbberita values  ('$Id','$Judul','$Berita','$URL')");
echo "Data Telah disimpan<br>
<a href=\"../index.php?link=datadokumen\">Kembali</a>";
?>