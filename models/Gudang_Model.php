<?php

class Gudang_Model extends CI_model{

    public function getAllGudang(){
        return $this->db->query("
            select * from stok_gudang")->result_array();
    }

    public function addData($foto){
        date_default_timezone_set('Asia/Jakarta');
        //insert ke tabel complain
		$data = [
            "nama_barang" => $this->input->post('nama_barang',TRUE),
            "stok" => $this->input->post('stok_barang',TRUE),
            "pengambil" => $this->session->userdata('nama'),
            "image" => $foto,
            'time' => date("Y-m-d H:i:s", time())
		];
        $this->db->insert('stok_gudang',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" =>  $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Gudang',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function hapusData($id){
        date_default_timezone_set('Asia/Jakarta');
		$this->db->where('id',$id);
        $query = $this->db->get('stok_gudang');
        $row = $query->row();
        
        if($row->image != '-'){
            unlink("./assets/upload/gudang/$row->image");
        }   
   
        $this->db->delete('stok_gudang', array('id' => $id));

        $akun = $this->session->userdata('nama');
        
         //insert ke tabel history system
         $data2 = [
            "nama_user" => $akun,
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Gudang',
            "aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function getGudangById($id){
		return $this->db->get_where('stok_gudang',['id' => $id])->row_array();
    }
    
    public function ubahData($foto){
        date_default_timezone_set('Asia/Jakarta');

        if($foto!='-'){
            //insert ke tabel complain
            $data = [
                "nama_barang" => $this->input->post('nama_barang',TRUE),
                "stok" => $this->input->post('stok_barang',TRUE),
                "image" => $foto,
            ];
        }
        else{
            $data = [
                "nama_barang" => $this->input->post('nama_barang',TRUE),
                "stok" => $this->input->post('stok_barang',TRUE),
            ];
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('stok_gudang',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" =>  $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Gudang',
            "aksi" => 'Mengedit Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function getKurangStok($id){
        date_default_timezone_set('Asia/Jakarta');
        //insert ke tabel history system
        $data2 = [
            "nama_user" =>  $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Gudang',
            "aksi" => 'Mengurangi Stok Gudang',
        ];
        $this->db->insert('history_system',$data2);

        return $this->db->query("UPDATE stok_gudang SET stok = stok-1 WHERE id='$id';");
    }

 
}