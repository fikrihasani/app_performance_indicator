<h2>Data Absensi</h2>
<h4>Tanggal <?= $tgl1; ?> sampai <?= $tgl2; ?></h4>
<table border="1" cellpadding="8">
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Jenis</th>
  <th>Keterangan</th>
  <th>Tanggal</th>
</tr>
<?php
if( ! empty($absensi)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
    $no = 1;
  foreach($absensi as $data){ // Lakukan looping pada variabel siswa dari controller
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$data['pegawai']."</td>";
    echo "<td>".$data['jenis']."</td>";
    echo "<td>".$data['keterangan']."</td>";
    echo "<td>".$data['tanggal']."</td>";
    echo "</tr>";
  }
}else{ // Jika data tidak ada
  echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>