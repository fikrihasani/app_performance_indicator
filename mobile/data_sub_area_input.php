<?php 
	include_once('koneksi.php'); 

	$null = '';
	$id =$_POST['id'];
	$tag=$_POST['tag'];

	
	$cek = 0;
	$subareas = "SELECT * FROM subarea";
		$h_sub_areas = mysqli_query($con,$subareas);
			while($sub_area = mysqli_fetch_array($h_sub_areas)){
				if(($sub_area['tag']==$tag)&&($tag!=$null)){
					$cek = 1;
					$subarea = $sub_area['nama'];
					break;
				}	
			}
	if($cek == 0 ){
		$update = "UPDATE subarea SET tag='$tag' WHERE id='$id'";
		$exeinsert = mysqli_query($con,$update);
	}
	
	//$response = array();

	if($cek==0){
		if($exeinsert){
			echo "Tag is Update";
		}else{
			echo "Send Error: " . $update . "<br>" . mysqli_error($con);
		}
	}else if($cek==1){
		echo "Tag not Update, because is use in ".$subarea;
	}else{
		echo "Send Error: " . $update . "<br>" . mysqli_error($con);
	}

		
 ?>