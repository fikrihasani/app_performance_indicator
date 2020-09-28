<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Absensi_Model');

		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
		}
		
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 4){
            redirect('profile');
        }
	}

	public function index(){
		$data['title'] = 'Menu Absensi';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['absensi'] = $this->Absensi_Model->getAllAbsensi();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('absensi/index');
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 4){
            redirect('absensi');
        }

		$data['title'] = 'Add Absensi';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['user2'] = $this->Absensi_Model->getAllUser();

		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('absensi/add_absensi');
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}else{
			$this->Absensi_Model->addData();
							// ('nama session', 'isinya apa')
			$this->session->set_flashdata('flash',' Berhasil Ditambahkan');
			redirect('absensi');
		}
	}

	public function hapus($id){
		if($this->session->userdata('level') != 1){
            redirect('absensi');
        }

        $this->Absensi_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('absensi');
	}
	
	public function ubah($id){
		if($this->session->userdata('level') != 1){
            redirect('absensi');
        }

		$data['title'] = 'Edit Absensi';
		$data['jns_pelanggaran'] = ['Terlambat','Mangkir'];
		$data['absensi'] = $this->Absensi_Model->getAbsenById($id);
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['user2'] = $this->Absensi_Model->getAllUser();

		$this->form_validation->set_rules('keterangan','Keterangan','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('absensi/edit_absensi',$data);
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}else{
			$this->Absensi_Model->ubahData();
							// ('nama session', 'isinya apa')
			$this->session->set_flashdata('flash',' Berhasil Diubah');
			redirect('absensi');
		}
	}

	public function detail(){
		$nama = $this->input->get('nama');

		$data['title'] = 'Detail Absensi';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['absensi'] = $this->Absensi_Model->getDetailAbsensi($nama);
		$data['jumlah_absensi'] = $this->Absensi_Model->Jumlah_Absen($nama);

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('absensi/detail_absen',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	function cetak(){
		if($this->session->userdata('level')!=1){
            redirect('absensi');
		}
		$this->load->library('mypdf');

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $print = $this->input->post('print');

        if($enddate < $startdate) {
            $msg = ['color' => 'danger', 'message' => 'Tanggal Berakhir tidak valid.'];
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('absensi'));
        } 
        else{
            $this->db->select("*");
            $this->db->where('date(tanggal) >=', $startdate); 
			$this->db->where('date(tanggal) <=', $enddate); 
            $query = $this->db->get('absensi');

            $data['absensi'] = $query->result_array();
            $data['tgl1'] = $startdate;
            $data['tgl2'] = $enddate;

            if($query->num_rows() > 0) {
                if($print == 'excel') {
                    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=Data_Data_Absen_Mangkir.xls");

                    $data['absensi'] = $this->db->query("select * from absensi")->result_array();;

                    $this->load->view('absensi/export', $data);
                }
                else if($print == 'pdf'){
                    $this->mypdf->generate('absensi/dompdf',$data, 'laporan-Data_Absen_Mangkir', 'A4');
                }
            }
        }
	}

}
