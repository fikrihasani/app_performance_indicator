<?php
class M_dashboard extends CI_Model{
	public function __Construct(){
	parent:: __Construct();	
	}
	
	public function count_jml_kehilangan(){
		$year	 = date("Y");
		$j		 = $this->db->query("SELECT count(id) as jum
							FROM lost_found 
							WHERE YEAR(tanggal1) = '$year'
							AND jenis_laporan = '0'
							AND status = '1'
							")->row_array();
		$jumlah	= $j['jum'];
		return $jumlah;
	}
	
	public function count_jml_inspeksi(){
		$year	 = date("Y");
		$month	 = date("M");
		$day	 = date("D");
		$j		 = $this->db->query("SELECT count(id) as jum
							FROM sca_dokumentasi 
							WHERE YEAR(time) = '$year' AND MONTH(time) = '$month' AND DAY(time) = '$day'
							")->row_array();
		$jumlah	= $j['jum'];
		return $jumlah;
	}
	
	public function count_jml_kerusakan(){
		$year	 = date("Y");
		$month	 = date("M");
		$day	 = date("D");
		$j		 = $this->db->query("SELECT count(id) as jum
							FROM kerusakan 
							WHERE status = '0'
							")->row_array();
		$jumlah	= $j['jum'];
		return $jumlah;
	}
}

?>