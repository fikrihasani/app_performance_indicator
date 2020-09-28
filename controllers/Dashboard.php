<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('m_dashboard');
		$this->load->model('m_hitung');
		$this->load->model('m_area');
		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
        }
	}

    public function index(){
        $data['title'] = 'Dashboard';
        $data['jml_kehilangan'] = $this->m_dashboard->count_jml_kehilangan();
        $data['jml_inspeksi'] = $this->m_dashboard->count_jml_inspeksi();
        $data['jml_kerusakan'] = $this->m_dashboard->count_jml_kerusakan();
		$data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Kodingan dimulaiii
        $data['kosong'] = '';
        $data['area'] = '';
        $data['subarea'] = '';
        $data['shift'] = '';
        $bersih = 0;
        $kotor = 0;
        $jmlpertanyaan = 0;

        // DATA NOW
        $bersih2 = 0;
        $kotor2 = 0;
        $jmlpertanyaan2 = 0;

        // DATA NOW 2
        $bersih3 = 0;
        $kotor3 = 0;
        $jmlpertanyaan3 = 0;
    
        $this->form_validation->set_rules('shift', 'Shift', 'required');
        $this->form_validation->set_rules('id_subarea', 'Subarea', 'required');
        
        if($this->form_validation->run() == FALSE){
            date_default_timezone_set('Asia/Jakarta');
            $tgl_tampung = date("Y-m-d", time()); 

            $query = $this->db->query("select * from sca_dokumentasi where date(time) = '$tgl_tampung'");
            

            if($query->num_rows() > 1) {
                foreach($query->result_array() as $rownya) {
                    $query2 = $this->db->query('select * from sca_result where id_sca = '.$rownya['id']);
                    foreach($query2->result_array() as $rownyalagi) {
                        foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) {
                            $jmlpertanyaan3++;
                            if($rownyasekalilagi->jawaban == 'Ya') {
                                $bersih3++;
                            } else {
                                $kotor3++;
                            }
                        }
                    }
                }
            }
            else {
                if($query->num_rows()!=0) {
                    $rownya = $query->row_array();
                    $newquery = $this->db->query('select * from sca_result where id_sca = '.$rownya['id'])->row_array();
                    foreach(json_decode($newquery['result']) as $rownyalagi) {
                        $jmlpertanyaan3++;
                        if($rownyalagi->jawaban == 'Ya') {
                            $bersih3++;
                        } else {
                            $kotor3++;
                        }
                    }
                }       
            } 

             // DATA NOW
             if($bersih3 !=0 || $kotor3 != 0){
                $bersih3 = ($bersih3/$jmlpertanyaan3)*100;
                 $kotor3 = ($kotor3/$jmlpertanyaan3)*100;
            }
            

            $data['nilai_bersih'] = $bersih3;
            $data['nilai_kotor'] = $kotor3;
            $data['hasil_query'] = $query->result_array();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('dashboard/viewhitung',$data);
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/footer');

        }
        else{
            date_default_timezone_set('Asia/Jakarta');
            $shift = $this->input->post('shift');
            $area = $this->input->post('id_area');
            $id_subarea = $this->input->post('id_subarea');
            $tgl = $this->input->post('tgl');   
            $tgl_akhir = $this->input->post('tgl_akhir');    
            $tgl_tampung = date("Y-m-d", time());  

            if($tgl && $tgl_akhir){
                if($shift == 'semua') {
                    if($area == 99){
                        $area = 'SEMUA AREA';
                        $subarea = 'SEMUA SUBAREA'; 
                        $query = $this->db->query("select * from sca_dokumentasi where date(time) between '$tgl' AND '$tgl_akhir'");
                        $query_now = $this->db->query("select * from sca_dokumentasi where date(time) = '$tgl_tampung'");
                    }
                    else{
                        if($id_subarea == 'all'){
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = 'Semua Subarea';
                            $query = $this->db->query("select * from sca_dokumentasi where area='$id_area' and date(time) between '$tgl' AND '$tgl_akhir' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where area='$id_area' and date(time)='$tgl_tampung' order by id desc");
                        }
                        else{
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = $this->db->query('select * from subarea where id_area = '.$id_area)->row()->nama;  
                            $query = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and date(time) between '$tgl' AND '$tgl_akhir' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and date(time)='$tgl_tampung' order by id desc");
                        }
                    }
                }
                else {
                    if($area == 99){
                        $area = 'SEMUA AREA';
                        $subarea = 'SEMUA SUBAREA'; 
                        $query = $this->db->query("select * from sca_dokumentasi where shift = '$shift' and date(time) between '$tgl' AND '$tgl_akhir'");
                        $query_now = $this->db->query("select * from sca_dokumentasi where shift = '$shift' and date(time) = '$tgl_tampung'");
                    }
                    else{
                        if($id_subarea == 'all'){
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = 'Semua Subarea';
        
                            $query = $this->db->query("select * from sca_dokumentasi where area='$id_area' and shift = '$shift' and date(time) between '$tgl' AND '$tgl_akhir' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where area='$id_area' and shift = '$shift' and date(time) = '$tgl_tampung' order by id desc");
                        }
                        else{
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = $this->db->query('select * from subarea where id_area = '.$id_area)->row()->nama;
        
                            $query = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and shift = '$shift' and date(time) between '$tgl' AND '$tgl_akhir' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and shift = '$shift' and date(time) = '$tgl_tampung' order by id desc");
                        }
                    }
                }
            }
            else if($tgl){
                if($shift == 'semua') {
                    if($area == 99){
                        $area = 'SEMUA AREA';
                        $subarea = 'SEMUA SUBAREA'; 
                        $query = $this->db->query("select * from sca_dokumentasi where date(time) >= '$tgl' ");
                        $query_now = $this->db->query("select * from sca_dokumentasi where date(time) = '$tgl_tampung'");
                    }
                    else{
                        if($id_subarea == 'all'){
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = 'Semua Subarea';
        
                            $query = $this->db->query("select * from sca_dokumentasi where area='$id_area' and date(time) >= '$tgl' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where area='$id_area' and date(time) = '$tgl_tampung' order by id desc");
                        }
                        else{
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = $this->db->query('select * from subarea where id_area = '.$id_area)->row()->nama;
        
                            $query = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and date(time) >= '$tgl' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and date(time) = '$tgl_tampung' order by id desc");
                        }
                    }
                }
                else {
                    if($area == 99){
                        $area = 'SEMUA AREA';
                        $subarea = 'SEMUA SUBAREA'; 
                        $query = $this->db->query("select * from sca_dokumentasi where shift = '$shift' and date(time) >= '$tgl'");
                        $query_now = $this->db->query("select * from sca_dokumentasi where shift = '$shift' and date(time) = '$tgl_tampung'");
                    }
                    else{
                        if($id_subarea == 'all'){
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = 'Semua Subarea';
        
                            $query = $this->db->query("select * from sca_dokumentasi where area='$id_area' and shift='$shift' and date(time) >= '$tgl' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where area='$id_area' and shift='$shift' and date(time) = '$tgl_tampung' order by id desc");
                        }
                        else{
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = $this->db->query('select * from subarea where id_area = '.$id_area)->row()->nama;
        
                            $query = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and shift='$shift' and date(time) >= '$tgl' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and shift='$shift' and date(time) = '$tgl_tampung' order by id desc");
                        }
                    }
                }
            }
            else{
                if($shift == 'semua') {
                    if($area == 99){
                        $area = 'SEMUA AREA';
                        $subarea = 'SEMUA SUBAREA'; 
                        $query = $this->db->query("select * from sca_dokumentasi");
                        $query_now = $this->db->query("select * from sca_dokumentasi where date(time) = '$tgl_tampung'");
                    }
                    else{
                        if($id_subarea == 'all'){
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = 'Semua Subarea';
        
                            $query = $this->db->query("select * from sca_dokumentasi where area='$id_area' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where area='$id_area' and date(time) = '$tgl_tampung' order by id desc");
                        }
                        else{
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = $this->db->query('select * from subarea where id_area = '.$id_area)->row()->nama;
        
                            $query = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and date(time) = '$tgl_tampung' order by id desc");
                        }
                    }
                }
                else {
                    if($area == 99){
                        $area = 'SEMUA AREA';
                        $subarea = 'SEMUA SUBAREA'; 
                        $query = $this->db->query("select * from sca_dokumentasi where shift = '$shift'");
                        $query_now = $this->db->query("select * from sca_dokumentasi where shift = '$shift' and date(time) = '$tgl_tampung'");
                    }
                    else{
                        if($id_subarea == 'all'){
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = 'Semua Subarea';
        
                            $query = $this->db->query("select * from sca_dokumentasi where area='$id_area' and shift='$shift' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where area='$id_area' and shift='$shift' and date(time) = '$tgl_tampung' order by id desc");
                        }
                        else{
                            $id_area = $this->db->query('select * from area where id = '.$area)->row()->id;  
                            $area = $this->db->query('select * from area where id = '.$area)->row()->nama;  
                            $subarea  = $this->db->query('select * from subarea where id_area = '.$id_area)->row()->nama;
        
                            $query = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and shift='$shift' order by id desc");
                            $query_now = $this->db->query("select * from sca_dokumentasi where sub_area = '$id_subarea' and shift='$shift' and date(time) = '$tgl_tampung' order by id desc");
                        }
                    }
                }
            }

            // Menghitung
            if($query->num_rows() > 0) {
                if($query->num_rows() > 1) {
                    foreach($query->result_array() as $rownya) {
                        $query2 = $this->db->query('select * from sca_result where id_sca = '.$rownya['id']);
                        foreach($query2->result_array() as $rownyalagi) {
                            foreach(json_decode($rownyalagi['result']) as $rownyasekalilagi) {
                                $jmlpertanyaan++;
                                if($rownyasekalilagi->jawaban == 'Ya') {
                                    $bersih++;
                                } else {
                                    $kotor++;
                                }
                            }
                        }
                    }

                    // DATA SEKARANG
                    foreach($query_now->result_array() as $rownya2) {
                        $query22 = $this->db->query('select * from sca_result where id_sca = '.$rownya2['id']);
                        foreach($query22->result_array() as $rownyalagi2) {
                            foreach(json_decode($rownyalagi2['result']) as $rownyasekalilagi2) {
                                $jmlpertanyaan2++;
                                if($rownyasekalilagi2->jawaban == 'Ya') {
                                    $bersih2++;
                                } else {
                                    $kotor2++;
                                }
                            }
                        }
                    }
                    // AKHIR DATA NOW

                } else {
                    $rownya = $query->row_array();
                    $newquery = $this->db->query('select * from sca_result where id_sca = '.$rownya['id'])->row_array();
                    foreach(json_decode($newquery['result']) as $rownyalagi) {
                        $jmlpertanyaan++;
                        if($rownyalagi->jawaban == 'Ya') {
                            $bersih++;
                        } else {
                            $kotor++;
                        }
                    }

                    // DATA SEKARANG
                    $rownya2 = $query_now->row_array();
                    $newquery2 = $this->db->query('select * from sca_result where id_sca = '.$rownya2['id'])->row_array();
                    foreach(json_decode($newquery2['result']) as $rownyalagi2) {
                        $jmlpertanyaan2++;
                        if($rownyalagi2->jawaban == 'Ya') {
                            $bersih2++;
                        } else {
                            $kotor2++;
                        }
                    }
                    // AKHIR DATA NOW
                }

                
                $bersih = ($bersih/$jmlpertanyaan)*100;
                $kotor = ($kotor/$jmlpertanyaan)*100;

                // DATA NOW
                if($bersih2 !=0 || $kotor2 != 0){
                    $bersih2 = ($bersih2/$jmlpertanyaan2)*100;
                     $kotor2 = ($kotor2/$jmlpertanyaan2)*100;
                }
                

                $data['nilai_bersih2'] = $bersih2;
                $data['nilai_kotor2'] = $kotor2;
                $data['hasil_query2'] = $query_now->result_array();

                // Akhir DATA NOW

                $data['hasil_query'] = $query->result_array();
                $data['nilai_bersih'] = $bersih;
                $data['nilai_kotor'] = $kotor;
                $data['nilai_shift'] = $shift;
                $data['nilai_area'] = $area;
                $data['nilai_subarea'] = $subarea;

                // Ke grafik
                $this->load->view('templates/header',$data);
                $this->load->view('templates/topbar',$data);
                $this->load->view('templates/sidebar');
                $this->load->view('dashboard/tesgraph',$data);
                $this->load->view('templates/layout_footer');
                $this->load->view('templates/footer');
                
            }
            else {
                $this->session->set_flashdata('danger', 'Data tidak ditemukan!');
                redirect('dashboard');
            }
        // Akhir else

        }
    }
	
	public function cekdulu(){
         /* Set Limit */
       // $limit = 10;
        //$start = ($limit * $page) - $limit;
        //$id		 = id_desa();

        //$year        = ISSET($_POST['year']) ? inject($_POST['year']) : date("Y");
    		
		//if(is_auth(2)){
		//$ibu						= $this->m_kehamilan->kehamilan_per_tahun($id, $year, $_POST, $limit + 1, $start);
		//}else if(is_auth([3,4])){
		$area						= $this->m_area->get_all_area();
		
		//for($i=0; $i<count($area); $i++){
		//	$temp 							= $area[$i];
		//	$key 							= $temp['id'];
		//	$subarea 						= $this->m_area->get_all_sub($key);
		//	$temp['sub']					= $subarea;
			//$temp['status_kehamilan']		= verifikasi_convert($temp['status_kehamilan']);
			//$temp['color']		 			= color_convert($resiko['status_resiko']);
			//$temp['status_resiko'] 			= status_convert($resiko['status_resiko']);
			//$temp['id_desa']				= desa_convert($temp['id_desa']);
		//	$area[$i]			   			= $temp;
		//}
		
		$data['area'] = $area;
		$this->load->view('dashboard/tesgraph',$data);

    }
	
	public function satu(){
		$month       = ISSET($_GET['month']) ? inject($_GET['month']) : date("m");
		$year        = ISSET($_GET['year']) ? inject($_GET['year']) : date("Y");
		
        $data        = $this->m_dashboard->count_jml_kehilangan();

		$bulan		 = get_month($month);

        echo json_encode(['data_resiko' => $data, 'month' => $bulan, 'year' => $year]);
	}
	
	public function source_grafik(){
		$this->load->view('dashboard/viewhitung',$data);
	}


}