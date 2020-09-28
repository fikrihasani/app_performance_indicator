<?php

class User_Model extends CI_Model{

    public function getAllUser(){
        return $this->db->get('user')->result_array();
    }

    public function addData($foto){
        $data = [
            "nik" => $this->input->post('nik',TRUE),
            "username" => $this->input->post('username',TRUE),
            "nama" => $this->input->post('nama',TRUE),
            "jabatan" => $this->input->post('jabatan',TRUE),
            "email" => $this->input->post('email',TRUE),
            "nik" => $this->input->post('nik',TRUE),
            "image" => $foto,
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            "level" => $this->input->post('level',TRUE),
            "is_active" => 1,
            'date_created' => time()
        ];
        $this->db->insert('user',$data);

        //insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => time(),
			"nama_menu" => 'User',
			"aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function hapusData($id){
		$this->db->where('id',$id);
        $query = $this->db->get('user');
        $row = $query->row();
        
        if($row->image != 'default.png'){
             unlink("./assets/upload/profile/$row->image");
        }
   
        $this->db->delete('user', array('id' => $id));
        
        //insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => time(),
			"nama_menu" => 'User',
			"aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
	}

    
}