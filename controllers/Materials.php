<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materials extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Materials_Model');

		if($this->session->userdata('level') != 1){
            $url=base_url();
            redirect($url);
        }
	}

	public function index(){
		$data['title'] = 'Menu Materials';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['materials'] = $this->Materials_Model->getAllMaterials();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('materials/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		$data['title'] = 'Add Materials';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		// include model
		$this->load->model('Area_Model');
		$this->load->model('Subarea_Model');
		
		$data['area'] = $this->Area_Model->getAllArea();
		$data['subarea'] = $this->Subarea_Model->getSubarea();

		$this->form_validation->set_rules('standart','Nama Material','required|trim');
		$this->form_validation->set_rules('standart_pertanyaan','Standart','required|trim');

		if($this->form_validation->run()==FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('materials/add_materials',$data);
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}else{
			//  Cek jika ada gambar yang ingin di upload
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/materials/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $new_image = $this->upload->data('file_name');
                    $this->Materials_Model->addData($new_image);
				}
				else{
					$this->session->set_flashdata('flash','Gagal ditambahkan, photo tidak sesuai ketentuan');
                    redirect('materials/in_add');
				}
			}
			else{
				$foto = '-';
				$this->Materials_Model->addData($foto);
			}
			
			 $this->session->set_flashdata('flash','Berhasil Ditambahkan');
			 redirect('materials');
		}
		
	}

	public function hapus($id){
        $this->Materials_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('materials');
	}

	public function ubah($id){
		$data['title'] = 'Edit Materials';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['materials'] = $this->Materials_Model->getMaterialsById($id);

		// include model
		$this->load->model('Area_Model');
		$this->load->model('Subarea_Model');
		
		$data['area'] = $this->Area_Model->getAllArea();
		$data['subarea'] = $this->Subarea_Model->getSubarea();

		
		$this->form_validation->set_rules('standart','Nama Material','required|trim');
		$this->form_validation->set_rules('standart_pertanyaan','Standart','required|trim');

		if($this->form_validation->run()==FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('materials/edit_materials',$data);
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}else{
			//  Cek jika ada gambar yang ingin di upload
            $upload_image = $_FILES['image']['name'];
          
             if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/materials/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    // Ngecek gambar lama
                    $old_image = $data['materials']['image'];
                    if($old_image != 'default.png'){
                        unlink(FCPATH .  'assets/upload/materials/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->Materials_Model->ubahData($new_image);
                }
                else{
                    $this->session->set_flashdata('flash','Gagal Diupdate, photo tidak sesuai ketentuan');
                    redirect('materials');
                }
             }
             else{
				$new_image = '-';
                $this->Materials_Model->ubahData($new_image);
             }

             $this->session->set_flashdata('flash','Berhasil Diupdate');
             redirect('materials');
		}

	}




}
