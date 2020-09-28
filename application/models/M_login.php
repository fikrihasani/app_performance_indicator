<?php 
	class M_login extends CI_Model{
		public function __Construct(){
			parent:: __Construct();
		}
		
		public function get_user($akun){
			return $this->db->query("SELECT * FROM user WHERE username= '$akun[username]' and password='$akun[password]' ");
		}
		
		public function get_profil_by_id($id){
			return $this->db->query("SELECT * FROM user WHERE id_user= '$id' ")->row_array();
		}
		
		public function update_profil($data, $id) {
			$this->db->update('user', $data, array('id_user'=>$id));
		}
	}
?>