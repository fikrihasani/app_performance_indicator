<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __construct(){
		parent::__construct();

		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
        }
	}
    public function index(){
        $this->load->library('mypdf');

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $print = $this->input->post('print');

        if($enddate < $startdate) {
            $msg = ['color' => 'danger', 'message' => 'Tanggal Berakhir tidak valid.'];
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('complains'));
        } 
        else{
            $this->db->select("*");
            $this->db->where('date(time) >=', $startdate); 
            $this->db->where('date(time) <=', $enddate); 
            $query = $this->db->get('complains');
            $data['complain'] = $query->result_array();
            $data['tgl1'] = $startdate;
            $data['tgl2'] = $enddate;

            if($query->num_rows() > 0) {
                if($print == 'excel') {
                    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=Data_Complain.xls");

                    $data['complain'] = $this->db->query("
                                    select b.nama as nama_area, c.nama as nama_subarea, a.complain, a.stakeholder, a.status, a.image, a.id
                                        from complains a
                                        left join area b on a.id_area=b.id
                                        left join subarea c on a.id_subarea=c.id
                                ")->result_array();

                    $this->load->view('complains/export', $data);
                }
                else if($print == 'pdf'){
                    $this->mypdf->generate('complains/dompdf',$data, 'laporan-complain', 'A4');
                }
            }
        }




        
    }

}