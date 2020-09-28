<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_penyimpanan extends CI_Model
{


function __construct()
    {
        parent::__construct();
    }

    public function halo(){
    	echo '123123';
    }

	function get_penyimpanan()
	{
		$result =  $this->db->query("
			SELECT id_penyimpanan, nama_penyimpanan, kapasitas, sisa, id_gudang
			FROM daftar_penyimpanan order by nama_penyimpanan asc
		")->result_array();

		return $result;
	}
 function get_all_penyimpanan($id_gudang, $filter = [], $limit = 0, $start = 0)
	{
		
		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];
		if(ISSET($filter['nama_penyimpanan']) && $filter['nama_penyimpanan'] != '') {
			$filter['nama_penyimpanan'] = strtolower(inject($filter['nama_penyimpanan']));
            $flt[] = "lower(b.nama_penyimpanan) LIKE '%$filter[nama_penyimpanan]%'";
        }
        if(ISSET($filter['id_penyimpanan']) && $filter['id_penyimpanan'] != '') {
			$filter['id_penyimpanan'] = strtolower(inject($filter['id_penyimpanan']));
            $flt[] = "id_penyimpanan LIKE '%$filter[id_penyimpanan]%'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;
		
		$result =  $this->db->query("
			SELECT id_penyimpanan, nama_penyimpanan, kapasitas, sisa
			FROM daftar_penyimpanan where id_gudang <> '99'
		$str_filter
			order by nama_penyimpanan asc
			LIMIT $start, $limit

		")->result_array();

		return $result;
	}
	
	function get_penyimpanan_by_idc($idc)
    {
        $this->db->select('*');
        $this->db->where('id_gudang',$idc);
        return $this->db->get('penyimpanan')->result_array();
    }

    public function input_penyimpanan($data){
		return $this->db->insert('daftar_penyimpanan', $data);
	}

}
?>