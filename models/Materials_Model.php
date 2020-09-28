<?php

class Materials_Model extends CI_Model{

    public function getAllMaterials(){
        return $this->db->query("
            select a.id,  a.standart, a.standart_pertanyaan, a.image from materials a")->result_array();
    }


    public function addData($foto){

        $data = [
            "standart" => $this->input->post('standart',TRUE),
            "standart_pertanyaan" => $this->input->post('standart_pertanyaan',TRUE),
            "image" => $foto,
        ];
        $this->db->insert('materials',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Materials',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function hapusData($id){
		$this->db->where('id',$id);
        $query = $this->db->get('materials');
        $row = $query->row();
   
        if($row->image != '-'){
            unlink("./assets/upload/materials/$row->image");
        }
   
        $this->db->delete('materials', array('id' => $id));

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Materials',
            "aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function getMaterialsById($id){
		return $this->db->get_where('materials',['id' => $id])->row_array();
    }
    
    public function ubahData($foto){

        if($foto != '-'){
            $data = [
                "standart" => $this->input->post('standart',TRUE),
                "standart_pertanyaan" => $this->input->post('standart_pertanyaan',TRUE),
                "image" => $foto,
            ];
        }
        else{
            $data = [
                "standart" => $this->input->post('standart',TRUE),
                "standart_pertanyaan" => $this->input->post('standart_pertanyaan',TRUE),
            ];
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('materials',$data);

         //insert ke tabel history system
         $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Materials',
            "aksi" => 'Mengubah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

}