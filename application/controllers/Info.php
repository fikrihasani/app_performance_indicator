<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller{
    public function __construct(){
    parent::__construct();
    $this->load->model('m_dashboard');
		$this->load->model('m_hitung');
		$this->load->model('m_area');
    }
    
    public function getData($id = null){
        if (!is_null($id)) {
            $tmp = $this->db->query("select avg(sca_dokumentasi.nilai) as y,area.nama as x from sca_dokumentasi inner join area on sca_dokumentasi.area=area.id where area.id_lokasi = ".$id." group by sca_dokumentasi.area ");
        }else{
            $tmp = $this->db->query("select avg(pemeriksaan.hasil)*100 as y,area.nama as x from pemeriksaan inner join area on pemeriksaan.id_area=area.id group by pemeriksaan.id_area");
        }
        $data['performances_area'] = $tmp->result_array();
        
        // foreach($tmp->result_array() as $row){
        //     array_push($data['performances_area'],array('x'=>$row['nama'], 'y'=>$row['nilai']));
        // }
        echo json_encode($data['performances_area'], JSON_NUMERIC_CHECK);
    }

    public function getDataError($id = null){
        if(!is_null($id)){
            $tmp = $this->db->query("select avg(pemeriksaan.hasil)*100 as nilai,materials.standart from pemeriksaan inner join materials on pemeriksaan.id_material=materials.id where area.id_lokasi = ".$id." group by pemeriksaan.id_material");
        }else{
            $tmp = $this->db->query("select avg(pemeriksaan.hasil)*100 as nilai,materials.standart from pemeriksaan inner join materials on pemeriksaan.id_material=materials.id group by pemeriksaan.id_material");
        }
        $data['performances_area'] = array();
        
        foreach($tmp->result_array() as $row){
            array_push($data['performances_area'],array('x'=>$row['standart'], 'y'=>$row['nilai']));
        }
        echo json_encode($data['performances_area'], JSON_NUMERIC_CHECK);
    }

    public function filter($type, $id){
        if($type == 2){
            $data = $this->getDataError($id);
        }else{
            $data = $this->getData($id);
        }
        echo $data;
    }

    public function index(){
        $data['title'] = 'Dashboard';
        $data['jml_kehilangan'] = $this->m_dashboard->count_jml_kehilangan();
        $data['jml_inspeksi'] = $this->m_dashboard->count_jml_inspeksi();
        $data['jml_kerusakan'] = $this->m_dashboard->count_jml_kerusakan();
        $data['lokasi'] = $this->db->query("select * from lokasi")->result_array();
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
            
            
            //   echo json_encode($data['performances_area'],JSON_NUMERIC_CHECK);
            //   exit;
            //   print_r($data['performances_area']);
            //   exit;
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('dashboard/tesgraph',$data);
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
}
?>