<?php

class M_area extends CI_model{
	public function get_all_area(){
		return $this->db->query("SELECT id, nama FROM area")->result_array();
	}
	
	public function get_all_sub($ida){
		return $this->db->query("SELECT id, nama FROM subarea WHERE area = '$ida'")->result_array();
	}
	
}
?>