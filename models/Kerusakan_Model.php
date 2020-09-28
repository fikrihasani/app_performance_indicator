<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerusakan_Model extends CI_Model {

    public function getAllKerusakan(){
        return $this->db->query("
            select a.id,  a.kerusakan, a.follow_up, a.status, a.image, a.time,
                b.nama as area, c.nama as subarea 
                    from kerusakan a
                    left join area b on b.id=a.id_area
                    left join subarea c on c.id=a.id_subarea
        ")->result_array();
    }

    public function addData($foto){
        date_default_timezone_set('Asia/Jakarta');
        $status = $this->input->post('status',TRUE);
            //insert ke tabel complain
            $data = [
                "id_area" => $this->input->post('area',TRUE),
                "id_subarea" => $this->input->post('subarea',TRUE),
                "kerusakan" => $this->input->post('kerusakan',TRUE),
                "follow_up" => $this->input->post('follow_up',TRUE),
                "status" => $status,
                "image" => $foto,
                'time' => date("Y-m-d H:i:s", time())
            ];
            $this->db->insert('kerusakan',$data);
        
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Kerusakan',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $query = $this->db->get('kerusakan');
        $row = $query->row();
        
        if($row->image != '-'){
             unlink("./assets/upload/kerusakan/$row->image");
        }
   
        $this->db->delete('kerusakan', array('id' => $id));

        $akun = $this->session->userdata('nama');
        

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Kerusakan',
            "aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function ubahData($foto){
        $status = $this->input->post('status',TRUE);

        if($foto != '-'){
            //insert ke tabel complain
            $data = [
                "id_area" => $this->input->post('area',TRUE),
                "id_subarea" => $this->input->post('subarea',TRUE),
                "kerusakan" => $this->input->post('kerusakan',TRUE),
                "follow_up" => $this->input->post('follow_up',TRUE),
                "status" => $status,
                "image" => $foto,
            ];
        }
        else{
            //insert ke tabel complain
            $data = [
                "id_area" => $this->input->post('area',TRUE),
                "id_subarea" => $this->input->post('subarea',TRUE),
                "kerusakan" => $this->input->post('kerusakan',TRUE),
                "follow_up" => $this->input->post('follow_up',TRUE),
                "status" => $status,
            ];
        }

            
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kerusakan',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Kerusakan',
            "aksi" => 'Mengubah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function getKerusakanById($id){
		return $this->db->get_where('kerusakan',['id' => $id])->row_array();
	}
    

	
}