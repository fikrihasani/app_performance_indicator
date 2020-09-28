<?php 
	include_once('koneksi.php'); 

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
     
	$id = 0;
	$id_area = $_POST['id_area'];
	$id_subarea = $_POST['id_subarea'];
	$complain =$_POST['complain'];
	$stakeholder =$_POST['stakeholder'];
	$status =$_POST['status']; //if($status=="Selesai"){ $status="Selesai";} else { $status="Belum Selesai";}
	$file =$_POST['file'];
	$time =$_POST['time'];
	
	//History SYSTEM
	$id2 = 0;
	$nama_user = $_POST['user'];
	$nama_menu = 'Komplain';
	$aksi = 'Input Komplain Mobile App';
	
	
	$data = "SELECT * FROM complains";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id'];
	} $id=$id+1;
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1; $image = "Komplain_".$id.".jpg"; $Path = "../assets/upload/complain/$image";
	
	
	$insert = "INSERT INTO complains(id,id_area,id_subarea,complain,stakeholder,status,image,time) VALUES ('$id','$id_area','$id_subarea','$complain','$stakeholder','$status','$image','$time')";
	$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id2','$nama_user','$time','$nama_menu','$aksi')";


	$exeinsert = mysqli_query($con,$insert);
	$exehistory = mysqli_query($con,$history);
	$response = array();

	if($exeinsert&&$exehistory)
	{	
		file_put_contents($Path,base64_decode($file));
		echo "Send Success";
		///$response['message'] = "Success ! Data di tambahkan";
	}
	else
	{
		//echo "Send Error: " . $exeinsert. " - " . $history . "<br>" . mysqli_error($con);
		echo "EROR";
		$response['message'] = "Failed ! Data Gagal di tambahkan";
	}
}else{
	echo "Please Try Again";
	$response['message'] = "Failed ! Data Gagal di tambahkan";

}
		
 ?>