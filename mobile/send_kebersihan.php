<?php 
	include_once('koneksi.php'); 

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = 0;
	$time = $_POST['time'];
	$shift = $_POST['shift'];
	$area = $_POST['area'];
	$sub_area = $_POST['sub_area'];
	$nilai = $_POST['nilai'];
	$user = $_POST['user'];
	$result = $_POST['result'];
	$file = $_POST['file'];

	
	//History SYSTEM
	$id2 = 0;
	$nama_user = $_POST['user'];
	$nama_menu = 'SCA Dokumentasi';
	$aksi = 'Input SCA Dokumentasi Mobile App';
	
	
	$data = "SELECT * FROM sca_dokumentasi";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id'];
	} $id=$id+1; $image = $nama_menu."_".$id.".jpg"; $Path = "../assets/upload/sca/$image"; 
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1; 
	
	$data3 = "SELECT * FROM sca_result";
	$d_data3 = mysqli_query($con,$data3);	
	while($kode3 = mysqli_fetch_array($d_data3)){
		$id3=$kode3['id'];
	} $id3=$id3+1; 
	
	
	
	$insert = "INSERT INTO sca_dokumentasi(id,time,shift,area,sub_area,nilai,user,image) VALUES ('$id','$time','$shift','$area','$sub_area','$nilai','$user','$image')";
	$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id2','$nama_user','$time','$nama_menu','$aksi')";
	$insert_result = "INSERT INTO sca_result(id,id_sca,result) VALUES ('$id3','$id','$result')";

	$exeinsert = mysqli_query($con,$insert);
	$exehistory = mysqli_query($con,$history);
	$exeresult = mysqli_query($con,$insert_result);
	
	if($exeinsert&&$exehistory&&$exeresult)
	{	
		file_put_contents($Path,base64_decode($file));
		echo "Send Success";
		///$response['message'] = "Success ! Data di tambahkan";
	}
	else
	{
		echo "Send Error: " . $history . "<br>" . mysqli_error($con);
		///$response['message'] = "Failed ! Data Gagal di tambahkan";
	}
	
}else{
	echo "Please Try Again";
 }
		
 ?>