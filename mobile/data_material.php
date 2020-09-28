<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	//Membuat SQL Query
	$materials = "SELECT * FROM materials";
	//Mendapatkan Hasil
	$h_materials = mysqli_query($con,$materials);	
	//Membuat Array Kosong
	$result = array();
	while($mat = mysqli_fetch_array($h_materials)){
		
		array_push($result,array(
			"id" => $mat["id"],
			"nama"=>$mat["standart"],
			//"standart"=>$mat['standart_pertanyaan'],
			
		));
	}
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('materials'=>$result));

	mysqli_close($con);
?>
