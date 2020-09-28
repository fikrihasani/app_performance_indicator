<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Gudang_Model');

		$level = $this->session->userdata('level');
		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
		}
		
		if($level == 3|| $level == 2){
            redirect('profile');
        }
	}

	public function index(){
		$data['title'] = 'Menu Gudang';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['gudang'] = $this->Gudang_Model->getAllGudang();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('gudang/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		if($this->session->userdata('level') == 2|| $this->session->userdata('level') == 3){
            redirect('profile');
        }

		$data['title'] = 'Add Stok Gudang';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->load->model('Absensi_Model');
		$data['user2'] = $this->Absensi_Model->getAllUser();

		$this->form_validation->set_rules('nama_barang','Nama Barang','required|trim');
		$this->form_validation->set_rules('stok_barang','Stok Barang','required|trim|numeric');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('gudang/add_gudang');
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
                $config['upload_path'] = './assets/upload/gudang/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $new_image = $this->upload->data('file_name');
                    $this->Gudang_Model->addData($new_image);
				}
				else{
					$this->session->set_flashdata('flash','Gagal ditambahkan, photo tidak sesuai ketentuan');
                    redirect('gudang/in_add');
				}
			}
			else{
				$foto = '-';
				$this->Gudang_Model->addData($foto);
			}
			
			 $this->session->set_flashdata('flash','Berhasil Ditambahkan');
			 redirect('gudang');
		}
	}

	public function hapus($id){
		if($this->session->userdata('level')!=1){
            redirect('gudang');
		}
		
        $this->Gudang_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('gudang');
	}

	public function ubah($id){
		if($this->session->userdata('level')!=1){
            redirect('gudang');
		}

		$data['title'] = 'Add Stok Gudang';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['gudang'] = $this->Gudang_Model->getGudangById($id);

		$this->load->model('Absensi_Model');
		$data['user2'] = $this->Absensi_Model->getAllUser();

		$this->form_validation->set_rules('nama_barang','Nama Barang','required|trim');
		$this->form_validation->set_rules('stok_barang','Stok Barang','required|trim|numeric');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('gudang/edit_gudang',$data);
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
                $config['upload_path'] = './assets/upload/gudang/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    // Ngecek gambar lama
                    $old_image = $data['gudang']['image'];
                    if($old_image != 'default.png'){
                        unlink(FCPATH .  'assets/upload/gudang/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->Gudang_Model->ubahData($new_image);
                }
                else{
                    $this->session->set_flashdata('flash','Gagal Diupdate, photo tidak sesuai ketentuan');
                    redirect('gudang');
                }
             }
             else{
				$new_image = '-';
                $this->Gudang_Model->ubahData($new_image);
             }

             $this->session->set_flashdata('flash','Berhasil Diupdate');
             redirect('gudang');
		}
	}
	
	public function kurangStok($id){
		date_default_timezone_set('Asia/Jakarta');
		$data['stok']  = $this->Gudang_Model->getKurangStok($id);
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$gudang = $this->db->get_where('stok_gudang', ['id' => $id])->row_array();

		 $data2 = [
			"id_barang" =>  $gudang['nama_barang'],
			"stok" =>  $gudang['stok'],
            "pengambil" => $this->session->userdata('nama'),
            "time" => date("Y-m-d H:i:s", time())
		];
		$this->db->insert('history_barang',$data2);
							
		$this->session->set_flashdata('flash',' Berhasil Dikurangi');
		redirect('gudang');
	}

	public function in_history(){
		$data['title'] = 'History Pengambilan Barang';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['gudang'] = $this->db->query('select * from history_barang')->result_array();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('gudang/history_pengambilan',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/theme');
		$this->load->view('templates/footer');	
	}

	function cetak(){
		if($this->session->userdata('level')!=1){
            redirect('gudang');
		}
		$this->load->library('mypdf');

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $print = $this->input->post('print');

        if($enddate < $startdate) {
            $msg = ['color' => 'danger', 'message' => 'Tanggal Berakhir tidak valid.'];
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('gudang'));
        } 
        else{
            $this->db->select("*");
            $this->db->where('date(time) >=', $startdate); 
            $this->db->where('date(time) <=', $enddate); 
            $query =  $this->db->query("select * from stok_gudang");
            $data['stok_gudang'] = $query->result_array();
            $data['tgl1'] = $startdate;
            $data['tgl2'] = $enddate;

            if($query->num_rows() > 0) {
                if($print == 'excel') {
                    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=Data_Gudang.xls");

                    $data['stok_gudang'] = $this->db->query("select * from stok_gudang")->result_array();

                    $this->load->view('gudang/export', $data);
                }
                else if($print == 'pdf'){
                    $this->mypdf->generate('gudang/dompdf',$data, 'laporan-gudang', 'A4');
                }
            }
        }
	}



}
