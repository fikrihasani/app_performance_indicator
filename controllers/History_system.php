<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_System extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		if($this->session->userdata('level') != 1){
            $url=base_url();
            redirect($url);
        }

	}

	public function index(){
		$data['title'] = 'Menu Gudang';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['hs'] = $this->db->get('history_system')->result_array();


		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('history_system/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}


}
