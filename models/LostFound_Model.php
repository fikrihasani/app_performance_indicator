<?php

class LostFound_Model extends CI_Model{

    public function getAllLostFound(){
        return $this->db->get('lost_found')->result_array();
    }

    public function addData($foto){
        date_default_timezone_set('Asia/Jakarta');
        $status = $this->input->post('status',TRUE);

        if($status=='Selesai'){
             //insert ke tabel complain
            $data = [
                "tanggal1" => date("Y-m-d H:i:s", time()),
                "penemu" => $this->input->post('penemu_pelapor',TRUE),
                "deskripsi" => $this->input->post('deskripsi',TRUE),
                "jenis_laporan" => $this->input->post('laporan',TRUE),
                "status" => $status,
                "tanggal2" => date("Y-m-d H:i:s", time()),
                "image" => $foto,
             ];
        }
        else{
            //insert ke tabel complain
            $data = [
                "tanggal1" => date("Y-m-d H:i:s", time()),
                "penemu" => $this->input->post('penemu_pelapor',TRUE),
                "deskripsi" => $this->input->post('deskripsi',TRUE),
                "jenis_laporan" => $this->input->post('laporan',TRUE),
                "status" => $status,
                "tanggal2" => 0,
                "image" => $foto,
             ];
        }
        $this->db->insert('lost_found',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Lost And Found',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $query = $this->db->get('lost_found');
        $row = $query->row();
   
        if($row->image != '-'){
             unlink("./assets/upload/lost_found/$row->image");
        }
   
        $this->db->delete('lost_found', array('id' => $id));


		$this->db->where('id',$id);
		$this->db->delete('lost_found');

		//insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => time(),
			"nama_menu" => 'Lost & Found',
			"aksi" => 'Menghapus Data',
		];
		$this->db->insert('history_system',$data2);
    }
    
    public function getLostFoundById($id){
		return $this->db->get_where('lost_found',['id' => $id])->row_array();
    }
    
    public function ubahData($foto){
        date_default_timezone_set('Asia/Jakarta');
        $status = $this->input->post('status',TRUE);
        

        if($foto!='-'){
            if($status=='Selesai'){
               $data = [
                   "penemu" => $this->input->post('penemu_pelapor',TRUE),
                   "deskripsi" => $this->input->post('deskripsi',TRUE),
                   "jenis_laporan" => $this->input->post('laporan',TRUE),
                   "status" => $status,
                   "tanggal2" => time(),
                   "image" => $foto,
                ];
           }
           else{
               $data = [
                   "penemu" => $this->input->post('penemu_pelapor',TRUE),
                   "deskripsi" => $this->input->post('deskripsi',TRUE),
                   "jenis_laporan" => $this->input->post('laporan',TRUE),
                   "status" => $status,
                   "image" => $foto,
                ];
           }
        }
        else{
            if($status=='Selesai'){
                $data = [
                    "penemu" => $this->input->post('penemu_pelapor',TRUE),
                    "deskripsi" => $this->input->post('deskripsi',TRUE),
                    "jenis_laporan" => $this->input->post('laporan',TRUE),
                    "status" => $status,
                    "tanggal2" => date("Y-m-d H:i:s", time()),
                 ];
            }
            else{
                $data = [
                    "penemu" => $this->input->post('penemu_pelapor',TRUE),
                    "deskripsi" => $this->input->post('deskripsi',TRUE),
                    "jenis_laporan" => $this->input->post('laporan',TRUE),
                    "status" => $status,
                 ];
            }
        }

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('lost_found',$data);

		//insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => time(),
			"nama_menu" => 'Lost & Found',
			"aksi" => 'Mengubah Data',
	];
	$this->db->insert('history_system',$data2);
	}
}


