<?
	class M_Hitung_new extends CI_Model
	{
		public function __Construct(){
			parent:: __Construct();
		}
		public function get_data_bersih_area($key, $month, $year){
			return $this->db->query("SELECT count(id) as 'jum' FROM `sca_dokumentasi` WHERE time between '$year-$month-01 00:00:00' and '$year-$month-31 23:59:59' and area = '$key' and nilai = 100")->row_array();
		}
		
		public function get_data_kotor_area($key, $month, $year){
			return $this->db->query("SELECT count(id) as 'jum' FROM `sca_dokumentasi` WHERE time between '$year-$month-01 00:00:00' and '$year-$month-31 23:59:59' and area = '$key' and nilai < 100")->row_array();
		}
		
		public function get_data_bersih_subarea($key, $month, $year){
			return $this->db->query("SELECT count(id) as 'jum' FROM `sca_dokumentasi` WHERE time between '$year-$month-01 00:00:00' and '$year-$month-31 23:59:59' and sub_area ='$key' and nilai = 100")->row_array();
		}
		
		public function get_data_kotor_subarea($key, $month, $year){
			return $this->db->query("SELECT count(id) as 'jum' FROM `sca_dokumentasi` WHERE time between '$year-$month-01 00:00:00' and '$year-$month-31 23:59:59' and sub_area ='$key' and nilai < 100")->row_array();
		}
		
		public function get_data_kotor_subareaxxx($key, $month, $year){
			return $this->db->query("SELECT count(id_periksa) as 'jum' FROM `pemeriksaan` WHERE tanggal between '$year-$month-01 00:00:00' and '$year-$month-31 23:59:59' and id_area = '$key' and hasil = 0")->row_array();
		}
	}
	
?>