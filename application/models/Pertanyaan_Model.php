<?php

class Pertanyaan_Model extends CI_Model{

    // public function getAllPertanyaan(){
    //     return $this->db->query("
    //         select a.id,  a.pertanyaan, b.nama as area, c.nama as subarea, d.standart as nama_material 
    //                 from pertanyaan a
    //                 left join area b on b.id=a.id_area
    //                 left join subarea c on c.id=a.id_subarea
    //                 left join materials d on d.id=a.id_material
    //     ")->result_array();
    // }

    public function getAllPertanyaan(){
        return $this->db->query("
            select a.id, a.id_subarea, b.nama as area, c.nama as subarea, d.standart as nama_material 
                    from pertanyaan a
                    left join area b on b.id=a.id_area
                    left join subarea c on c.id=a.id_subarea
                    left join materials d on d.id=a.id_material group by c.nama
        ")->result_array();
    }

    public function getAllSca($id){
        return $this->db->query("
            select * from pertanyaan where id_area = '$id'
        ")->result_array();
    }


    public function addData(){
        date_default_timezone_set('Asia/Jakarta');
        // $data = [
        //     "id_area" => $this->input->post('area',TRUE),
        //     "id_subarea" => $this->input->post('subarea',TRUE),
        //     "id_material" => $this->input->post('material',TRUE),
        //     "pertanyaan" => $this->input->post('pertanyaan',TRUE),
        //     'time' => date("Y-m-d H:i:s", time())
        // ];
        // $this->db->insert('pertanyaan',$data);

        $post = $this->input->post();
        $item = $post['item'];
        $n = 0;
        foreach($item as $v) {
            if($v['jawaban'] == 'Ya') {
                $data[$n] = [
                    "id_area" => $this->input->post('id_area',TRUE),
                    "id_subarea" => $this->input->post('id_subarea',TRUE),
                    "id_material" => $v['id']
                ];      
                $this->db->insert('pertanyaan',$data[$n]);
            }
            $n++;
          }
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Pertanyaan',
            "aksi" => 'Menambah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function hapusData($id){
        date_default_timezone_set('Asia/Jakarta');
		$this->db->where('id_subarea',$id);
		$this->db->delete('pertanyaan');

		//insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Pertanyaan',
            "aksi" => 'Menghapus Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    public function getPertanyaanById($id){
		return $this->db->get_where('pertanyaan',['id' => $id])->row_array();
    }

    public function ubahData(){
        date_default_timezone_set('Asia/Jakarta');
        $post = $this->input->post();
        $item = $post['item'];

        $subarea = $this->input->post('id_subarea',TRUE);
        //$pertanyaan = $this->db->query("select * from")
        
        foreach($item as $v) {
            if($v['jawaban'] == 'Ya') {
                $k = $v['id'];
                $cek = $this->db->query("select * from pertanyaan where id_subarea='$subarea' and id_material='$k'")->num_rows();
            
                if($cek==0){
                    $data = [
                        "id_area" => $this->input->post('id_area'),
                        "id_subarea" => $this->input->post('id_subarea',TRUE),
                        "id_material" => $k
                    ];
                    $this->db->insert('pertanyaan',$data);
                }
            }
            
            if($v['jawaban'] == 'Tidak'){
                $k = $v['id'];
                //$cek = $this->db->query("select * from pertanyaan where id_subarea='$subarea' and id_material='$k'")->num_rows();
                $cek_id = $this->db->query("select id from pertanyaan where id_subarea='$subarea' and id_material='$k' ")->row_array();
           
                
                    if($cek_id>0){
                        $this->db->where('id',$cek_id['id']);
		                $this->db->delete('pertanyaan');
                    }
                           
            }

          }


        // $data = [
        //     "id_area" => $this->input->post('area',TRUE),
        //     "id_subarea" => $this->input->post('subarea',TRUE),
        //     "id_material" => $this->input->post('material',TRUE),
        // ];
        // $this->db->where('id', $this->input->post('id'));
        // $this->db->update('pertanyaan',$data);
        
        //insert ke tabel history system
        $data2 = [
            "nama_user" => $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time()),
            "nama_menu" => 'Pertanyaan',
            "aksi" => 'Mengubah Data',
        ];
        $this->db->insert('history_system',$data2);
    }

    // Tambahan broh
    function get_subarea($id){
        $hasil=$this->db->query("SELECT * FROM subarea WHERE id_area='$id'");
        return $hasil->result();
    }

    function get_question()
    {
        $hasil = $this->db->query("SELECT * FROM materials");
        return $hasil->result();
    }

}