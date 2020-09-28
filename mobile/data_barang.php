<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	//$tag = "MAINTENANCE";
	//Membuat SQL Query
	$barang = "SELECT * FROM stok_gudang";
	//Mendapatkan Hasil
	$h_barang = mysqli_query($con,$barang);	
	//Membuat Array Kosong
	$result = array();
	while($kode = mysqli_fetch_array($h_barang)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
			"id"=>$kode['id'],
			"barang" =>$kode['nama_barang'],
			"stok"=>$kode['stok'],
		));
	}
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('data'=>$result));

	mysqli_close($con);
?>
