<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertanyaan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Pertanyaan_Model');

		if($this->session->userdata('level') != 1){
            $url=base_url();
            redirect($url);
        }
	}

	public function index(){
		$data['title'] = 'Menu Pertanyaan';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['pertanyaan'] = $this->Pertanyaan_Model->getAllPertanyaan();

		$this->load->model('Area_Model');
		$data['area'] = $this->Area_Model->getAllArea();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('pertanyaan/index');
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		$data['title'] = 'Add Pertanyaan';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		// include model
		$this->load->model('Area_Model');
		$this->load->model('Subarea_Model');

		$data['area'] = $this->Area_Model->getAllArea();
		$data['subarea'] = $this->Subarea_Model->getSubarea();


		$this->form_validation->set_rules('id_subarea','Sub Area','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('pertanyaan/add_pertanyaan');
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}
		else{

			$sub_area = $this->input->post('id_subarea');
			$cek_data = $this->db->query("select * from pertanyaan where id_subarea='$sub_area'")->num_rows();

			if($cek_data>0){
				$this->session->set_flashdata('danger', 'Data sudah ada!');
				redirect('pertanyaan/in_add');
			}
			else{
				$this->Pertanyaan_Model->addData();
			}
			 // ('nama session', 'isinya apa')
			 $this->session->set_flashdata('flash','Berhasil Ditambahkan');
			 redirect('pertanyaan');
		}
	}

	public function hapus($id){
        $this->Pertanyaan_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('pertanyaan');
	}

	public function ubah($id){
		$data['title'] = 'Edit Pertanyaan';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['pertanyaan'] = $this->Pertanyaan_Model->getPertanyaanById($id);
		$data['tanya'] = $this->Pertanyaan_Model->get_question();

		// include model
		$this->load->model('Area_Model');
		$this->load->model('Subarea_Model');
		$this->load->model('Materials_Model');

		$data['area'] = $this->Area_Model->getAllArea();
		$data['subarea'] = $this->Subarea_Model->getSubarea();
		$data['material'] = $this->Materials_Model->getAllMaterials();

		$this->form_validation->set_rules('id_area','Sub Area','required|trim');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('pertanyaan/edit_pertanyaan',$data);
			$this->load->view('templates/layout_footer');
			$this->load->view('templates/theme');
			$this->load->view('templates/footer');
		}
		else{
			$this->Pertanyaan_Model->ubahData();
			 // ('nama session', 'isinya apa')
			 $this->session->set_flashdata('flash','Berhasil Diubah');
			 redirect('pertanyaan');
		}
	}

	function get_subarea(){
		$id=$this->input->post('id');
        if($id == 99) {
            $data = '';
        } else {
            $data=$this->Pertanyaan_Model->get_subarea($id);
        }
		echo json_encode($data);
    }

	function cetak(){
        if($this->session->userdata('level')!=1){
            redirect('pertanyaan');
		}

		$this->load->library('mypdf');

		$area = $this->input->post('sca'); 
    	$query =$this->db->query("select * from pertanyaan where id_area='$area'");
		$data['pertanyaan'] = $this->db->query("select a.id, a.id_area, a.id_subarea, a.id_material, b.standart,b.standart_pertanyaan
													from pertanyaan a left join materials b on a.id_material=b.id 
														where a.id_area='$area'")->result_array();
		$data['area'] = $this->db->query("select * from area where area.id='$area'")->result_array();
		$data['jmlh_area'] = $this->db->query("select * from area where area.id='$area'")->num_rows();

        if($query->num_rows() > 0) {
            $this->mypdf->generate('pertanyaan/dompdf',$data, 'laporan-sca', 'A4','landscape');      
        }
	}

	// Tambahan
	function get_question2(){
        $id=$this->input->post('id');
    
        echo '<div class="table-responsive">';
        echo '<table class="table table-hover" width="100%" cellspacing="0">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Standart</th>';
        echo '<th>Ya</th>';
        echo '<th>Tidak</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $tanya = $this->Pertanyaan_Model->get_question($id);
        $n = 1;
        foreach($tanya as $row) {
                echo '<tr>';
                echo '<td>'.$n++.'</td>';
                echo '<td>'.$row->standart.'</td>';
                echo '<input type="hidden" class="form-control" name="item['.$n.'][id]" value="'.$row->id.'">';
                echo '<td><input type="radio" name="item['.$n.'][jawaban]" value="Ya" required></td>';
                echo '<td><input type="radio" name="item['.$n.'][jawaban]" value="Tidak"></td>';
                echo '</tr>';
            }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
	}
	
	function get_question(){
		$id=$this->input->post('id');
		$tanya = $this->Pertanyaan_Model->get_question();

			  echo '<div class="row gutter-xs">';
        	  echo '<div class="col-xs-12">';
              echo'<div class="card">';
			  echo'<div class="card-header">';
			  echo'<div class="card-actions">';
			  echo'<button type="button" class="card-action card-toggler" title="Collapse"></button>';
			  echo'<button type="button" class="card-action card-reload" title="Reload"></button>';
			  echo'<button type="button" class="card-action card-remove" title="Remove"></button>';
			  echo' </div>';
			  echo'<strong>Daftar Material</strong>';
			  echo'</div>';
			  echo' <div class="card-body">';
			  echo' <table id="demo-datatables-colreorder-2" class="table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%">';
			  echo' <thead>';
			  echo '<tr>';
			  echo '<th>No</th>';
			  echo '<th width="120">Nama Material</th>';
			  echo '<th>Standart</th>';
			  echo '<th width="30">Ya</th>';
			  echo '<th>Tidak</th>';
			  echo '</tr>';
			  echo' </thead>';
			  echo'<tfoot>';
			  echo '<tr>';
			  echo '<th>ID</th>';
			  echo '<th>Nama Material</th>';
			  echo '<th>Standart</th>';
			  echo '<th>Ya</th>';
			  echo '<th>Tidak</th>';
			  echo '</tr>';
			  echo' </tfoot>';
			  echo' <tbody>';
			  $n = 1;
			  foreach($tanya as $row) {
                echo '<tr>';
                echo '<td>'.$n++.'</td>';
				echo '<td>'.$row->standart.'</td>';
				echo '<td>'.$row->standart_pertanyaan.'</td>';
                echo '<input type="hidden" class="form-control" name="item['.$n.'][id]" value="'.$row->id.'">';
                echo '<td><input type="radio" name="item['.$n.'][jawaban]" value="Ya"></td>';
                echo '<td><input type="radio" name="item['.$n.'][jawaban]" value="Tidak"></td>';
                echo '</tr>';
            }
			  echo' </tbody>';
			  echo' </table>';
              echo'  </div>';
			  echo'   </div>';
			  echo' </div>';
			  echo' </div>';
	}

}
