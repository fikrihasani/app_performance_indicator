<?php

class Absensi_Model extends CI_model{

    public function getAllUser(){
        return $this->db->get('user')->result_array();
    }

    public function Jumlah_Absen($pegawai){
        $query = $this->db->query("select * from absensi a where a.pegawai= '$pegawai'"); 

        return $total = $query->num_rows();
    }

    function getDetailAbsensi($pegawai){
        return $this->db->query("select * from absensi a where a.pegawai= '$pegawai'")->result_array();
    }

    public function getAllAbsensi(){
        return $this->db->query("select * from absensi a ")->result_array();
    }

    public function addData(){
        date_default_timezone_set('Asia/Jakarta');
		$data = [
            "pegawai" => $this->input->post('pegawai',TRUE),
            "jenis" => $this->input->post('jns_pelanggaran',TRUE),
            "keterangan" => $this->input->post('keterangan',TRUE),
            'tanggal' => date("Y-m-d H:i:s", time())
		];
		$this->db->insert('absensi',$data);

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Absensi',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }
    
    public function hapusData($id){
		$this->db->where('id',$id);
		$this->db->delete('absensi');

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Absensi',
            "aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function getAbsenById($id){
		return $this->db->get_where('absensi',['id' => $id])->row_array();
    }
    
    public function ubahData(){
        $data = [
            "pegawai" => $this->input->post('pegawai',TRUE),
            "jenis" => $this->input->post('jns_pelanggaran',TRUE),
            "keterangan" => $this->input->post('keterangan',TRUE),
        ];
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('absensi',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => time(),
            "nama_menu" => 'Absensi',
            "aksi" => 'Mengubah Data',
        ];
        $this->db->insert('history_system',$data2);
    }
    

}