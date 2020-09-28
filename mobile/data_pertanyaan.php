<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	//$tag = "MAINTENANCE";
	//Membuat SQL Query
	$pertanyaan = "SELECT * FROM pertanyaan";
	//Mendapatkan Hasil
	$h_pertanyaan = mysqli_query($con,$pertanyaan);	
	$result = array();
	while($per = mysqli_fetch_array($h_pertanyaan)){
		
		//================================================================
		$areas = "SELECT * FROM area";
		$h_areas = mysqli_query($con,$areas);
			while($area = mysqli_fetch_array($h_areas)){
				if($area["id"]==$per["id_area"]){
					$id_area = $area["id"];
					$nama_area = $area["nama"];
				}
			}
		//================================================================
		$sub_areas = "SELECT * FROM subarea";
		$h_sub_areas = mysqli_query($con,$sub_areas);
			while($sub = mysqli_fetch_array($h_sub_areas)){
				if($sub["id"]==$per["id_subarea"]){
					$id_subarea = $sub["id"];
					$nama_subarea = $sub["nama"]; //Memanggil nama sub area
					$tag = $sub["tag"]; //Memanggil tagid
				}
			}
		//================================================================
		/*$materials = "SELECT * FROM materials";
		$h_material = mysqli_query($con,$materials);
    		while($mat = mysqli_fetch_array($h_material)){
    			if($mat["id"]==$per["id_material"]){
    			    $id_mat = $per["id_material"];
    			    $nama_material = $mat["standart"];
    				$pertanyaannya = $mat["standart_pertanyaan"];
    			}
    		} */
    		
    		
    	$id_material = $per["id_material"];
    	$materials = "SELECT * FROM materials where id = ".$id_material;
		$h_material = mysqli_query($con,$materials);
    		while($mat = mysqli_fetch_array($h_material)){
    			    //$id_mat = $per["id_material"];
    			    $nama_material = $mat["standart"];
    				$pertanyaannya = $mat["standart_pertanyaan"];
    		} 
    		
    		
		//================================================================
		
		if($h_areas&&$h_sub_areas&&$h_material){
		    array_push($result,array(
			"id_area"=>$id_area,
			"area" => $nama_area,
			"id_subarea"=>$id_subarea,
			"subarea" => $nama_subarea,
			"tag"=>$tag,
			"id_material"=>$id_material,
			"material"=>$nama_material,
			"pertanyaan"=>$pertanyaannya,
		    ));
		}
		
		
	}
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('materials'=>$result));

	mysqli_close($con);
?>
