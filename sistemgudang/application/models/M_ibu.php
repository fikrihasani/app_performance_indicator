<?php
class M_ibu extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}

	public function get_ibu_by_desa($id, $filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];
		if(ISSET($filter['nik']) && $filter['nik'] != '') {
			$filter['nik'] = strtolower(inject($filter['nik']));
            $flt[] = "nik LIKE '%$filter[nik]%'";
        }
        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(nama_ibu) LIKE '%$filter[full_name]%'";
        }
        if(ISSET($filter['address']) && $filter['address'] != '') {
			$filter['address'] = strtolower(inject($filter['address']));
            $flt[] = "lower(alamat) LIKE 	'%$filter[address]%'";
        }
		if(ISSET($filter['nomor_darurat']) && $filter['nomor_darurat'] != '') {
			$filter['nomor_darurat'] = strtolower(inject($filter['nomor_darurat']));
            $flt[] = "nomor_darurat = '$filter[nomor_darurat]'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		$result =  $this->db->query("
			SELECT nik, nama_ibu, alamat, nomor_darurat, tanggal_lahir
			FROM ibu
			WHERE
			id_desa = '$id' AND flag_delete = '0'
			$str_filter
			LIMIT $start, $limit
		")->result_array();

		return $result;
	}

	public function get_ibu_by_desa_r($id, $filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];
		if(ISSET($filter['nik']) && $filter['nik'] != '') {
			$filter['nik'] = strtolower(inject($filter['nik']));
            $flt[] = "nik = $filter[nik]";
        }
        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(nama_ibu) LIKE '%$filter[full_name]%'";
        }
        if(ISSET($filter['address']) && $filter['address'] != '') {
			$filter['address'] = strtolower(inject($filter['address']));
            $flt[] = "lower(alamat) = 	'$filter[address]'";
        }
		if(ISSET($filter['nomor_darurat']) && $filter['nomor_darurat'] != '') {
			$filter['nomor_darurat'] = strtolower(inject($filter['nomor_darurat']));
            $flt[] = "nomor_darurat = '$filter[nomor_darurat]'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		$result =  $this->db->query("
			SELECT nik, nama_ibu, alamat, nomor_darurat, tanggal_lahir
			FROM ibu
			WHERE
			id_desa = '$id' AND status_isi = '0' AND flag_delete = '0'
			$str_filter
			LIMIT $start, $limit
		")->result_array();

		return $result;
	}

	public function delete_ibu($id, $time){
		$this->db->query("UPDATE ibu SET flag_delete = '1', waktu_ubah = '$time', ubah_by = '$id' WHERE nik = '$id'");
	}

	public function insert_ibu($data){
		return $this->db->insert('ibu', $data);
	}

	public function get_ibu_by_id($id){
		return $this->db->query("SELECT * FROM ibu WHERE nik = '$id' AND flag_delete = '0'")->row_array();
	}

	public function update_ibu($data, $id){
		return $this->db->update('ibu', $data, array('nik' => $id));
	}

	public function count_ibu_desa($idd){
		$h = $this->db->query("SELECT COUNT(nik) as JUM FROM ibu WHERE id_desa = '$idd' and flag_delete = '0'")->row_array();
		$j	= $h['JUM'];
		return $j;
	}

	public function count_ibu_all(){
		$h = $this->db->query("SELECT COUNT(nik) as JUM FROM ibu WHERE flag_delete = '0'")->row_array();
		$j	= $h['JUM'];
		return $j;
	}
}
?>
