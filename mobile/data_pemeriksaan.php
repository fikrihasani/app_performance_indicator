<?php
    
	//Import File Koneksi Database
	require_once('koneksi.php');
	
	$admin = $_GET['admin'];
	
	$result = array();
	
    if(isset($_GET['admin'])){
        $pemeriksaan = "SELECT * FROM pemeriksaan where (penjelasan = 'tidak aman' and create_by = '$admin')";
    }else{
        $pemeriksaan = "SELECT * FROM pemeriksaan where (penjelasan = 'tidak aman')";
    }
	$h_pemeriksaan = mysqli_query($con,$pemeriksaan);	
	while($per = mysqli_fetch_array($h_pemeriksaan)){
	//===========================================================
	    $id = $per["id_periksa"];
	    $tanggal = $per["create_date"];
	    $penjelasan = $per["penjelasan"];
	    $tindak_lanjut = $per["tindak_lanjut"];
	    $hasil_tindakan = $per["hasil_tindakan"];
	    $id_user = $per["create_by"];
	    $gambar = $per["gambar"];
		$materials = "SELECT * FROM materials";
		$h_material = mysqli_query($con,$materials);
		while($mat = mysqli_fetch_array($h_material)){
			if($mat['id']==$per['id_material']){
			    //$id_material = $mat['id'];
			    $id_material = $mat['id'];
				$nama_material = $mat['standart'];
				$pertanyaan = $mat['standart_pertanyaan'];
				//===========================================================
					$sub_areas = "SELECT * FROM subarea";
					$h_sub_areas = mysqli_query($con,$sub_areas);
						while($sub = mysqli_fetch_array($h_sub_areas)){
							if($sub['id']==$per['id_sub']){
								$id_subarea = $sub['id'];
								$nama_subarea = $sub['nama']; //Memanggil nama sub area
								$tag = $sub['tag']; //Memanggil tagid
								//===========================================================
									$areas = "SELECT * FROM area";
									$h_areas = mysqli_query($con,$areas);
										while($area = mysqli_fetch_array($h_areas)){
											if($area['id']==$sub['id_area']){
												$id_area = $sub['id_area'];
												$nama_area = $area['nama'];
											}
										}
								//===========================================================
							}
						}
				//================================================================
	        }
		}
	//================================================================
	
	
        array_push($result,array(
    	"id"=>$id,
    	"area" => $nama_area,
    	//"id_subarea"=>$id_subarea,
    	"subarea" => $nama_subarea,
    	"tanggal"=>$tanggal,
    	"material"=>$nama_material,
    	"pertanyaan"=>$pertanyaan,
    	"gambar"=>$gambar,
    	"penjelasan"=>$penjelasan,
    	"tindak_lanjut"=>$tindak_lanjut,
    	"hasil_tindakan"=>$hasil_tindakan,
    	));
		
    		
	}
	//Menampilkan Array dalam Format JSON
	echo json_encode(array('data'=>$result));

	mysqli_close($con);
?>

