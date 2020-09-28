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
	
	public function count_data_all($day, $month, $year){
		$tes = $this->db->query("SELECT id_area, count(id_periksa) as jum from pemeriksaan
								WHERE year(create_date) = '$year' 
								AND month(create_date) = '$month' 
								AND day(create_date) = '$day' 
								group by id_area")->result_array();
		
		$tesready =	$this->db->query("SELECT id_area, count(id_periksa) as jum from pemeriksaan
								WHERE year(create_date) = '$year' 
								AND month(create_date) = '$month' 
								AND day(create_date) = '$day' 
								AND hasil = '1'
								group by id_area")->result_array();
								
        $area = $this->db->query("SELECT id FROM area order by id ASC")->result_array();
		
		$jumlah = array();
        foreach($area as $ar) {
            $jumlah[$ar['id']] = 100;
        }

		//foreach($tes as $data){
			//$jumlah[$data['id_desa']] = $data['jum'];
		//};

		$return = "{";
		foreach ($jumlah  as $val) {
		    $return .= $val.',';
		}

		$return = substr($return, 0, -1);

		$return .= "}";

		return $return;
	}
	
	public function count_readiness_by_area($id = '', $date){
		$hari	 = days_from_date($date);
		$bulan	 = get_month($date);
		$tahun	 = get_year($date);
		$j		 = $this->db->query("SELECT p.id_sub,  p.shift, s.nama, m.standart, count(p.id_periksa) as jum
							FROM pemeriksaan p, subarea s, materials m
                            where p.id_area = '$id'
                            and p.id_sub = s.id
                            and hasil = '1'
							and day(p.create_date) = '$hari'
                            and month(p.create_date) = '$bulan'
                            and year(p.create_date) = '$tahun'
						    group by id_sub
							")->row_array();
		$jumlah	= $j['jum'];
		return $jumlah;
	}
	
	public function count_readiness_by_sub($id = '', $date){
		$hari	 = days_from_date($date);
		$bulan	 = get_month($date);
		$tahun	 = get_year($date);
		$j		 = $this->db->query("SELECT p.id_sub,  p.shift, s.nama, m.standart, count(p.id_periksa) as jum
							FROM pemeriksaan p, subarea s, materials m
                            where p.id_area = '$id'
                            and p.id_sub = s.id
                            and hasil = '1'
							and day(p.create_date) = '$hari'
                            and month(p.create_date) = '$bulan'
                            and year(p.create_date) = '$tahun'
						    group by id_sub
							")->row_array();
		$jumlah	= $j['jum'];
		return $jumlah;
	}
	
}

?>