<?php
class M_stock extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}
	
	public function insert_stock($data){
		return $this->db->insert('stock_barang', $data);
	}
	
	public function update_stock($id_stock, $data){
		return $this->db->update('stock_barang', $data, array('id_stock' => $id_stock));
	}
	
	public function cek_stock($id_barang, $id_penyimpanan){
		return $this->db->query("SELECT * FROM stock_barang WHERE id_barang = '$id_barang' AND id_penyimpanan = '$id_penyimpanan'")->row_array();
	}
	
	function count_stock_by_cabang($id_cabang){
		$h = $this->db->query("SELECT SUM(s.stock) as JUM FROM stock_barang s, daftar_penyimpanan p, daftar_gudang g WHERE p.id_penyimpanan = s.id_penyimpanan and p.id_gudang = g.id_gudang and g.id_cabang = '$id_cabang'")->row_array();
		$j	= $h['JUM'];
		return $j;
	}
	
	public function get_stock_detail_by_id($ids){
		return $this->db->query("SELECT b.nama_barang, p.nama_penyimpanan, s.stock, s.id_stock
								FROM stock_barang s, daftar_barang b, daftar_penyimpanan p
								WHERE s.id_barang = b.id_barang AND s.id_penyimpanan = p.id_penyimpanan AND s.id_stock = '$ids'")->row_array();
	}

	public function batchUpdate(){
		return $this->db->update_batch('stock_barang', $this->session->userdata('updater'), 'id_stock');
	}
	
	public function insert_resi_final($data){
		return $this->db->insert('resi',$data);
	}	
	
	public function get_resi(){
		$result = $this->db->query("SELECT * from resi order by id desc limit 1")->row_array();
		
		return $result;
	}
	
	function get_stock_in_by_idc($id_penyimpanan, $filter = [], $limit = 0, $start = 0)
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
			SELECT * from transaksi where id_penyimpanan = '$id_penyimpanan'
			and status = '0'
			$str_filter
			order by id_transaksi desc
			LIMIT $start, $limit
		")->result_array();

		return $result;
	
    }
}
?>