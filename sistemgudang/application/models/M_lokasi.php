<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_lokasi extends CI_Model
{

	public $table = 'lokasi';


function __construct()
    {
        parent::__construct();
    }

 function get_all_gudang()
	{
		$result =  $this->db->query("
			SELECT id_rak, lokasi
			FROM lokasi

		")->result_array();

		return $result;
	}
	
	function get_all_lokasi()
	{
		$result =  $this->db->query("
			SELECT id_penyimpanan, nama_penyimpanan, Kapasitas
			FROM daftar_penyimpanan

		")->result_array();

		return $result;
	}
	
	function get_satuan()
	{
		$result =  $this->db->query("
			SELECT id_satuan, nama_satuan
			FROM satuan_barang
		")->result_array();
		return $result;
	}
	
	function count_gudang_by_cabang($id_cabang){
		$h = $this->db->query("SELECT COUNT(id_gudang) as JUM FROM daftar_gudang WHERE id_cabang = '$id_cabang'")->row_array();
		$j	= $h['JUM'];
		return $j;
	}
	
	function get_cabang_by_id($id_cabang){
		$h = $this->db->query("SELECT * FROM daftar_cabang WHERE id_cabang = '$id_cabang'")->row_array();
		
		return $h;
	}
	
	function get_gudang_by_cabang($id_cabang, $filter = [], $limit = 0, $start = 0)
	{
		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];
		if(ISSET($filter['nama_gudang']) && $filter['nama_gudang'] != '') {
			$filter['nama_gudang'] = strtolower(inject($filter['nama_gudang']));
            $flt[] = "lower(b.nama_gudang) LIKE '%$filter[nama_gudang]%'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		$result =  $this->db->query("
			SELECT id_gudang, nama_gudang, alamat
			FROM daftar_gudang where id_cabang = '$id_cabang'
			$str_filter
			order by nama_gudang asc
			LIMIT $start, $limit
		")->result_array();

		return $result;
	}

function get_all_kapasitas()
	{
		$result =  $this->db->query("
			SELECT id_rak, kapasitas
			FROM lokasi

		")->result_array();

		return $result;
	}

	function get_by_name($lokasi)
    {
        $this->db->select('*');
        $this->db->where('lokasi',$lokasi);
        return $this->db->get('lokasi')->result();
    }
	
	function get_gudang_by_idc($idc)
    {
        $this->db->select('*');
        $this->db->where('id_cabang',$idc);
        return $this->db->get('daftar_gudang')->result_array();
    }
	
	function get_penyimpanan_by_idc($idc)
    {
       $result =  $this->db->query("
			SELECT p.id_penyimpanan, g.nama_gudang, p.nama_penyimpanan
			FROM daftar_penyimpanan p,daftar_gudang g where g.id_gudang = p.id_gudang and g.id_cabang = '$idc'
			order by nama_gudang asc
		")->result_array();
		return $result;
    }

function count_all_rak()
	{
		$result =  $this->db->query("SELECT sum(kapasitas) as total
			FROM lokasi")->row_array();

		return $result;
	}
	
function count_all_rak_ready()
	{
		$result =  $this->db->query("SELECT sum(sisa) as sisa
			FROM lokasi")->row_array();

		return $result;
	}

public function input_gudang($data){
		return $this->db->insert('daftar_gudang', $data);
	}

function check_namalokasi($lokasi){
        $this->db->select('lokasi');
        $this->db->where('lokasi',$lokasi);
        return $this->db->get('lokasi')->num_rows();
    }

function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
}
?>