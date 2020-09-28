<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	
	if(isset($_GET['admin'])){	
		$admin = $_GET['admin'];
    	
    	$manpower = array();
    	
    	$array_manpower = array();
    	$manpowers = "SELECT * FROM manpower ORDER by nama";
    		$h_manpowers = mysqli_query($con,$manpowers);
			while($man = mysqli_fetch_array($h_manpowers)){
        			//array_push($array_manpower,$man['nama']);
        			//"nama" => $man['nama'],
        			array_push($manpower,array(
            			"id"=>$man["id_manpower"],
            			"nama" => $man['nama'],
            	    ));
			}
        	
        	echo json_encode(array('manpower'=>$manpower));
    
	}else{
	    echo "WHAT ARE U DOING???";
	}
    	
?>