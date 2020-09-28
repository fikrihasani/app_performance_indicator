<?php 
	include_once('koneksi.php'); 

	//$pass = 'aufar2';
	$pass = $_POST['pass'];
	$cek = 0;
	
	//History SYSTEM
	$id = 0;
	$nama_user = $_POST['user'];
	$time = $_POST['time'];
	$nama_menu = 'Login';
	$aksi = 'Login Mobile App';
	
	
	$data = "SELECT * FROM user";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		if(password_verify($pass,$kode['password'])){
			$cek=1;
			//$cek=$kode['level']; // Checker = 3
			$data = "SELECT * FROM history_system";
			$d_data = mysqli_query($con,$data);	
			while($kode = mysqli_fetch_array($d_data)){
				$id=$kode['id'];
			} $id=$id+1;
			
			$insert = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id','$nama_user','$time','$nama_menu','$aksi')";
			$exeinsert = mysqli_query($con,$insert);
			break;
		}
	} 
	
	
	

	if($cek==1&&$exeinsert){	
		echo "Login Success";
	}else{
		///echo "Send Error: " . $pass . "<br>" . mysqli_error($con);
		echo "Password Wrong";
	}

		
 ?>