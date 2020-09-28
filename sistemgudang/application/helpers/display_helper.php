<?php

	function bpjs_convert($status_bpjs){
		if($status_bpjs =='0'){
			return 'Ya';
		}else{
			return 'Tidak';
		}
	}

	function pelayanan_convert($data){
		if($data =='0'){
			return 'Ya';
		}else{
			return 'Tidak';
		}
	}

	function komplikasi_convert($data){
		if($data =='0'){
			return 'Negatif';
		}else{
			return 'Positif';
		}
	}

	function pendeteksi_convert($data){
		if($data =='0'){
			return 'Nakes';
		}else{
			return 'Non Nakes';
		}
	}

	function empty_convert($data){
		if($data ==''){
			return '-';
		}else{
			return $data;
		}
	}

	function fundung_convert($data){
		if($data =='0'){
			return 'Simetri';
		}else{
			return 'Tidak Simetri';
		}
	}

	function gizi_convert($data){
		if($data =='0'){
			return 'Cukup Gizi';
		}else{
			return 'Kurang Gizi';
		}
	}

	function refleksi_convert($data){
		if($data =='0'){
			return '+';
		}else{
			return '-';
		}
	}

	function kepala_convert($data){
		if($data =='0'){
			return 'Normal';
		}else if($data =='1'){
			return 'Sungsang';
		}else{
			return 'Belum terlihat';
		}
	}

	function janin_convert($data){
		if($data =='0'){
			return 'Tunggal';
		}else if($data =='1'){
			return 'Gameli';
		}else{
			return 'Belum terlihat';
		}
	}

	function presentasi_convert($data){
		if($data =='0'){
			return 'Normal';
		}else if($data =='1'){
			return 'Suspect Tidak Normal';
		}else{
			return 'Belum terlihat';
		}
	}

	function status_convert($status_hamil){
		if($status_hamil =='0'){
		return 'Resiko Rendah';
		}else{
		return 'Resiko Tinggi';
		}
	}

	function verifikasi_convert($status_hamil){
		if($status_hamil =='0'){
		return 'Menunggu Verifikasi';
		}else if($status_hamil =='2'){
		return 'Periksa Kembali';
		}else if($status_hamil =='1'){
		return 'Berjalan';
		}else if($status_hamil =='3'){
		return 'Melahirkan';
		}else if($status_hamil =='4'){
		return 'Abortus';
		}else if($status_hamil =='5'){
		return 'Meninggal';
		}
	}

	function color_convert($color){
		if($color =='0'){
		return '#ccffcc';
		}else{
		return '#eab3d1';
		}
	}

	function color_convert2($color){
		if($color =='0'){
		return '#F1FDCE';
		}else{
		return '#FFE853';
		}
	}

	function usia_hamil_convert($usia){
		$selisih	= ((abs(strtotime ($usia) - strtotime (date('Y-m-d'))))/(60*60*24));
		$hasil		=  (round(round($selisih) / 7));
		return $hasil;
	}

	function umur_convert($usia){
		$selisih	= ((abs(strtotime ($usia) - strtotime (date('Y-m-d'))))/(60*60*24));
		$hasil		= (round(round($selisih) / 365));
		return $hasil;
	}

	function desa_convert($id_desa){
		$desa = array(
			'1'=>'Tlogoboyo',
			'2'=>'Kembangan',
			'3'=>'Tridonorejo',
			'4'=>'Moro Demak',
			'5'=>'Purworejo',
			'6'=>'Margolinduk',
			'7'=>'Gebang Arum',
			'8'=>'Sumberejo',
			'9'=>'Karang Rejo',
			'10'=>'Gebang',
			'11'=>'Sukodono'
			);
		return $desa[$id_desa];
	}

?>
