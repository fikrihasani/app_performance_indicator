<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lost_Found extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('LostFound_Model');

		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
		}
		
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 4){
            redirect('profile');
        }
	}

	public function index(){
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['title'] = 'Menu Lost & Found';
		$data['lost_found'] = $this->LostFound_Model->getAllLostFound();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('lost_found/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 4){
            redirect('lost_found');
        }

		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['title'] = 'Add Lost & Found';

		$this->form_validation->set_rules('deskripsi','Deskripsi','required|trim');
		$this->form_validation->set_rules('penemu_pelapor','Penemu / Pelapor','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('lost_found/add_lost_found');
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
                $config['upload_path'] = './assets/upload/lost_found/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $new_image = $this->upload->data('file_name');
                    $this->LostFound_Model->addData($new_image);
				}
				else{
					$this->session->set_flashdata('flash','Gagal ditambahkan, photo tidak sesuai ketentuan');
                    redirect('lost_found/in_add');
				}
			}
			else{
				$foto = '-';
				$this->LostFound_Model->addData($foto);
			}
			
			 $this->session->set_flashdata('flash','Berhasil Ditambahkan');
			 redirect('lost_found');
		}
		
	}

	public function hapus($id){
		if($this->session->userdata('level') != 1){
            redirect('lost_found');
		}
		
        $this->LostFound_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('lost_found');
	}

	public function ubah($id){
		if($this->session->userdata('level') != 1){
            redirect('lost_found');
		}

		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['lost_found'] = $this->LostFound_Model->getLostFoundById($id);
		$data['title'] = 'Edit Lost & Found';
		$data['status'] = ['Belum Selesai','Selesai'];
		$data['jns_laporan'] = ['Kehilangan','Penemuan'];

		$this->form_validation->set_rules('deskripsi','Deskripsi','required|trim');
		$this->form_validation->set_rules('penemu_pelapor','Penemu / Pelapor','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('lost_found/edit_lost_found');
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}
		else{
			$upload_image = $_FILES['image']['name'];
          
			if($upload_image){
			   $config['allowed_types'] = 'gif|jpg|png';
			   $config['max_size']    = 700;
			   $config['upload_path'] = './assets/upload/lost_found/';

			   $this->load->library('upload', $config);

			   if($this->upload->do_upload('image')){
				   // Ngecek gambar lama
				   $old_image = $data['lost_found']['image'];
				   if($old_image != 'default.png'){
					   unlink(FCPATH .  'assets/upload/lost_found/' . $old_image);
				   }

				   $new_image = $this->upload->data('file_name');
				   $this->LostFound_Model->ubahData($new_image);
			   }
			   else{
				   $this->session->set_flashdata('flash','Gagal Diupdate, photo tidak sesuai ketentuan');
				   redirect('complains');
			   }
			}
			else{
			   $new_image = '-';
			   $this->LostFound_Model->ubahData($new_image);
			}

			$this->session->set_flashdata('flash','Berhasil Diupdate');
			redirect('lost_found');
		}
	}

	function cetak(){
		if($this->session->userdata('level')!=1){
            redirect('lost_found');
		}
		$this->load->library('mypdf');

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $print = $this->input->post('print');

        if($enddate < $startdate) {
            $msg = ['color' => 'danger', 'message' => 'Tanggal Berakhir tidak valid.'];
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('lost_found'));
        } 
        else{
            $this->db->select("*");
            $this->db->where('date(tanggal1) >=', $startdate); 
            $this->db->where('date(tanggal1) <=', $enddate); 
            $query = $this->db->get('lost_found');
            $data['lost_found'] = $query->result_array();
            $data['tgl1'] = $startdate;
            $data['tgl2'] = $enddate;

            if($query->num_rows() > 0) {
                if($print == 'excel') {
                    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=Data_Lost_Found.xls");

                    $data['lost_found'] =$this->db->query("select * from absensi")->result_array();

                    $this->load->view('lost_found/export', $data);
                }
                else if($print == 'pdf'){
                    $this->mypdf->generate('lost_found/dompdf',$data, 'laporan-Lost_And_Found', 'A4');
                }
            }
        }
	}


}
