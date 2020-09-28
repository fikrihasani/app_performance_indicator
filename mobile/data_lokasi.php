<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	//$tag = "MAINTENANCE";
	//Membuat SQL Query
	
	//Membuat Array Kosong
	$a_area = array();
	$a_subarea = array();
	$result = array();
	
	///Menampilkan Area
	$areas = "SELECT * FROM area";
	$h_areas = mysqli_query($con,$areas);
	while($areaa = mysqli_fetch_array($h_areas)){
		array_push($a_area,array("area"=>$areaa['nama']));
	} sort($a_area);
	
	
	$barang = "SELECT * FROM subarea";
	$h_barang = mysqli_query($con,$barang);	
	while($kode = mysqli_fetch_array($h_barang)){
		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
			$areas = "SELECT * FROM area";
			$h_areas = mysqli_query($con,$areas);
			while($areaa = mysqli_fetch_array($h_areas)){
				if($areaa['id']==$kode['id_area']){
					//===========================================================
						$area = $areaa['nama'];
						$id = $areaa['id'];
					//===========================================================
				}
			}
		array_push($a_subarea,array("subarea"=>$kode['nama']));

		array_push($result,array(
			"id_area"=>$id,
			"area"=>$area,
			"id_subarea"=>$kode['id'],
			"sub_area" =>$kode['nama'],
		));
	}sort($a_subarea);
	
	
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('areas'=>$a_area,'subareas'=>$a_subarea,'results'=>$result));

	mysqli_close($con);
?>
