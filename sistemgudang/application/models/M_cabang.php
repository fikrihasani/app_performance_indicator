<?php
class M_cabang extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}
	
	public function get_all_cabang(){
		return $this->db->query("SELECT id_cabang, nama_cabang FROM daftar_cabang")->result_array();
	}

}
?>