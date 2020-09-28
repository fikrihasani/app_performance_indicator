<?php

class Area_model extends CI_model{

	public function getAllArea(){
		return $this->db->get('area')->result_array();
	}

	public function tambahDataArea(){
	    date_default_timezone_set('Asia/Jakarta');
		$data = [
			"nama" => $this->input->post('area',TRUE),
		];
		$this->db->insert('area',$data);

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Area',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
	}

	public function hapusDataArea($id){
	    date_default_timezone_set('Asia/Jakarta');
		$this->db->where('id',$id);
		$this->db->delete('area');

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Area',
            "aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
	}
	
	public function hapusDataSubArea($id){
	    date_default_timezone_set('Asia/Jakarta');
		$this->db->where('id_area',$id);
		$this->db->delete('subarea');
	}
	
	public function hapusDataPertanyaan($id){
	    date_default_timezone_set('Asia/Jakarta');
		$this->db->where('id_area',$id);
		$this->db->delete('pertanyaan');
	}

	public function getAreaById($id){
		return $this->db->get_where('area',['id' => $id])->row_array();
	}

	public function ubahDataArea(){
	    date_default_timezone_set('Asia/Jakarta');
		$data = [
			"nama" => $this->input->post('area',TRUE),
		];

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('area',$data);

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Area',
            "aksi" => 'Mengubah Data',
        ];
        $this->db->insert('history_system',$data2);
	}

	// public function cariDataMahasiswa(){
	// 	$keyword = $this->input->post('keyword',TRUE);
	// 	$this->db->like('nama',$keyword);
	// 	$this->db->or_like('jurusan',$keyword);
	// 	$this->db->or_like('nrp',$keyword);
	// 	$this->db->or_like('email',$keyword);
	// 	return $this->db->get('mahasiswa')->result_array();
	// }

}