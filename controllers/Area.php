<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Area_Model');

        if($this->session->userdata('level') != 1){
            $url=base_url();
            redirect($url);
        }
    }

    public function index(){
        $data['title'] = 'Menu Area';
        $data['area'] = $this->Area_Model-> getAllArea();
        $data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('area/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
    }

    public function in_add(){
        $data['title'] = 'Add Area';
        $data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
        

        // ('nama input','alias','rules')
        $this->form_validation->set_rules('area', 'Area', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('area/add_area');
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/theme');
            $this->load->view('templates/footer');
        }
        else{
            $this->Area_Model->tambahDataArea();

            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Area Berhasil Ditambahkan');
            redirect('area');
        }
    }

    public function hapus($id){
        $this->Area_Model->hapusDataArea($id);
        $this->Area_Model->hapusDataSubArea($id);
        $this->Area_Model->hapusDataPertanyaan($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('area');
    }

    public function ubah($id){
		$data['title'] = 'Edit Area';
        $data['area'] = $this->Area_Model->getAreaById($id);
        $data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('area', 'Area', 'required');
        
		if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('area/edit_area');
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/theme');
            $this->load->view('templates/footer');
		}
		else{
			$this->Area_Model->ubahDataArea();
							// ('nama session', 'isinya apa')
			$this->session->set_flashdata('flash',' Berhasil Diubah');
			redirect('area');
		}
	}
    
}