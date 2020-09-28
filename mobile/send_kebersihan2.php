<?php 
	include ('koneksi.php'); 

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = 0; $id2 = 0; $id3= 0; $null = ""; $id_manpower = 0;
	$time = $_POST['time'];
	$shift = $_POST['shift'];
	$area = $_POST['area'];
	$sub_area = $_POST['sub_area'];
	$nilai = $_POST['nilai'];
	$user = $_POST['user'];
	$id_user = $_POST['id_user'];
	$result = $_POST['result'];
	$manpower = $_POST['manpower'];
	//$file = $_POST['file'];
	

	//History SYSTEM
	$nama_user = $_POST['user'];
	$nama_menu = 'SCA Dokumentasi';
	$aksi = 'Input SCA Dokumentasi Mobile App';
	
	
	/*$data = "SELECT * FROM sca_dokumentasi";
	$d_data = mysqli_query($con,$data);	
	while($kode = mysqli_fetch_array($d_data)){
		$id=$kode['id'];
	} $id=$id+1; //$image = $nama_menu."_".$id.".jpg"; $Path = "../assets/upload/sca/$image"; 
	
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1; 
	
	$data3 = "SELECT * FROM pemeriksaan";
	$d_data3 = mysqli_query($con,$data3);	
	while($kode3 = mysqli_fetch_array($d_data3)){
		$id3=$kode3['id_periksa'];
	} $id3=$id3+1; */
	
	
	$data_manpowers = "SELECT * FROM manpower WHERE nama = '$manpower'";
	$d_manpower = mysqli_query($con,$data_manpowers);	
	while($man = mysqli_fetch_array($d_manpower)){
	    $id_manpower=$man['id_manpower'];
	}  
	
	
	$pecah1 = explode(",",$result);
	$material = count($pecah1);

	for($i=0;$i<$material-1;$i++){
	    $pecah2 = explode(":",$pecah1[$i]);
	    $id_material=$pecah2[0];
	    $hasil=$pecah2[1];
	    if($hasil=="1"){
	        $penjelasan="aman";    
	    }else{
	        $penjelasan="tidak aman";
	    }
	    
	    
	    
	    //echo "id_material = ".$id_material." Hasil = ".$hasil." Deskripsi = ".$deskripsi."<br>";
	    
	    $insert_periksa = "INSERT INTO pemeriksaan(id_periksa,tanggal,id_area,id_sub,id_material, shift, hasil, penjelasan, create_date, create_by, gambar, tindak_lanjut , gambar_tindaklanjut, id_manpower, hasil_tindakan, gambar_hasil) 
	    VALUES ('','$time','$area','$sub_area','$id_material','$shift','$hasil','$penjelasan','$time','$id_user','$null','$null','$null','$id_manpower','$null','$null')";
        $exeperiksa = mysqli_query($con,$insert_periksa);
	  
	}
	
	
	$insert = "INSERT INTO sca_dokumentasi(id,time,shift,area,sub_area,nilai,user,image) VALUES ('','$time','$shift','$area','$sub_area','$nilai','$user','-')";
	$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('','$nama_user','$time','$nama_menu','$aksi')";
	
	
	$exeinsert = mysqli_query($con,$insert);
	$exehistory = mysqli_query($con,$history);
	
	
	
	if($exeperiksa&&$exeinsert&&$exehistory)
	{	
		//file_put_contents($Path,base64_decode($file));
		echo "Send Success";
		///$response['message'] = "Success ! Data di tambahkan";
	}
	else
	{
		echo "Send Error: " . $exeperiksa." - ". $exeinsert ." - ". $exeinsert. "<br>" . mysqli_error($con);
		///$response['message'] = "Failed ! Data Gagal di tambahkan";
	}
	
	
	
	
}else{
	echo "Please Try Again";
}
		
 ?>

