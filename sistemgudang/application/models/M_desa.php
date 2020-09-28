<?php
class M_desa extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}
	
	public function get_all_desa(){
		return $this->db->query("SELECT id_desa, nama_desa FROM desa WHERE id_desa <> '99' and id_desa <> '12'")->result_array();
	}
	
	public function delete_user($id){
		$this->db->query("UPDATE user SET user_status = '1' WHERE id_user = '$id'");
	}
	
	public function insert_user($data){
		return $this->db->insert('user', $data);
	}
	
	public function get_user_by_id($id){
		return $this->db->query("SELECT * FROM user WHERE id_user = '$id' AND user_status = '0'")->row_array();
	}
	
	public function update_user($data, $id){
		return $this->db->update('user', $data, array('id_user' => $id));
	}

}
?>