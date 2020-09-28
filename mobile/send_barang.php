<?php 
	include_once('koneksi.php'); 

	$id=0;
	$id_barang =$_POST['id'];
	$ambil = $_POST['ambil'];
	$stok=$_POST['stok'];
	$pengambil=$_POST['pengambil'];
	$time=$_POST['time'];
	
	
	//History SYSTEM
	$id2 = 0;
	$nama_user = $_POST['user'];
	$nama_menu = 'Stok Gudang';
	$aksi = 'Ambil Stok Gudang Mobile App';
	
	
	$data = "SELECT * FROM history_barang";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id'];
	} $id=$id+1;
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1;
	
	$data3 = "SELECT * FROM stok_gudang";
	$d_data3 = mysqli_query($con,$data3);	
	while($kode3 = mysqli_fetch_array($d_data3)){
		if($id_barang==$kode3['id']){
		   $nama_barang= $kode3['nama_barang'] ;
		   //$ambil = $kode3['stok'] - $ambil;
		}
	} 
	

	$insert = "INSERT INTO history_barang(id,id_barang,stok,pengambil,time) VALUES ('$id','$nama_barang','$stok','$pengambil','$time')";
	$update = "UPDATE stok_gudang SET stok='$stok' WHERE id='$id_barang'";
	$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id2','$nama_user','$time','$nama_menu','$aksi')";


	$exeinsert = mysqli_query($con,$insert);
	$exeupdate = mysqli_query($con,$update);
	$exehistory = mysqli_query($con,$history);
	
	$response = array();

	if($exeinsert&&$exeupdate&&$exehistory)
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