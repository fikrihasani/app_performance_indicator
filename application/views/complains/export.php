<h4>Data Complain</h4>
<h4>Tanggal <?= $tgl1; ?> sampai <?= $tgl2; ?></h4>
<table border="1" cellpadding="8">
<tr>
  <th>No</th>
  <th>Area</th>
  <th>Subarea</th>
  <th>Complain</th>
  <th>Stakeholder</th>
  <th>Status</th>
</tr>
<?php
if( ! empty($complain)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
    $no = 1;
  foreach($complain as $data){ // Lakukan looping pada variabel siswa dari controller
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$data['nama_area']."</td>";
    echo "<td>".$data['nama_subarea']."</td>";
    echo "<td>".$data['complain']."</td>";
    echo "<td>".$data['stakeholder']."</td>";
    echo "<td>".$data['status']."</td>";
    echo "</tr>";
  }
}else{ // Jika data tidak ada
  echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>