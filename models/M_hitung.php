<?
	class M_hitung extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}
	
	public function get_all_hitung(){
		return $this->db->query("SELECT * FROM pemeriksaan WHERE id_area '71'")->result_array();
	}


?>