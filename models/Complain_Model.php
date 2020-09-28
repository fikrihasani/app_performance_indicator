<?php

class Complain_Model extends CI_model{

    public function getAllComplain(){
        return $this->db->query("
            select b.nama as area, c.nama as subarea, a.complain, a.stakeholder, a.status, a.image, a.id, a.time
                from complains a
                left join area b on a.id_area=b.id
                left join subarea c on a.id_subarea=c.id
        ")->result_array();
    }
    
    public function addData($foto){
        date_default_timezone_set('Asia/Jakarta');
        //insert ke tabel complain
		$data = [
            "id_area" => $this->input->post('area',TRUE),
            "id_subarea" => $this->input->post('subarea',TRUE),
            "complain" => $this->input->post('complain',TRUE),
            "stakeholder" => $this->input->post('stakeholder',TRUE),
            "status" => $this->input->post('status',TRUE),
            "image" => $foto,
            'time' => date("Y-m-d H:i:s", time())
		];
        $this->db->insert('complains',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->input->post('akun',TRUE),
            "time" => time(),
            "nama_menu" => 'Complain',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function getComplainById($id){
		return $this->db->get_where('complains',['id' => $id])->row_array();
	}
    
    public function hapusData($id){

        $this->db->where('id',$id);
        $query = $this->db->get('complains');
        $row = $query->row();
        
        if($row->image != '-'){
            unlink("./assets/upload/complain/$row->image");
        }
   
        $this->db->delete('complains', array('id' => $id));

        $akun = $this->session->userdata('nama');
        
         //insert ke tabel history system
         $data2 = [
            "nama_user" => $akun,
            "time" => time(),
            "nama_menu" => 'Complain',
            "aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
    }
    
    public function ubahData($foto){

        if($foto!='-'){
            //insert ke tabel complain
            $data = [
                "id_area" => $this->input->post('area',TRUE),
                "id_subarea" => $this->input->post('subarea',TRUE),
                "complain" => $this->input->post('complain',TRUE),
                "stakeholder" => $this->input->post('stakeholder',TRUE),
                "status" => $this->input->post('status',TRUE),
                "image" => $foto,
            ];
        }
        else{
             $data = ["id_area" => $this->input->post('area',TRUE),
                "id_subarea" => $this->input->post('subarea',TRUE),
                "complain" => $this->input->post('complain',TRUE),
                "stakeholder" => $this->input->post('stakeholder',TRUE),
                "status" => $this->input->post('status',TRUE),
             ];
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('complains',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->input->post('akun',TRUE),
            "time" => time(),
            "nama_menu" => 'Complain',
            "aksi" => 'Mengubah Data',
        ];
        $this->db->insert('history_system',$data2);
    }
}