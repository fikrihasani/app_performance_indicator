<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerusakan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Kerusakan_Model');

		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
        }
	}

	public function index(){
        if($this->session->userdata('level') == 4){
            redirect('profile');
        }

		$data['title'] = 'Menu Kerusakan';
		$data['kerusakan'] = $this->Kerusakan_Model->getAllKerusakan();
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kerusakan/index');
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 4){
            redirect('kerusakan');
        }

		$data['title'] = 'Add Kerusakan';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		// include model
		$this->load->model('Area_Model');
		$this->load->model('Subarea_Model');

		$data['area'] = $this->Area_Model->getAllArea();
		$data['subarea'] = $this->Subarea_Model->getSubarea();

		$this->form_validation->set_rules('kerusakan','Kerusakan','required|trim');
		$this->form_validation->set_rules('follow_up','Follow Up','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('kerusakan/add_kerusakan');
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}
		else{
			//  Cek jika ada gambar yang ingin di upload
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/kerusakan/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $new_image = $this->upload->data('file_name');
                    $this->Kerusakan_Model->addData($new_image);
				}
				else{
					$this->session->set_flashdata('flash','Gagal ditambahkan, photo tidak sesuai ketentuan');
                    redirect('kerusakan/in_add');
				}
			}
			else{
				$foto = '-';
				$this->Kerusakan_Model->addData($foto);
			}
			
			 $this->session->set_flashdata('flash','Berhasil Ditambahkan');
			 redirect('kerusakan');
		}
	}

	public function hapus($id){
		if($this->session->userdata('level') != 1){
            redirect('kerusakan');
        }

        $this->Kerusakan_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('kerusakan');
	}
	
	public function ubah($id){
		if($this->session->userdata('level') != 1){
            redirect('kerusakan');
        }

		$data['title'] = 'Edit Kerusakan';
		$data['kerusakan'] = $this->Kerusakan_Model->getKerusakanById($id);
		$data['status'] = ['Belum Selesai','Selesai'];
        $data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		// include model
		$this->load->model('Area_Model');
		$this->load->model('Subarea_Model');
		
		$data['area'] = $this->Area_Model->getAllArea();
		$data['subarea'] = $this->Subarea_Model->getSubarea();

        $this->form_validation->set_rules('kerusakan','Kerusakan','required|trim');
		$this->form_validation->set_rules('follow_up','Follow Up','required|trim');
        
		if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('kerusakan/edit_kerusakan');
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/theme');
            $this->load->view('templates/footer');
		}
		else{
            //  Cek jika ada gambar yang ingin di upload
            $upload_image = $_FILES['image']['name'];
          
             if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/kerusakan/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    // Ngecek gambar lama
                    $old_image = $data['kerusakan']['image'];
                    if($old_image != 'default.png'){
                        unlink(FCPATH .  'assets/upload/kerusakan/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->Kerusakan_Model->ubahData($new_image);
                }
                else{
                    $this->session->set_flashdata('flash','Gagal Diupdate, photo tidak sesuai ketentuan');
                    redirect('kerusakan');
                }
             }
             else{
				$new_image = '-';
                $this->Kerusakan_Model->ubahData($new_image);
             }

             $this->session->set_flashdata('flash','Berhasil Diupdate');
             redirect('kerusakan');
		}
	}

	function cetak(){
        if($this->session->userdata('level')!=1){
            redirect('kerusakan');
		}
		$this->load->library('mypdf');

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $print = $this->input->post('print');

        if($enddate < $startdate) {
            $msg = ['color' => 'danger', 'message' => 'Tanggal Berakhir tidak valid.'];
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('kerusakan'));
        } 
        else{
            $this->db->select("*");
            $this->db->where('date(time) >=', $startdate); 
            $this->db->where('date(time) <=', $enddate); 
            $query = $this->db->get('kerusakan');
            $data['kerusakan'] = $query->result_array();
            $data['tgl1'] = $startdate;
            $data['tgl2'] = $enddate;

            if($query->num_rows() > 0) {
                if($print == 'excel') {
                    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=Data_Kerusakan.xls");

                    $data['kerusakan'] = $this->db->query(" select a.id,  a.kerusakan, a.follow_up, a.status, a.image,
											b.nama as nama_area, c.nama as nama_subarea 
												from kerusakan a
												left join area b on b.id=a.id_area
												left join subarea c on c.id=a.id_subarea
									")->result_array();

                    $this->load->view('kerusakan/export', $data);
                }
                else if($print == 'pdf'){
                    $this->mypdf->generate('kerusakan/dompdf',$data, 'laporan-kerusakan', 'A4');
                }
            }
        }
	}
}