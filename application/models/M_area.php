<?php

class M_area extends CI_model{
	public function get_all_area(){
		return $this->db->query("SELECT id, nama FROM area where flag_delete = '0' ")->result_array();
	}
	
	public function get_all_sub($ida){
		return $this->db->query("SELECT id, nama FROM subarea WHERE id_area = '$ida' and flag_delete = '0'")->result_array();
	}
	
}
?>