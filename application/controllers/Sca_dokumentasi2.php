<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sca_Dokumentasi2 extends CI_Controller{

    public function __construct(){
		parent::__construct();
        $this->load->model('Sca_Dokumentasi_Model');
        $this->load->model('M_report');
		
		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
        }
    }

    public function index(){
		$data['title'] = 'Menu SCA & Dokumentasi';
		$data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        
		$tes = $this->Sca_Dokumentasi_Model->getAllSca();
		//dumper($tes);
        $data['sca'] = $tes;

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('sca_dokumentasi/index4', $data);
        //$this->load->view('sca_dokumentasi/index3', $sub);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}
	
	function cetakpdf($id){
        $this->load->library('mypdf');

        $bersih=0;
        $kotor=0;
        $n=0;

        $query2 = $this->db->query('select * from sca_dokumentasi where id = '.$id)->row_array();
		$id_sub = $query2['sub_area'];
		$shift = $query2['shift'];
		$tanggal = $query2['time'];
		
		$daftartanya = $this->db->query('select p.id_material, m.standart, m.standart_pertanyaan from pertanyaan p, materials m where p.id_subarea = '.$id_sub.' and p.id_material = m.id ')->result_array();
		
		for($i=0; $i<count($daftartanya); $i++){
			$h = $daftartanya[$i];
			$idm = $h['id_material'];
			$skor = $this->Sca_Dokumentasi_Model->get_nilai($idm, $tanggal);
			if($skor['hasil'] == 1){
				$h['hasil'] = 'Terpenuhi';
			}else{
				$h['hasil'] = "Tidak Terpenuhi";
			}
			
			$h['manpower'] = $skor['id_manpower'];
			$daftartanya[$i] = $h;
		}
		//dumper($daftartanya);
        //foreach($daftartanya() as $rownyalagi) {
         //   foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) {
         //       if($rownyasekalilagi->jawaban == 'Ya') {
          //          $bersih++;
          //      } else {
         //       $kotor++;
         //       }
          //      $n++;
         //    }
       // }

        //$data['terpenuhi'] = $bersih;
        //$data['tdk_terpenuhi'] = $kotor;


        $data['query2'] =  $query2;
        $data['daftartanya'] =  $daftartanya;

        
        $data['sca_dokumentasi'] = $this->db->query("select a.time, a.shift, a.id, a.nilai, a.image, a.user, a.area,
                                                        b.nama as nama_area, c.nama as nama_subarea from sca_dokumentasi a
                                                        left join area b on a.area=b.id
                                                        left join subarea c on a.sub_area = c.id where a.id='$id'")->row_array();

        $this->mypdf->generate('sca_dokumentasi/dompdf3',$data, 'laporan-Sca_Dokumentasi', 'A4');
    }
}