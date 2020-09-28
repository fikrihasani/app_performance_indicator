<?php
	//Import File Koneksi Database
	require_once('koneksi.php');

	//Membuat SQL Query
	$sql = "SELECT * FROM user";

	//Mendapatkan Hasil
	$r = mysqli_query($con,$sql);

	//Membuat Array Kosong
	$result = array();

	while($row = mysqli_fetch_array($r)){

		//Memasukkan Nama dan ID kedalam Array Kosong yang telah dibuat
		array_push($result,array(
			"id"=>$row['id'],
			"nama"=>$row['nama'],
			"username"=>$row['username'],
			//"password"=>$row['password'],
			"jabatan"=>$row['jabatan'],
			"level"=>$row['level']
			
		));
	}

	//Menampilkan Array dalam Format JSON
	echo json_encode(array('login'=>$result));

	mysqli_close($con);
?>
