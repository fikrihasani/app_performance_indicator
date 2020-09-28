<?php
	//Import File Koneksi Database
	require_once('koneksi.php');
	
	$sekarang = (date('Y-m'));

	if(isset($_GET['admin'])&&isset($_GET['manpower'])){	
		$admin = $_GET['admin'];
		$manpower = $_GET['manpower'];
		
		$tanggal = "null";  $lokasi = "null";   $lokasinya = "null";   $shift="null";
		$id_manpower = "null";  $nama_manpower = "null";
		$nilai = 0; $count = 0; $score = 0;
		
		$manpowers = "SELECT * FROM manpower where (id_manpower = '$manpower')";
		$man = mysqli_fetch_array(mysqli_query($con,$manpowers));
	    $id_manpower = $man['id_manpower'];
	    $nama_manpower = $man['nama']; 
		
		
    	$manpower_record = array();
    	$manpowers_record = "SELECT * FROM pemeriksaan where id_manpower = '$manpower' ORDER BY id_periksa DESC";

    	$h_manpowers = mysqli_query($con,$manpowers_record);
			while($rec = mysqli_fetch_array($h_manpowers)){
			    
			    if(($tanggal==$rec['create_date'])&&($lokasi==$rec['id_sub'])){
			        if($rec['hasil']=="1"){ $hasil = 1; } else { $hasil = 0; }
			        
			        $nilai = $nilai + $hasil;
			        $count++;
			        $score = ($nilai*100)/$count;
			        $score = number_format($score); // Kalo mau dikasih koma ($score , 2) == 100,00;
			    }else{
			        if(($tanggal!="null")||($lokasi!="null")){
                        $subareas = "SELECT * FROM subarea where (id = '$lokasi')";
            			$sub = mysqli_fetch_array(mysqli_query($con,$subareas));
            			$lokasinya = $sub['nama'];
            		    $tanggalnya = $tanggal[8].$tanggal[9].$tanggal[7].$tanggal[5].$tanggal[6].$tanggal[4].$tanggal[0].$tanggal[1].$tanggal[2].$tanggal[3];
    			        
    			        if($sekarang==$tanggal[0].$tanggal[1].$tanggal[2].$tanggal[3].$tanggal[4].$tanggal[5].$tanggal[6]){
    			            array_push($manpower_record,array(
                    			"tanggal"=>$tanggalnya,
                    			"lokasi"=>$lokasinya,
                    			"shift"=>$shift,
                    			"score"=>$score,
                		    )); 
    			        }
    			        
			        }
			        
			        if($rec['hasil']=="1"){ $hasil = 1; } else { $hasil = 0; }
			        $nilai = $hasil;
			        $count = 1;
			        
			        if($rec['shift']=="1"){ $shift="Pagi"; } else if ($rec['shift']=="2"){ $shift="Siang"; } else if ($rec['shift']=="3"){ $shift="Malam"; } //Untuk shift
			    
			        $tanggal = $rec['create_date'];
			        $lokasi = $rec['id_sub'];
			    }
			    
        			
			}
			        $subareas = "SELECT * FROM subarea where (id = '$lokasi')";
        			$sub = mysqli_fetch_array(mysqli_query($con,$subareas));
        			$lokasinya = $sub['nama'];
            		$tanggalnya = $tanggal[8].$tanggal[9].$tanggal[7].$tanggal[5].$tanggal[6].$tanggal[4].$tanggal[0].$tanggal[1].$tanggal[2].$tanggal[3];
            		
			        if($tanggal!="null"&&($sekarang==$tanggal[0].$tanggal[1].$tanggal[2].$tanggal[3].$tanggal[4].$tanggal[5].$tanggal[6])){
			            array_push($manpower_record,array(
                			"tanggal"=>$tanggalnya,
                			"lokasi"=>$lokasinya,
                			"shift"=>$shift,
                			"score"=>$score,
            		    ));
			        }
			        
    	
        
        	//echo count($manpower_record);
        	
        	echo json_encode(array('id'=>$id_manpower,'nama'=>$nama_manpower,'manpower_record'=>$manpower_record));
        	
	}else{
	    echo "WHAT ARE U DOING???";
	}

	
?>