<?php 
	include_once('koneksi.php'); 

	//History SYSTEM
	$id = 0;
	$nama_user = $_POST['user'];
	$time = $_POST['time'];
	$nama_menu = 'Logout';
	$aksi = 'Logout Gudang Mobile App';
	
		$data = "SELECT * FROM history_system";
		$d_data = mysqli_query($con,$data);	
		while($kode = mysqli_fetch_array($d_data)){
			$id=$kode['id'];
		} $id=$id+1;
		
		$insert = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id','$nama_user','$time','$nama_menu','$aksi')";
		$exeinsert = mysqli_query($con,$insert);


	if($exeinsert){	
		echo "Logout Success";
	}else{
		///echo "Send Error: " . $pass . "<br>" . mysqli_error($con);
		echo "Logout Error";
	}

		
 ?>