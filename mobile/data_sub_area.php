<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	//$tag = "MAINTENANCE";
	//Membuat SQL Query
	$barang = "SELECT * FROM subarea";
	//Mendapatkan Hasil
	$h_barang = mysqli_query($con,$barang);	
	//Membuat Array Kosong
	$result = array();
	while($kode = mysqli_fetch_array($h_barang)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		$areas = "SELECT * FROM area";
			$h_areas = mysqli_query($con,$areas);
				while($areaa = mysqli_fetch_array($h_areas)){
					if($areaa['id']==$kode['id_area']){
						//===========================================================
							$area = $areaa['nama'];
						//===========================================================
					}
				}
		array_push($result,array(
			"id"=>$kode['id'],
			"area"=>$area,
			"sub_area" =>$kode['nama'],
			"tag"=>$kode['tag'],
		));
	}
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('data'=>$result));

	mysqli_close($con);
?>
