<?php 
	include_once('koneksi.php'); 

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id = $_POST['id'];
	$penjelasan = $_POST['penjelasan'];
	$tindak_lanjut = $_POST['tindakan'];
	$hasil_tindakan = $_POST['h_tindakan'];
	
	$file1 = $_POST['file1'];
	$file2 = $_POST['file2'];
	$file3 = $_POST['file3'];
	
	
	//History SYSTEM
	$id2 = 0;
	$nama_user = $_POST['user'];
	$time = $_POST['time'];
	$nama_menu = 'Pemeriksaan';
	$aksi = 'Edit Pemeriksaan Mobile App';
	
	
	$data2 = "SELECT * FROM history_system";
	$d_data2 = mysqli_query($con,$data2);	
	while($kode2 = mysqli_fetch_array($d_data2)){
		$id2=$kode2['id'];
	} $id2=$id2+1;
	
	
	if($file!="NULL"){
	    $image1 = "Pemeriksaan_1_".$id.".jpg"; $Path1 = "../assets/upload/pemeriksaan/$image1";
	    $image2 = "Pemeriksaan_2_".$id.".jpg"; $Path2 = "../assets/upload/pemeriksaan/$image2";
	    $image3 = "Pemeriksaan_3_".$id.".jpg"; $Path3 = "../assets/upload/pemeriksaan/$image3";
	    
	}else{
	    $image1 = "Pemeriksaan_1_".$id.".jpg";
	    $image2 = "Pemeriksaan_2_".$id.".jpg";
	    $image3 = "Pemeriksaan_3_".$id.".jpg";
	    
	}
	
	$insert = "UPDATE pemeriksaan SET tanggal='$time', penjelasan='$penjelasan', tindak_lanjut='$tindak_lanjut', hasil_tindakan='$hasil_tindakan', gambar='$image1',gambar_tindaklanjut='$image2',gambar_hasil='$image3'  WHERE id_periksa='$id'";
	//$history = "INSERT INTO history_system(id,nama_user,time,nama_menu,aksi) VALUES ('$id2','$nama_user','$time','$nama_menu','$aksi')";


	$exeinsert = mysqli_query($con,$insert);
	//$exehistory = mysqli_query($con,$history);
	
	//if($exeinsert&&$exehistory)
	if($exeinsert)
	{
        //unlink($Path);
        file_put_contents($Path1,base64_decode($file1));
        file_put_contents($Path2,base64_decode($file2));
        file_put_contents($Path3,base64_decode($file3));
        
		echo "Send Success";
		///$response['message'] = "Success ! Data di tambahkan";
	}
	else
	{
		echo "Send Error: " . $insert . "<br>" . mysqli_error($con);
		///$response['message'] = "Failed ! Data Gagal di tambahkan";
	}
	
}else{
	echo "Please Try Again";
 }
		
 ?>