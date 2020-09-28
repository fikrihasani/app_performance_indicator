<?php 
	function validateDate($date)
   {
       $d = DateTime::createFromFormat('Y-m-d', $date);
       return $d && $d->format('Y-m-d') === $date;
   }

	function date_convert($date){
	$d = explode('-',$date);

		$bulan = array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember'
		);
		if($date == '0000-00-00') { return '<span style=\'color:red\'>Undefined Date</span>'; }
		return $d[2].' '.$bulan[$d[1]].' '.$d[0];
	}
	
	function month_convert($date){
	$d = explode('-',$date);

		$bulan = array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember'
		);
		if($date == '0000-00-00') { return '<span style=\'color:red\'>Undefined Date</span>'; }
		return $bulan[$d[1]].' '.$d[0];
	}
	
	function get_year($date){
	$d = explode('-',$date);

		$bulan = array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember'
		);
		if($date == '0000-00-00') { return '<span style=\'color:red\'>Undefined Date</span>'; }
		return $d[0];
	}

   function get_month($month){
       
       $bulan = array(
           '01'=>'Januari',
           '02'=>'Februari',
           '03'=>'Maret',
           '04'=>'April',
           '05'=>'Mei',
           '06'=>'Juni',
           '07'=>'Juli',
           '08'=>'Agustus',
           '09'=>'September',
           '10'=>'Oktober',
           '11'=>'November',
           '12'=>'Desember'
           );
       
       return ISSET($bulan[$month]) ? $bulan[$month] : '-';
   }

   function day_from_date($date = 0, $full = 0){
       if($date == 0) return "Undefined Date";
       
       $timestamp = strtotime($date);
       $day = date("D", $timestamp);

       if($full == 1) {
           $day_full = array(
           'Sun'=>'Minggu',
           'Mon'=>'Senin',
           'Tue'=>'Selasa',
           'Wed'=>'Rabu',
           'Thu'=>'Kamis',
           'Fri'=>'Jumat',
           'Sat'=>'Sabtu',
           );

           return $day_full[$day];
       } else {
           $day_full = array(
           'Sun'=>'Ming',
           'Mon'=>'Sen',
           'Tue'=>'Sel',
           'Wed'=>'Rab',
           'Thu'=>'Kam',
           'Fri'=>'Jum',
           'Sat'=>'Sab',
           );

           return $day_full[$day];
       }
   }

	function inject($data) {
	//hapus tag
	$data   = strip_tags($data);
	//hapus space, and konvert all html	l tag jika masih ada
	$data   = htmlspecialchars(trim(htmlentities($data)));
	$data   = addslashes($data);

		   if(ISSET($data)) return $data;

	return "";
	}
	   
	   function he_decode($data){
		   $data =  html_entity_decode($data, ENT_QUOTES, 'UTF-8');
		   $data = stripslashes($data);
		   return str_replace('&nbsp;',' ',$data);
	   }

	function set_dot($d) {
	$whole      = floor($d);
	$fraction   = $d - $whole;

	if ($fraction == 0) {
	return @number_format($d, 0, ',', '.');
	} else {
	return number_format($d, 2, ',', '.');
	}
	}

	function date_formats($date) {
	$d  = explode('-', $date);
	return $d[2].'-'.$d[1].'-'.$d[0];
	}

	function datetime_formats($datetime) {
        if($datetime == '0000-00-00 00:00:00') return '-';
        $dt  = explode(' ', $datetime);
        
        $date = $dt[0];
        $time = $dt[1];
        $time = substr($time, 0, -3); 
        return date_convert($date).' / '.$time;
    }
    

	function idr($nominal){
	   //return 'Rp '.set_dot($nominal).',-';
	   return 'Rp '.set_dot($nominal);
   }

	function get_date($datetime) {
    	$dt  = explode(' ', $datetime);
    	$date = $dt[0];
    	return $date;
	}

	//helper untuk bahasa
	function get_option($name) {
		$ci     =& get_instance();
		$data   =  $ci->db->query("SELECT * FROM options WHERE name='$name'")->row_array();
		return $data['value'];
	}
	 
	
	
	function date_checker($date) {
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return true;
		} else {
			return false;
		}
	}
    
    function excerpt($term, $count){
        $t = explode(' ',$term);
        $tmp = '';
        
        if(count($t) <= $count){
            $count = count($t);
        }
        for($i=0;$i<$count;$i++){
            $tmp .= $t[$i].' ';
        }
        
        return $tmp;
    }
	
	/**/
	function cek_resiko($data_periksa){
		if($data_periksa['anamnesis'] != ''){
			return '1';
		}else if($data_periksa['tinggi_badan'] >= 145){
			return '0';
		}else if($data_periksa['berat_badan'] >= ($data_periksa['tinggi_badan'] - 110)){
			return '0';
		}else if($data_periksa['tekanan_daraha'] / $data_periksa['tekanan_darahb'] < 110/90){
			return '0';
		}else if($data_periksa['fundung_uterus'] == 0){
			return '0';
		}else if($data_periksa['lingkar_lengan'] >= 23.5){
			return '0';
		}else if($data_periksa['status_gizi'] == 0){
			return '0';
		}else if($data_periksa['refleksi_patella'] == 0){
			return '0';
		}else if($data_periksa['djj'] !== 0){
			return '0';
		}else if($data_periksa['kepala'] == 0){
			return '0';
		}else if($data_periksa['berat_janin'] == 0){
			return '0';
		}else if($data_periksa['jumlah_janin'] == 0){
			return '0';
		}else if($data_periksa['presentasi'] == 0){
			return '0';
		}else if($data_periksa['status_konseling'] == 1){
			return '0';
		}else if($data_periksa['status_imunisasi'] == 1){
			return '0';
		}else if($data_periksa['status_injeksi'] == 1){
			return '0';
		}else if($data_periksa['hb'] < 16 && $data_periksa['hb'] > 12){
			return '0';
		}else if($data_periksa['protein_urine'] > 15){
			return '0';
		}else if($data_periksa['gula_darah'] == 0){
			return '0';
		}else if($data_periksa['status_thalasemia'] == 0){
			return '0';
		}else if($data_periksa['status_sifilis'] == 0){
			return '0';
		}else if($data_periksa['hdk'] == 0){
			return '0';
		}else if($data_periksa['abortus'] == 0){
			return '0';
		}else if($data_periksa['status_konseling'] == 1){
			return '0';
		}else if($data_periksa['pendarahan'] == 0){
			return '0';
		}else if($data_periksa['infeksi'] == 0){
			return '0';
		}else if($data_periksa['kpd'] == 0){
			return '0';
		}else if(!$data_periksa['lain_lain']){
			return '0';
		}else{
			return '0';
		}
	}
	/**/
?>