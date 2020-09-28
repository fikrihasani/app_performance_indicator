<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kategori extends CI_Model
{


function __construct()
    {
        parent::__construct();
    }
	function get_kategori($id_cabang)
	{
		$result =  $this->db->query("
			SELECT id_kategori, nama_kategori
			FROM kategori where id_cabang = '$id_cabang'	
			order by nama_kategori asc
		")->result_array();

		return $result;
	}
	
 function get_all_kategori($id_cabang, $filter = [], $limit = 0, $start = 0)
	{
		
		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];
		if(ISSET($filter['nama_barang']) && $filter['nama_barang'] != '') {
			$filter['nama_barang'] = strtolower(inject($filter['nama_barang']));
            $flt[] = "lower(b.nama_barang) LIKE '%$filter[nama_barang]%'";
        }
        if(ISSET($filter['id_satuan']) && $filter['id_satuan'] != '') {
			$filter['id_satuan'] = strtolower(inject($filter['id_satuan']));
            $flt[] = "id_satuan LIKE '%$filter[id_satuan]%'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;
		
		$result =  $this->db->query("
			SELECT id_kategori, nama_kategori
			FROM kategori where id_cabang <> '99'
		$str_filter
			order by nama_kategori asc
			LIMIT $start, $limit

		")->result_array();

		return $result;
	}
	
	function get_kategori_by_idc($idc)
    {
        $this->db->select('*');
        $this->db->where('id_cabang',$idc);
        return $this->db->get('kategori')->result_array();
    }

    public function input_kategori($data){
		return $this->db->insert('kategori', $data);
	}

}
?>