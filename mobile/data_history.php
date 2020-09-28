<?php
	//Import File Koneksi Database
	require_once('koneksi.php');

	//Membuat Array Kosong
	$result = array();

    if(isset($_GET['admin'])){	
		$nama = $_GET['admin'];
		//Membuat SQL Query
    	$sql = "SELECT * FROM history_system where nama_user = '$nama' ORDER by id DESC";
    	$r = mysqli_query($con,$sql);
    	
    	while($row = mysqli_fetch_array($r)){
    		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
    		array_push($result,array(
    			"nama"=>$row['nama_user'],
    			"time"=>$row['time'],
    			"menu"=>$row['nama_menu'],
    			"aksi"=>$row['aksi'],
    		));
    	}
		
	}else{
	    //Membuat SQL Query
    	$sql = "SELECT * FROM history_system ORDER by id DESC";
    	$r = mysqli_query($con,$sql);
    	
    	while($row = mysqli_fetch_array($r)){
    		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
    		array_push($result,array(
    			"nama"=>$row['nama_user'],
    			"time"=>$row['time'],
    			"menu"=>$row['nama_menu'],
    			"aksi"=>$row['aksi'],
    		));
    	}
	}
	
	echo json_encode(array('history'=>$result));
	
	mysqli_close($con);
?>
