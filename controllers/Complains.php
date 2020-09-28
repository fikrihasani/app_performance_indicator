<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complains extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Complain_Model');

		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
        }
	}

	public function index(){
		$data['title'] = 'Menu Complains';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['complain'] = $this->Complain_Model-> getAllComplain();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('complains/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 4 ){
            redirect('complains');
        }

		$data['title'] = 'Add Complains';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		// include model
		$this->load->model('Area_Model');
		$data['area'] = $this->Area_Model->getAllArea();

		$this->form_validation->set_rules('complain','Complain','required|trim');
		$this->form_validation->set_rules('stakeholder','Stakeholder','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('complains/add_complains');
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}else{
			//  Cek jika ada gambar yang ingin di upload
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/complain/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $new_image = $this->upload->data('file_name');
                    $this->Complain_Model->addData($new_image);
				}
				else{
					$this->session->set_flashdata('flash','Gagal ditambahkan, photo tidak sesuai ketentuan');
                    redirect('complains/in_add');
				}
			}
			else{
				$foto = '-';
				$this->Complain_Model->addData($foto);
			}
			
			 $this->session->set_flashdata('flash','Complain Berhasil Ditambahkan');
			 redirect('complains');
		}
	}

	public function ambil_data(){
		$modul=$this->input->post('modul');
		$id=$this->input->post('id');

		// include model
		$this->load->model('Subarea_Model');
		if($modul=="subarea"){
            echo $this->Subarea_Model->subarea($id);
        }
        else if($modul=="material"){
            echo $this->Subarea_Model->material($id);
        }
	}

	public function hapus($id){
		if($this->session->userdata('level') != 1){
            redirect('complains');
        }

        $this->Complain_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('complains');
	}
	
	public function ubah($id){
		if($this->session->userdata('level') != 1){
            redirect('complains');
        }

		// include model
		$this->load->model('Area_Model');
		$this->load->model('Subarea_Model');

		$data['title'] = 'Edit Complain';
		$data['area'] = $this->Area_Model->getAllArea();
		$data['complain'] = $this->Complain_Model->getComplainById($id);
		$data['status'] = ['Belum Selesai','Selesai'];
		$data['subarea'] = $this->Subarea_Model->getSubarea();
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('complain', 'Complain', 'required|trim');
		$this->form_validation->set_rules('stakeholder', 'Stakeholder', 'required|trim');

		if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('complains/edit_complains');
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/theme');
            $this->load->view('templates/footer');
		}
		else{
			// $email = $this->input->post('email');
            // $name = $this->input->post('nama',TRUE);
            
            //  Cek jika ada gambar yang ingin di upload
            $upload_image = $_FILES['image']['name'];
          
             if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/complain/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    // Ngecek gambar lama
                    $old_image = $data['complain']['image'];
                    if($old_image != 'default.png'){
                        unlink(FCPATH .  'assets/upload/complain/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->Complain_Model->ubahData($new_image);
                }
                else{
                    $this->session->set_flashdata('flash','Gagal Diupdate, photo tidak sesuai ketentuan');
                    redirect('complains');
                }
             }
             else{
				$new_image = '-';
                $this->Complain_Model->ubahData($new_image);
             }

             $this->session->set_flashdata('flash','Berhasil Diupdate');
             redirect('complains');
		}
	}

	function cetak(){
        if($this->session->userdata('level')!=1){
            redirect('complains');
		}

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
