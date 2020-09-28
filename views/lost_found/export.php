<h2>Data Lost & Found</h2>
<h4>Tanggal <?= $tgl1; ?> sampai <?= $tgl2; ?></h4>
<table border="1" cellpadding="8">
<tr>
  <th>No</th>
  <th>Tanggal</th>
  <th>Penemu / Pelapor</th>
  <th>Deskripsi</th>
  <th>Jenis Laporan</th>
  <th>Status</th>
  <th>Tanggal Selesai</th>
</tr>
<?php
if( ! empty($lost_found)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
    $no = 1;
  foreach($lost_found as $data){ // Lakukan looping pada variabel siswa dari controller
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$data['tanggal1']."</td>";
    echo "<td>".$data['penemu']."</td>";
    echo "<td>".$data['deskripsi']."</td>";
    echo "<td>".$data['jenis_laporan']."</td>";
    echo "<td>".$data['status']."</td>";
    echo "<td>".$data['tanggal2']."</td>";
    echo "</tr>";
  }
}else{ // Jika data tidak ada
  echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>