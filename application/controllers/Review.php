<?php
Class Review extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('m_pemeriksaan');
		$this->load->model('m_kehamilan');
		$this->load->model('m_desa');
    }

	/*Halaman Laporan*/
	public function laporan_daftar(){
		if(!is_auth()) {redirect('discover/keluar');}
		$subdata['tahun']			= $this->db->query("SELECT DISTINCT year(waktu_daftar) as year from kehamilan")->result_array();
		$data['title']				= 'Unduh Laporan';
		$data['meta_title']			= 'Unduh Laporan';
		$data['meta_description']   = "Unduh Laporan Antenatal Care";
        $data['breadcrumb']         = "Antenatal Care~Laporan~Unduh";
		$data['content']			= render_view('laporan', $subdata, true);

        $data['js_assets'] = [
            render_inline_js("
                $('#laporan-print').click(function(){
                    year = $('#year-choose').val();
                    month = $('#month-choose').val();

                    url = $(this).attr('href') + year + '/' + month;

                    document.location = url;
                    
                    return false;
                })
            ")
        ];

		render_view('template', $data);
	}

	public function source_laporan_daftar($is_ajax = true) {
        $month       = ISSET($_POST['month']) ? inject($_POST['month']) : date("m");
		$year        = ISSET($_POST['year']) ? inject($_POST['year']) : date("Y");
		
		$desa  		 = $this->m_desa->get_all_desa();
		for($i=0; $i<count($desa); $i++){
			$temp 								= $desa[$i];
			$temp['hb']				    		=  $this->m_kehamilan->get_hb($temp['id_desa'], $month, $year);
			$temp['anemia']			    		=  $this->m_kehamilan->get_anemia($temp['id_desa'], $month, $year);
			$temp['hbkurang']					=  $this->m_kehamilan->get_hbkurang($temp['id_desa'], $month, $year);
			$temp['lila']			    		=  $this->m_kehamilan->get_lila($temp['id_desa'], $month, $year);
			$temp['lilakurang']			    	=  $this->m_kehamilan->get_lilakurang($temp['id_desa'], $month, $year);
			$temp['proteinurine']			    =  $this->m_kehamilan->get_proteinurine($temp['id_desa'], $month, $year);
			$temp['proteinurinepositif']		=  $this->m_kehamilan->get_proteinurinepositif($temp['id_desa'], $month, $year);
			$temp['guladarah']					=  $this->m_kehamilan->get_guladarah($temp['id_desa'], $month, $year);
			$temp['guladarahpositif']			=  $this->m_kehamilan->get_guladarahpositif($temp['id_desa'], $month, $year);
			$temp['hiv']						=  $this->m_kehamilan->get_hiv($temp['id_desa'], $month, $year);
			$temp['hivpositif']					=  $this->m_kehamilan->get_hivpositif($temp['id_desa'], $month, $year);
			$temp['kelambu']					=  $this->m_kehamilan->get_kelambu($temp['id_desa'], $month, $year);
			$temp['mikroskopik']				=  $this->m_kehamilan->get_mikroskopik($temp['id_desa'], $month, $year);
			$temp['malaria']				    =  $this->m_kehamilan->get_malaria($temp['id_desa'], $month, $year);
			$temp['obat_malaria']			    =  $this->m_kehamilan->get_obatmalaria($temp['id_desa'], $month, $year);
			$temp['tb']						    =  $this->m_kehamilan->get_tb($temp['id_desa'], $month, $year);
			$temp['tbpositif']			  	    =  $this->m_kehamilan->get_tbpositif($temp['id_desa'], $month, $year);
			$temp['obattb']			  	 		=  $this->m_kehamilan->get_obattb($temp['id_desa'], $month, $year);
			$temp['ims']			  	 		=  $this->m_kehamilan->get_ims($temp['id_desa'], $month, $year);
			$temp['positifims']			   		=  $this->m_kehamilan->get_imspositif($temp['id_desa'], $month, $year);
			$temp['hepatitis']		  	 		=  $this->m_kehamilan->get_hepatitis($temp['id_desa'], $month, $year);
			$temp['hepatitispositif']  	 		=  $this->m_kehamilan->get_hepatitispositif($temp['id_desa'], $month, $year);
			$desa[$i]	   						= $temp;
		}

        $result['content'] = render_view('ajax_laporan', ['data' => $desa], true);
        if($is_ajax) {
            echo json_encode($result);
        }else {
            return $result;
        }
        
    }
	/*./Halaman Laporan*/

    public function laporan_print($year = "", $month = ""){

        if($year == "" || $month == ""){
            redirect('review/laporan_daftar');
        }


        $_POST['month'] = $month;
        $_POST['year'] = $year;

		$tanggal = month_convert($year.'-'.$month);
        $data = $this->source_laporan_daftar(false);
	
        render_view('laporan_print', ['data' => $data, 'tanggal' => $tanggal]);
    }

	public function kehamilan_grafik(){
		if(!is_auth()) {redirect('discover/keluar');}

		$id_desa     = id_desa();
		$year		 = get_year(date("Y-m-d"));

		$subdata['tahun']			= $this->db->query("SELECT DISTINCT year(waktu_daftar) as year from kehamilan")->result_array();
		$data['title']				= 'Grafik';
		$data['meta_title']			= 'Grafik Kehamilan';
		$data['meta_description']   = "Grafik Kehamilan";
		$data['breadcrumb_icon']    = "fa fa-bar-chart";
        $data['breadcrumb']         = "Antenatal Care~Grafik";
		$data['content']			= render_view('bikor/grafik_kehamilan', $subdata, true);
		render_view('template', $data);
	}

	public function source_kehamilan_grafik(){
		if(!is_auth()) {redirect('discover/keluar');}

		$month       = ISSET($_GET['month']) ? inject($_GET['month']) : date("m");
		$year        = ISSET($_GET['year']) ? inject($_GET['year']) : date("Y");
		
        $data        = $this->m_kehamilan->count_data_all($month, $year);

		$bulan		 = get_month($month);

        echo json_encode(['data_resiko' => $data, 'month' => $bulan, 'year' => $year]);
	}

	public function kehamilan_per_tahun(){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile                	= get_profile();

		$data['meta_title']			= 'Daftar Kehamilan Per Tahun';
		$data['title']				= 'Daftar Kehamilan Per Tahun';
		$data['meta_description']   = "Daftar Kehamilan Per Tahun Antenatal Care";
		$data['breadcrumb_icon']    = "fa fa-files-o";
        $data['breadcrumb']         = "Antenatal Care~Data Pasien~Kehamilan Per Tahun";
		$data['content']			= render_view('kehamilan_per_tahun', "", true);
		render_view('template', $data);
	}

    public function source_kehamilan_per_tahun_list() {
        //variable
        $page        = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
        $id		 = id_desa();

        $year        = ISSET($_POST['year']) ? inject($_POST['year']) : date("Y");
    		
		if(is_auth(2)){
		$ibu						= $this->m_kehamilan->kehamilan_per_tahun($id, $year, $_POST, $limit + 1, $start);
		}else if(is_auth([3,4])){
		$ibu						= $this->m_kehamilan->kehamilan_per_tahun_all($year, $_POST, $limit + 1, $start);
		}
		for($i=0; $i<count($ibu); $i++){
			$temp 							= $ibu[$i];
			$key 							= $temp['nik'];
			$resiko 						= $this->m_pemeriksaan->get_resiko_by_id($key);
			$temp['usia_kandungan_daftar']	= usia_hamil_convert($temp['waktu_konsepsi']);
			$temp['status_kehamilan']		= verifikasi_convert($temp['status_kehamilan']);
			$temp['color']		 			= color_convert($resiko['status_resiko']);
			$temp['status_resiko'] 			= status_convert($resiko['status_resiko']);
			$temp['id_desa']				= desa_convert($temp['id_desa']);
			$ibu[$i]			   			= $temp;
		}

        $result['content'] = render_view('ajax_kehamilan_per_tahun', ['data' => $ibu ,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($ibu) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }
}
?>
