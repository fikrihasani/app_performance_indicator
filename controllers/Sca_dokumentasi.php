<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sca_Dokumentasi extends CI_Controller{

    public function __construct(){
		parent::__construct();
        $this->load->model('Sca_Dokumentasi_Model');
		
		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
        }
    }

    public function index(){
		$data['title'] = 'Menu SCA & Dokumentasi';
		$data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        
        $data['sca_dokumentasi'] = $this->Sca_Dokumentasi_Model->getAllSca()->result_array();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('sca_dokumentasi/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
	}

	public function in_add(){
		if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 4){
            redirect('sca_dokumentasi');
        }

		$data['title'] = 'Add Sca Dokumentasi';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		// include model
		$this->load->model('Area_Model');
        $data['area'] = $this->Area_Model->getAllArea();
        
        $this->form_validation->set_rules('shift','Shift','required');

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('sca_dokumentasi/add_sca_dokumentasi');
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
                $config['upload_path'] = './assets/upload/sca/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $new_image = $this->upload->data('file_name');
                    $this->Sca_Dokumentasi_Model->save($new_image);
                    $this->Sca_Dokumentasi_Model->save_result();
				}
				else{
					$this->session->set_flashdata('flash','Gagal ditambahkan, photo tidak sesuai ketentuan');
                    redirect('sca_dokumentasi/in_add');
				}
            }
            else{
				$foto = '-';
                $this->Sca_Dokumentasi_Model->save($foto);
                $this->Sca_Dokumentasi_Model->save_result();
			}

            $this->session->set_flashdata('flash','SCA & Dokumentasi Berhasil Ditambahkan');
			redirect('sca_dokumentasi');
		}
    }
    
    function get_subarea(){
		$id=$this->input->post('id');
        if($id == 99) {
            $data = '';
        } else {
            $data=$this->Sca_Dokumentasi_Model->get_subarea($id);
        }
		echo json_encode($data);
    }

	function get_question(){
        $id=$this->input->post('id');
    
        echo '<div class="table-responsive">';
        echo '<table class="table table-hover" width="100%" cellspacing="0">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nama Material</th>';
        echo '<th>Standart</th>';
        echo '<th>Bersih</th>';
        echo '<th>Tidak</th>';
        echo '<th>Deskripsi</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $tanya = $this->Sca_Dokumentasi_Model->get_question($id);
        $n = 1;
        foreach($tanya as $row) {
            $materialnya = $this->db->query("select * from materials where id = '$row->id_material' order by id asc");
            foreach($materialnya->result() as $materiale) {
                echo '<tr>';
                echo '<td>'.$n++.'</td>';
                echo '<td>'.$materiale->standart.'</td>';
                echo '<td>'.$materiale->standart_pertanyaan.'</td>';
                echo '<input type="hidden" class="form-control" name="item['.$n.'][id]" value="'.$row->id.'">';
                echo '<td><input type="radio" name="item['.$n.'][jawaban]" value="Ya" required></td>';
                echo '<td><input type="radio" name="item['.$n.'][jawaban]" value="Tidak"></td>';
                echo '<td><input class="form-control" name="item['.$n.'][deskripsi]"></td>';
                echo '</tr>';
            }
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

    public function hapus($id){
        if($this->session->userdata('level') != 1){
            redirect('sca_dokumentasi');
        }

        $this->Sca_Dokumentasi_Model->hapusData1($id);
        $this->Sca_Dokumentasi_Model->hapusData2($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('sca_dokumentasi');
    }
    
    function cetak(){
		$this->load->library('mypdf');

        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $print = $this->input->post('print');

        if($enddate < $startdate) {
            $msg = ['color' => 'danger', 'message' => 'Tanggal Berakhir tidak valid.'];
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('sca_dokumentasi'));
        } 
        else{
            $this->db->select("*");
            $this->db->where('date(time) >=', $startdate); 
            $this->db->where('date(time) <=', $enddate); 
            $query = $this->db->get('sca_dokumentasi');
            $data['sca_dokumentasi'] = $this->Sca_Dokumentasi_Model->getAllSca()->result_array();;
            $data['tgl1'] = $startdate;
            $data['tgl2'] = $enddate;

            if($query->num_rows() > 0) {
                if($print == 'excel') {
                    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=Data_Sca_Dokumentasi.xls");

                    $data['sca_dokumentasi'] = $this->Sca_Dokumentasi_Model->getAllSca()->result_array();

                    $this->load->view('sca_dokumentasi/export', $data);
                }
                else if($print == 'pdf'){
                    $this->mypdf->generate('sca_dokumentasi/dompdf',$data, 'laporan-Sca_Dokumentasi', 'A4');
                }
            }
        }
    }
    
    function cetakpdf($id){
        $this->load->library('mypdf');

        $bersih=0;
        $kotor=0;
        $n=0;

        $query2 = $this->db->query('select * from sca_result where id_sca = '.$id);
        foreach($query2->result_array() as $rownyalagi) {
            foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) {
                if($rownyasekalilagi->jawaban == 'Ya') {
                    $bersih++;
                } else {
                $kotor++;
                }
                $n++;
             }
        }

        $data['terpenuhi'] = $bersih;
        $data['tdk_terpenuhi'] = $kotor;


        $data['query2'] =  $query2;

        
        $data['sca_dokumentasi'] = $this->db->query("select a.time, a.shift, a.id, a.nilai, a.image, a.user, a.area,
                                                        b.nama as nama_area, c.nama as nama_subarea from sca_dokumentasi a
                                                        left join area b on a.area=b.id
                                                        left join subarea c on a.sub_area = c.id where a.id='$id'")->row_array();

        $this->mypdf->generate('sca_dokumentasi/dompdf2',$data, 'laporan-Sca_Dokumentasi', 'A4');
    }

    public function cetakexcel($id){
        // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excel
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_Sca_Dokumentasi.xls");

        $bersih=0;
        $kotor=0;
        $n=0;

        $query2 = $this->db->query('select * from sca_result where id_sca = '.$id);
        foreach($query2->result_array() as $rownyalagi) {
            foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) {
                if($rownyasekalilagi->jawaban == 'Ya') {
                    $bersih++;
                } else {
                $kotor++;
                }
                $n++;
             }
        }

        $data['terpenuhi'] = $bersih;
        $data['tdk_terpenuhi'] = $kotor;


        $data['query2'] =  $query2;

        
        $data['sca_dokumentasi'] = $this->db->query("select a.time, a.shift, a.id, a.nilai, a.image, a.user, a.area, a.user,
                                                        b.nama as nama_area, c.nama as nama_subarea from sca_dokumentasi a
                                                        left join area b on a.area=b.id
                                                        left join subarea c on a.sub_area = c.id where a.id='$id'")->row_array();


        $this->load->view('sca_dokumentasi/export2', $data);
    }

}