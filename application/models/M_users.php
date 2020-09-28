<?php
class M_users extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}

	public function get_all_user($filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];
		if(ISSET($filter['status']) && $filter['status'] != '') {
			$filter['status'] = strtolower(inject($filter['status']));
            $flt[] = "user_status = $filter[status]";
        }
        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(nama) LIKE '%$filter[full_name]%'";
        }
        if(ISSET($filter['username']) && $filter['username'] != '') {
			$filter['username'] = strtolower(inject($filter['username']));
            $flt[] = "lower(username) = 	'$filter[username]'";
        }
		if(ISSET($filter['telepon']) && $filter['telepon'] != '') {
			$filter['telepon'] = strtolower(inject($filter['telepon']));
            $flt[] = "no_telp LIKE '$filter[telepon]'";
        }

		if(ISSET($filter['level']) && $filter['level'] != '') {
			$filter['level'] = strtolower(inject($filter['level']));
			$flt[] = "id_level = $filter[level]";
		}

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;



		$result =  $this->db->query("
			SELECT id_user, nama, nip, username, no_telp,id_desa, id_level, user_status
			FROM user
			WHERE (user_status = '0' OR user_status = '1')
			$str_filter
			LIMIT $start, $limit
		")->result_array();

		//dumper($this->db->last_query());


		return $result;
	}

	public function get_level(){
		$level = $this->db->get('level')->result_array();

		$lvl = [];
		foreach($level as $l){
			$lvl[$l['id_level']] = $l['level'];
		}

		return $lvl;

	}

	public function delete_user($id){
		$this->db->query("UPDATE user SET user_status = '2' WHERE id_user = '$id'");
	}

	public function insert_user($data){
		return $this->db->insert('user', $data);
	}

	public function get_user_by_id($id){
		return $this->db->query("SELECT * FROM user WHERE id_user = '$id'")->row_array();
	}

	public function update_user($data, $id){
		return $this->db->update('user', $data, array('id_user' => $id));
	}
	
	public function count_user_all(){
		$h = $this->db->query("SELECT COUNT(id_user) as JUM FROM user WHERE user_status = '0'")->row_array();
		$j	= $h['JUM'];
		return $j;
	}
}
?>
