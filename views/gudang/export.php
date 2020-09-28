<h2>Data Stok Barang</h2>
<h4>Tanggal <?= $tgl1; ?> sampai <?= $tgl2; ?></h4>
<table border="1" cellpadding="8">
<tr>
  <th>No</th>
  <th>Nama Barang</th>
  <th>Stok</th>
  <th>Pengambil</th>
  <th>Tanggal</th>
</tr>
<?php
if( ! empty($stok_gudang)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
    $no = 1;
  foreach($stok_gudang as $data){ // Lakukan looping pada variabel siswa dari controller
    echo "<tr>";
    echo "<td>".$no++."</td>";
    echo "<td>".$data['nama_barang']."</td>";
    echo "<td>".$data['stok']."</td>";
    echo "<td>".$data['pengambil']."</td>";
    echo "<td>".$data['time']."</td>";
    echo "</tr>";
  }
}else{ // Jika data tidak ada
  echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>