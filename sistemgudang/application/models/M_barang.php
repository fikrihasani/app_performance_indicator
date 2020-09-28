<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_barang extends CI_Model
{

    public $table = 'barang';
    public $id = 'id_barang';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

	function get_all_barang($id_cabang, $filter = [], $limit = 0, $start = 0)
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
			SELECT b.id_barang, b.nama_barang, s.nama_satuan, b.kode, k.nama_kategori
			FROM daftar_barang b, satuan_barang s, kategori k
			where b.id_cabang = '$id_cabang' and b.id_satuan = s.id_satuan and b.id_kategori = k.id_kategori
			$str_filter
			order by nama_barang asc
			LIMIT $start, $limit
		")->result_array();

		return $result;
	
    }
	
	
	function get_all_penerimaan_by_idc($id_cabang){
		$result =  $this->db->query("
			SELECT * from daftar_penerimaan_barang where id_cabang = '$id_cabang'
			order by create_date desc
		")->result_array();

		return $result;
	}
	function get_all_penerimaan($id_cabang, $filter = [], $limit = 0, $start = 0)
    {	
		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];
		if(ISSET($filter['nama_barang']) && $filter['nama_barang'] != '') {
			$filter['nama_barang'] = strtolower(inject($filter['nama_barang']));
            $flt[] = "lower(b.nama_barang) LIKE '%$filter[nama_barang]%'";
        }
        if(ISSET($filter['nama_shippers']) && $filter['nama_shippers'] != '') {
			$filter['nama_shippers'] = strtolower(inject($filter['nama_shippers']));
            $flt[] = "nama_shippers LIKE '%$filter[nama_shippers]%'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		$result =  $this->db->query("
			SELECT * from daftar_penerimaan_barang where id_cabang = '$id_cabang'
			$str_filter
			order by nama_barang desc
			LIMIT $start, $limit
		")->result_array();

		return $result;
	
    }
	
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

	function get_barang()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
	
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by name
    function get_by_name($nama_barang)
    {
        $this->db->select('*');
        $this->db->where('nama_barang',$nama_barang);
        return $this->db->get('barang')->result();
    }
	
	function get_barang_by_idc($idc)
    {
        $this->db->select('*');
        $this->db->where('id_cabang',$idc);
        return $this->db->get('daftar_barang')->result_array();
    }
	
    function get_all_barangxx()
	{
		$result =  $this->db->query("
			SELECT id_barang, nama_barang
			FROM barang

		")->result_array();

		return $result;
	}
	
	function get_gambar_by_id($id)
	{
		$result =  $this->db->query("
			SELECT id_item, gambar from transaksi_barang where id_item = '$id'

		")->row_array();

		return $result;
	}
	
	
	function get_all_satuan()
	{
		$result =  $this->db->query("
			SELECT id_barang, satuan
			FROM barang

		")->result_array();

		return $result;
	}

    function get_all_kode()
    {
        $result =  $this->db->query("
            SELECT id_barang, kode
            FROM barang

        ")->result_array();

        return $result;
    }

    function update_qr ($kode, $gambar)
    {
        $result = $this->db->query("UPDATE id_item where $kode = $gambar");
    }

    function count_all_item()
    {
        $result =  $this->db->query("SELECT sum(jumlah) as jumlah
            FROM transaksi_barang")->row_array();

        return $result;
    }
	
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_barang', $q);
	$this->db->or_like('nama_barang', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('pengirim', $q);
	$this->db->or_like('id_lokasi', $q);
	$this->db->or_like('barcode', $q);
	$this->db->or_like('qr', $q);
    $this->db->or_like('stok', $q);
    $this->db->or_like('satuan', $q);
    $this->db->or_like('fungsi', $q);
    $this->db->or_like('pengambil', $q);
    $this->db->or_like('kirim', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_barang', $q);
	$this->db->or_like('nama_barang', $q);
	$this->db->or_like('id_kategori', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('pengirim', $q);
	$this->db->or_like('id_lokasi', $q);
	$this->db->or_like('barcode', $q);
	$this->db->or_like('qr', $q);
    $this->db->or_like('stok', $q);
    $this->db->or_like('satuan', $q);
    $this->db->or_like('fungsi', $q);
    $this->db->or_like('pengambil', $q);
    $this->db->or_like('kirim', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

	//Input transaksi barang masuk
	public function input_masuk($data){
		return $this->db->insert('transaksi_barang', $data);
	}
	
	public function input_barang($data){
		return $this->db->insert('daftar_barang', $data);
	}
	
	public function input_penerimaan_barang($data){
		return $this->db->insert('daftar_penerimaan_barang', $data);
	}
	
	public function get_id_transaksi(){
		return $this->db->query("
			SELECT id_item
			FROM transaksi_barang
			order by id_item
			DESC limit 1

		")->row_array();
	}
	
	public function input_stock_in($data){
		return $this->db->insert('transaksi', $data);
	}
	
	
    //cek barang
    function check_namabarang($nama_barang){
        $this->db->select('nama_barang');
        $this->db->where('nama_barang',$nama_barang);
        return $this->db->get('barang')->num_rows();
    }

}

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-06 19:47:17 */
/* http://harviacode.com */