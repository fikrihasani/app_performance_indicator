<?php 
	include_once('koneksi.php'); 

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = 0;
	$tanggal1 = $_POST['tanggal1'];
	$jenis = $_POST['jenis'];
	$deskripsi = $_POST['deskripsi'];
	$penemu = $_POST['penemu'];
	$status = $_POST['status'];
	$tanggal2 = $_POST['tanggal2'];
	$file = $_POST['file'];
	//$image = $_POST['image'].".jpg";
	//$Path = "image/$image";
	
	//History SYSTEM
	$id2 = 0;
	$nama_user = $_POST['user'];
	$time = $_POST['tanggal1'];
	$nama_menu = 'Kehilangan';
	$aksi = 'Input Kehilangan Mobile App';
	
	
	$data = "SELECT * FROM lost_found";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id'];
	} $id=$id+1;
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1; $image = "Kehilangan_".$id.".jpg"; $Path = "../assets/upload/lost_found/$image";
	
	
	
	$insert = "INSERT INTO lost_found(id,tanggal1,jenis_laporan,deskripsi,penemu,status,tanggal2,image) VALUES ('$id','$tanggal1','$jenis','$deskripsi','$penemu','$status','$tanggal2','$image')";
	$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id2','$nama_user','$time','$nama_menu','$aksi')";


	$exeinsert = mysqli_query($con,$insert);
	$exehistory = mysqli_query($con,$history);
	
	if($exeinsert&&$exehistory)
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