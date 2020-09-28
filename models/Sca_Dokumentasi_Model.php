<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sca_Dokumentasi_Model extends CI_Model {

  public function getAllSca(){
    return $this->db->query("
        select b.nama as area, c.nama as subarea, a.shift, a.nilai, a.user, a.id, a.time, a.image
            from sca_dokumentasi a
            left join area b on a.area=b.id
            left join subarea c on a.sub_area=c.id order by a.id desc
    ");
  } 

    function get_question($id)
    {
        $hasil = $this->db->query("SELECT * FROM pertanyaan WHERE id_subarea = '$id' ");
        return $hasil->result();
    }

    function get_subarea($id){
      $hasil=$this->db->query("SELECT * FROM subarea WHERE id_area='$id'");
      return $hasil->result();
    }

    public function save($foto){
      date_default_timezone_set('Asia/Jakarta');

      $jml=0;
      $n=0;

      $post = $this->input->post();
      $item = $post['item'];

      foreach($item as $v) {
        $jml++;
        if($v['jawaban'] == 'Ya') {
            $n++;
        }
      }

      $nilai = ($n/$jml)*100;

        $data = [
          "time" => date("Y-m-d H:i:s", time()),
          "shift" => $this->input->post('shift',TRUE),
          "area" => $this->input->post('id_area',TRUE),
          "sub_area" => $this->input->post('id_subarea',TRUE),
          "nilai" => $nilai,
          "user" => $this->session->userdata('nama'),
          "image" => $foto
        ];
        $this->db->insert('sca_dokumentasi',$data);

        //insert ke tabel history system
        $data2 = [
          "nama_user" =>  $this->session->userdata('nama'),
          "time" => time(),
          "nama_menu" => 'Sca & Dokumentasi',
          "aksi" => 'Menambah Data',
      ];
      $this->db->insert('history_system',$data2);
    }

    public function save_result(){
        date_default_timezone_set("Asia/Jakarta");
        $post = $this->input->post();
        $query = $this->db->query("select * from sca_dokumentasi order by id desc limit 1")->row();
        $id_sca = $query->id;
        $item = $post['item'];
        $result = array();
        foreach($item as $itemnya) {
            $result[] = $itemnya;
        }
        $zresult = json_encode($result);
        $this->db->insert('sca_result', array('id_sca' => $id_sca, 'result' => $zresult));
    }

    public function hapusData1($id){
      
      $this->db->where('id',$id);
        $query = $this->db->get('sca_dokumentasi');
        $row = $query->row();
        
        if($row->image != '-'){
            unlink("./assets/upload/sca/$row->image");
        }
   
        $this->db->delete('sca_dokumentasi', array('id' => $id));

      $akun = $this->session->userdata('nama');
    
      //insert ke tabel history system
          $data2 = [
              "nama_user" => $this->session->userdata('nama'),
              "time" => time(),
              "nama_menu" => 'SCA & Dokumentasi',
              "aksi" => 'Menghapus Data',
          ];
          $this->db->insert('history_system',$data2);
    }

    public function hapusData2($id){
      $this->db->where('id_sca',$id);
      $query = $this->db->get('sca_result');
      $row = $query->row();

      $this->db->delete('sca_result', array('id_sca' => $id));
  }
}