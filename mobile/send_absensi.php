<?php 
	include_once('koneksi.php'); 

	$id = 0;
	$pegawai = $_POST['pegawai'];
	$jenis = $_POST['jenis'];
	$keterangan = $_POST['keterangan'];
	$tanggal = $_POST['tanggal'];
	
	//History SYSTEM
	$id2 = 0;
	$nama_user = $_POST['user'];
	$time = $_POST['tanggal'];
	$nama_menu = 'Absensi';
	$aksi = 'Input Absensi Mobile App';
	
	
	$data = "SELECT * FROM absensi";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id'];
	} $id=$id+1;
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1;
	
	
	$insert = "INSERT INTO absensi(id,pegawai,jenis,keterangan,tanggal) VALUES ('$id','$pegawai','$jenis','$keterangan','$tanggal')";
	$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id2','$nama_user','$time','$nama_menu','$aksi')";
	

	$exeinsert = mysqli_query($con,$insert);
	$exehistory = mysqli_query($con,$history);
	$response = array();

	if($exeinsert&&$exehistory)
	{	
		echo "Send Success";
		///$response['message'] = "Success ! Data di tambahkan";
	}
	else
	{
		echo "Send Error: " . $insert . "<br>" . mysqli_error($con);
		///$response['message'] = "Failed ! Data Gagal di tambahkan";
	}

		
 ?>