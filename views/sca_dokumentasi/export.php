<h2>Data Sca Dokumentasi</h2>
<h4>Tanggal <?= $tgl1; ?> sampai <?= $tgl2; ?></h4>
<table border="1" cellpadding="8">
<tr>
  <th>No</th>
  <th>Shift</th>
  <th>Area</th>
  <th>Subarea</th>
  <th>Nilai</th>
  <th>Penanggung Jawab</th>
</tr>
<?php
if( ! empty($sca_dokumentasi)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
    $no = 1;
  foreach($sca_dokumentasi as $data){ // Lakukan looping pada variabel siswa dari controller
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$data['shift']."</td>";
    echo "<td>".$data['area']."</td>";
    echo "<td>".$data['subarea']."</td>";
    echo "<td>".$data['nilai']."</td>";
    echo "<td>".$data['user']."</td>";
    echo "</tr>";
  }
}else{ // Jika data tidak ada
  echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>