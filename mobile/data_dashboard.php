<?php
    
	//Import File Koneksi Database
	require_once('koneksi.php');
	
	$admin = $_GET['admin'];
	
	$tanggalnya = "null"; 
	$lokasinya = "null"; 
	$lokasinya_sub = "null"; 
	
	$material = array(); $mat_prob=""; $c_mat=0;
	
	$nilai=0;   $count=0;
	$c_p=0;   $c_s=0;   $c_m=0;
	$problem = "0"; $t_lanjut = "0";
	
    $sekarang = "%".date('Y-m-d')."%"; 
    //$sekarang = "%2020-06-09%"; 
    

	$lokasi = array();
	$dashboard = array();
	
	$pemeriksaan = "SELECT * FROM pemeriksaan WHERE (create_date LIKE '$sekarang') ORDER BY id_area, id_periksa, id_material, hasil";
	//$pemeriksaan = "SELECT * FROM pemeriksaan WHERE (create_date LIKE '$sekarang') ORDER BY  id_area, tanggal, id_material, hasil";
	
	
	$h_pemeriksaan = mysqli_query($con,$pemeriksaan);	
	while($per = mysqli_fetch_array($h_pemeriksaan)){
	    
        $id = $per["id_periksa"];
	    $id_area = $per["id_area"];
	    $id_sub = $per["id_sub"];
	    $id_mat = $per["id_material"];
	    $shift = $per["shift"];
	    $hasil = $per["hasil"];
	    $penjelasan = $per["penjelasan"];
	    $tanggal = $per["create_date"];
	    
	    
	    if($hasil=="0"){$problem++; $problem=number_format($problem);}
    	if(($hasil=="0")&&($penjelasan!="tidak aman")){$t_lanjut++; $t_lanjut=number_format($t_lanjut);}
    	
    	
    	if(($tanggalnya!=$tanggal)){ //JUMLAH SHIFT
	        if($shift=="1"){$c_p++; }
	        if($shift=="2"){$c_s++; }
	        if($shift=="3"){$c_m++; }
    	}$tanggalnya=$tanggal;
    	
    	
    	

	    if($lokasinya==$id_area){///SETIAP LOKASI dan MENGHITUNG SCORE
	        if($per['hasil']=="1"){ $nilai++; }
            $count++;
            $score = ($nilai*100)/$count;
            $score = number_format($score); // Kalo mau dikasih koma ($score , 2) == 100,00;
            
            if($hasil=="0"){
        	    ///$material = $material.$id_mat.",";
        	    array_push($material,$id_mat);
        	}
	        
	    }else{
	        if(($lokasinya!="null")){
                if($shift=="1"){$c_p--; }   if($shift=="2"){$c_s--; }   if($shift=="3"){$c_m--; }
	            //$c_p = number_format($c_p); $c_s = number_format($c_s); $c_m = number_format($c_m);
	            if(count($material)!=0){
            	    sort($material);
                	$mat_prob=""; $mat="null"; $m=0;
                	for($i=0;$i<count($material);$i++){
                	    if($mat=="null"){
                	        $mat=$material[$i]; $m++;
                	    }else if($mat==$material[$i]){
                	        $m++;
                	    }else{
                	        $materials = "SELECT * FROM materials where id = '$mat'"; $h_mats = mysqli_query($con,$materials);   while($matt = mysqli_fetch_array($h_mats)){   $mat = $matt['standart']; }
                	        $mat_prob=$mat_prob.$mat.":".$m.", ";
                	        $mat=$material[$i]; $m=1;
                	    }
                	}
                	$materials = "SELECT * FROM materials where id = '$mat'"; $h_mats = mysqli_query($con,$materials);   while($matt = mysqli_fetch_array($h_mats)){   $mat = $matt['standart']; }
                	$mat_prob=$mat_prob.$mat.":".$m.", ";
            	}
    	        $areas = "SELECT * FROM area where id = '$lokasinya'";    $h_areas = mysqli_query($con,$areas);   while($areaa = mysqli_fetch_array($h_areas)){   $lokasinyaa = $areaa['nama']; }
                $mat_prob = strtolower($mat_prob); $mat_prob = ucwords($mat_prob);
                array_push($lokasi,array("area"=>$lokasinyaa,"score"=>$score,"pagi"=>$c_p,"siang"=>$c_s,"malam"=>$c_m,"material"=>$mat_prob,));
	            
	            
	            $nilai=0;   $count=0;
                $material = array(); $mat_prob=""; $c_mat=0;
                if($shift=="1"){$c_p="1"; }else{$c_p="0"; }
                if($shift=="2"){$c_s="1"; }else{$c_s="0"; }
                if($shift=="3"){$c_m="1"; }else{$c_m="0"; }
	        }
	        
	        
	        if($per['hasil']=="1"){ $nilai = 1; }
	        $count = 1;
	        
    	    $lokasinya=$id_area;
    	    
    	    if($hasil=="0"){
        	    //$material = $material.$id_mat.",";
        	    array_push($material,$id_mat);
        	}
	    }
	    
	    
	    array_push($dashboard,array(
        	"id"=>$id,
        	"id_area" =>$id_area,
        	"id_sub"=>$id_sub,
        	"id_mat"=>$id_mat,
        	"shift"=>$shift,
        	"hasil"=>$hasil,
        	"tanggal"=>$tanggal,
        	"s"=>" ",
    	));
        	
    }
	
	//$c_mat++;   $materialnya=$id_mat;   $material=$material.$materialnya."=".$c_mat.",";
	if(count($material)!=0){
	    sort($material);
    	$mat_prob=""; $mat="null"; $m=0;
    	for($i=0;$i<count($material);$i++){
    	    if($mat=="null"){
    	        $mat=$material[$i]; $m++;
    	    }else if($mat==$material[$i]){
    	        $m++;
    	    }else{
    	        $materials = "SELECT * FROM materials where id = '$mat'"; $h_mats = mysqli_query($con,$materials);   while($matt = mysqli_fetch_array($h_mats)){   $mat = $matt['standart']; }
                $mat_prob=$mat_prob.$mat.":".$m.", ";
                $mat=$material[$i]; $m=1;
    	    }
    	}
    	$materials = "SELECT * FROM materials where id = '$mat'"; $h_mats = mysqli_query($con,$materials);   while($matt = mysqli_fetch_array($h_mats)){   $mat = $matt['standart']; }
        $mat_prob=$mat_prob.$mat.":".$m.", ";
	}
	
	if($lokasinya!="null"){
	    $areas = "SELECT * FROM area where id = '$lokasinya'";    $h_areas = mysqli_query($con,$areas);   while($areaa = mysqli_fetch_array($h_areas)){   $lokasinyaa = $areaa['nama']; }
        $mat_prob = strtolower($mat_prob); $mat_prob = ucwords($mat_prob);
        array_push($lokasi,array("area"=>$lokasinyaa,"score"=>$score,"pagi"=>$c_p,"siang"=>$c_s,"malam"=>$c_m,"material"=>$mat_prob,));
	}
	

    sort($lokasi);
	
    //Menampilkan Array dalam Format JSON
	echo json_encode(array('area'=>$lokasi,'problem'=>$problem,'t_lanjut'=>$t_lanjut,'dashboard'=>$dashboard));

	
	mysqli_close($con);
?>
