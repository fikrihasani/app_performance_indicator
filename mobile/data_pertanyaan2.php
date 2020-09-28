<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	
	if(isset($_GET['admin'])){	
		$admin = $_GET['admin'];
	
	    $status=1;
	    
	    $pemeriksaan = "SELECT * FROM pemeriksaan WHERE (create_by = '$admin' AND penjelasan = 'tidak aman')";
    	$h_pemeriksaan = mysqli_query($con,$pemeriksaan);	
    	while($pem = mysqli_fetch_array($h_pemeriksaan)){
		    $status=1;
    	}
    	
    	
        $manpower = array();
    	$manpowers = "SELECT * FROM manpower ORDER by nama";
    		$h_manpowers = mysqli_query($con,$manpowers);
			while($man = mysqli_fetch_array($h_manpowers)){
        			array_push($manpower,array(
            			"id" => $man["id_manpower"],
            			"nama" => $man['nama'],
            	    ));
			}
			
    	
    	if($status==1){
        	
        	$array_id_material = array();
        	$array_nama_material = array();
        	$array_standart_material = array();
        	$result = array();
        	
        	$materials = "SELECT * FROM materials";
        	$h_material = mysqli_query($con,$materials);
        		while($mat = mysqli_fetch_array($h_material)){
        		    array_push($array_id_material,$mat["id"]);
        		    array_push($array_nama_material,$mat["standart"]);
        		    array_push($array_standart_material,$mat["standart_pertanyaan"]);
        		}
        	$p_material = count($array_id_material);
        
        	//Membuat SQL Query
        	$pertanyaan = "SELECT * FROM pertanyaan";
        	//Mendapatkan Hasil
        	$h_pertanyaan = mysqli_query($con,$pertanyaan);	
        	while($per = mysqli_fetch_array($h_pertanyaan)){
        		
        		//================================================================
        		$idarea = $per["id_area"];
        		$areas = "SELECT * FROM area where id = '$idarea'";
        		$h_areas = mysqli_query($con,$areas);
        			while($area = mysqli_fetch_array($h_areas)){
        				//if($area["id"]==$per["id_area"]){
        					$id_area = $area["id"];
        					$nama_area = $area["nama"];
        				//}
        			}
        		//================================================================
        		$idsubarea = $per["id_subarea"];

        		    $sub_areas = "SELECT * FROM subarea where (id = '$idsubarea')";
        	    
        		
        		$h_sub_areas = mysqli_query($con,$sub_areas);
        			while($sub = mysqli_fetch_array($h_sub_areas)){
        				//if($sub["id"]==$per["id_subarea"]){
        					$id_subarea = $sub["id"];
        					$nama_subarea = $sub["nama"]; //Memanggil nama sub area
        					$tag = $sub["tag"]; //Memanggil tagid
        				//}
        			}
        		//================================================================
        		$idmaterial = $per["id_material"];
            	$materials = "SELECT * FROM materials where id = '$idmaterial'";
        		$h_material = mysqli_query($con,$materials);
            		while($mat = mysqli_fetch_array($h_material)){
        			    $id_material = $mat["id"];
        			    $nama_material = $mat["standart"];
        				$pertanyaannya = $mat["standart_pertanyaan"];
            		} 
            		
            		
        		//================================================================
        		
        		if($h_areas&&$h_sub_areas&&$h_material){
        		    array_push($result,array(
        			"id_area"=>$id_area,
        			"area"=> $nama_area,
        			"id_subarea"=>$id_subarea,
        			"subarea"=> $nama_subarea,
        			"tag"=>$tag,
        			"id_material"=>$id_material,
        			"material"=>$nama_material,
        			"pertanyaan"=>$pertanyaannya,
        		    ));
        		}
        		
        		
        	}
        	
        	//================================================================
        	
        	//Menampilkan Array dalam Format JSON
        	echo json_encode(array('manpower'=>$manpower,'materials'=>$result,'status'=>''.$status.''));
    
    	}else{
        	echo json_encode(array('manpower'=>[],'materials'=>[],'status'=>''.$status.''));
    	}
    	
    	mysqli_close($con);
	
	}else{
	    echo "WHAT ARE U DOING!!!!!!";
	}
?>

