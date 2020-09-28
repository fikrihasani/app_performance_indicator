<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subarea extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Subarea_Model');

		if($this->session->userdata('level') != 1){
            $url=base_url();
            redirect($url);
        }
	}

	public function index(){
		$data['title'] = 'Menu Sub Area';
		$data['subarea'] = $this->Subarea_Model->getSubarea();
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('sub_area/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		// include model
		$this->load->model('Area_Model');

		$data['title'] = 'Add Sub Area';
		$data['area'] = $this->Area_Model->getAllArea();
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nama','Sub Area','required');
		$this->form_validation->set_rules('nfc','NFC','required');

		if($this->form_validation->run()== FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('sub_area/add_subarea');
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}
		else{
			$this->Subarea_Model->tambahData();

			$this->session->set_flashdata('flash','Sub Area Berhasil Ditambahkan');
			redirect('subarea');
		}
		
	}

	public function hapus($id){
		$this->Subarea_Model->hapusData($id);
		$this->Subarea_Model->hapusDataPertanyaan($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('subarea');
	}

	public function ubah($id){
		// include model
		$this->load->model('Area_Model');

		$data['title'] = 'Edit Sub Area';
		$data['area'] = $this->Area_Model->getAllArea();
		$data['subarea'] = $this->Subarea_Model->getSubAreaById($id);
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nama', 'Sub Area', 'required');
		$this->form_validation->set_rules('nfc','NFC','required');

		if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('sub_area/edit_subarea');
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/theme');
            $this->load->view('templates/footer');
		}
		else{
			$this->Subarea_Model->ubahDataSubarea();
							// ('nama session', 'isinya apa')
			$this->session->set_flashdata('flash',' Berhasil Diubah');
			redirect('subarea');
		}
	}


}
