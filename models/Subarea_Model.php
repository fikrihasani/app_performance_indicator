<?php

class Subarea_Model extends CI_model{

	public function getSubarea(){
		return $this->db->query("
			select a.id, a.nama, a.tag, b.nama as area
				from subarea a
				left join area b on a.id_area=b.id
		")->result_array();
	}

	public function tambahData(){
	    date_default_timezone_set('Asia/Jakarta');
		$data = [
			"id_area" => $this->input->post('area',TRUE),
			"nama" => $this->input->post('nama',TRUE),
			"tag" => $this->input->post('nfc',TRUE)
		];

		$this->db->insert('subarea',$data);

		//insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => date("Y-m-d H:i:s", time()),
			"nama_menu" => 'Sub Area',
			"aksi" => 'Menambah Data',
	];
	$this->db->insert('history_system',$data2);
	}

	
  public function hapusData($id){
      date_default_timezone_set('Asia/Jakarta');
		$this->db->where('id',$id);
		$this->db->delete('subarea');

		//insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => date("Y-m-d H:i:s", time()),
			"nama_menu" => 'Sub Area',
			"aksi" => 'Menghapus Data',
		];
		$this->db->insert('history_system',$data2);
	}
	
	public function hapusDataPertanyaan($id){
      date_default_timezone_set('Asia/Jakarta');
		$this->db->where('id_subarea',$id);
		$this->db->delete('pertanyaan');
	}

	public function getSubAreaById($id){
		return $this->db->get_where('subarea',['id' => $id])->row_array();
	}

	public function ubahDataSubarea(){
	    date_default_timezone_set('Asia/Jakarta');
		$data = [
			"id_area" => $this->input->post('area',TRUE),
			"nama" => $this->input->post('nama',TRUE),
			"tag" => $this->input->post('nfc',TRUE)
		];

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('subarea',$data);

		//insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => date("Y-m-d H:i:s", time()),
			"nama_menu" => 'Sub Area',
			"aksi" => 'Mengubah Data',
	];
	$this->db->insert('history_system',$data2);
	}

	function subarea($id){
		$subarea="<option value='0'>----- Select -----</pilih>";

		$sub= $this->db->get_where('subarea',array('id_area'=>$id));

		foreach ($sub->result_array() as $data ){
		$subarea.= "<option value='$data[id]'>$data[nama]</option>";
		}

		return $subarea;
	}

	function material($id){
        $material="<option value='0'>----- Select -----</pilih>";

        $mat= $this->db->get_where('materials',array('id_subarea'=>$id));

        foreach ($mat->result_array() as $data ){
        $material.= "<option value='$data[id]'>$data[standart]</option>";
        }

        return $material;
    }
}