<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hitung extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('m_hitung');
		$this->load->model('m_area');
		if($this->session->userdata('username') != TRUE){
            $url=base_url();
            redirect($url);
        }
	}
	
	public function grafik_lapor() {
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
		
		$this->load->view('viewhitung', $data);

    }
}

?>