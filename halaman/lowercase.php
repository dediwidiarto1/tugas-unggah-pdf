<?php 
$resBerita = mysqli_query($koneksi,"SELECT * FROM tb_dokumen ORDER BY Id");
while($row = mysqli_fetch_array($resBerita)) {                
                     $lines[] = $row['Isi']; 
  }    
echo "<h2>Dokumen Lower Case</h2><hr>";
$no=1;
foreach ((array)$lines as $line_num => $line){
	$line = preg_replace("/[^a-zA-Z]+/"," ",$line); //menghapus semua punctuation mark
	$line = strtolower($line);
	print "<font color=blue>Dokumen {$no}</font> : <p align=justify>" . $line . "</p><hr>\n"; 
$no++;
}
?>