<?php 
	include_once('koneksi.php'); 

	$id=0;
	$id_area =$_POST['id_area'];
	$id_subarea=$_POST['id_subarea'];
	$kerusakan=$_POST['kerusakan'];
	$follow_up=$_POST['follow_up'];
	$status=$_POST['status']; //if($status=="Selesai"){ $status="1";} else { $status="0";}
	$file=$_POST['file'];
	$time=$_POST['time'];
	
	//History SYSTEM
	$id2 = 0;
	$nama_user = $_POST['user'];
	$nama_menu = 'Kerusakan';
	$aksi = 'Input Kerusakan Mobile App';
	
	
	$data = "SELECT * FROM kerusakan";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id'];
	} $id=$id+1;
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1; $image = "Kerusakan_".$id.".jpg"; $Path = "../assets/upload/kerusakan/$image";
	
	
	$insert = "INSERT INTO kerusakan(id,id_area,id_subarea,kerusakan,follow_up,status,image,time) VALUES ('$id','$id_area','$id_subarea','$kerusakan','$follow_up','$status','$image','$time')";
	$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id2','$nama_user','$time','$nama_menu','$aksi')";

	
	$exeinsert = mysqli_query($con,$insert);
	$exehistory = mysqli_query($con,$history);

	if($exeinsert&&$exehistory)
	{	
		file_put_contents($Path,base64_decode($file));
		echo "Send Success";
	}
	else
	{
		echo "Send Error: " . $insert . "<br>" . mysqli_error($con);
	}

		
 ?>