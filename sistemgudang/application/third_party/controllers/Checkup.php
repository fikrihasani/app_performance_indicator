<?php
Class Checkup extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('m_ibu');
		$this->load->model('m_kehamilan');
		$this->load->model('m_pemeriksaan');
    }

	/*KOHORT*/
	public function kohort_input() {
		if(!is_auth()) {redirect('discover/keluar');}
		$profile              	  		  = get_profile();
		$subdata['action']				  = site_url('checkup/kohort_proses_input');
		$id					 			  = id_desa();
		$subdata['hasil']				  = $this->m_ibu->get_ibu_by_desa_r($id);
		$data['title']					  = 'Tambah Data Kehamilan Baru';
		$data['meta_title']        		  = "Tambah Data Kehamilan Baru";
        $data['meta_description']  		  = "Tambah Data Kehamilan Antenatal Care";
		$data['breadcrumb_icon']  		  = "fa fa-files-o";
	    $data['breadcrumb']          	  = "Antenatal Care~Kohort~Tambah Kehamilan Baru";
		$data['content']				  = render_view('bides/input_kohort', $subdata, true);
		render_view('template', $data);
	}

	public function kohort_proses_input() {
		if(!is_auth()) {redirect('discover/keluar');}
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('id_ibu', 'Data Ibu', 'required');
		$this->form_validation->set_rules('tanggal_periksa', 'Tanggal Periksa', 'required');
		$this->form_validation->set_rules('waktu_periksa', 'Waktu Periksa', 'required');
		$this->form_validation->set_rules('status_bpjs', 'Status Bpjs', 'required');
		$this->form_validation->set_rules('usia_kandungan_daftar', 'Usia Hamil', 'required');
		$this->form_validation->set_rules('trimester', 'Trimester', 'required');
		$this->form_validation->set_rules('berat_badan', 'Berat Badan', 'required');
		$this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'required');
		$this->form_validation->set_rules('tekanan_a', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('tekanan_b', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('fundung_uterus', 'Fundung Uterus', 'required');
		$this->form_validation->set_rules('lingkar_lengan', 'Lingkar Lengan', 'required');
		$this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required');
		$this->form_validation->set_rules('refleksi_patella', 'Refleksi Patella', 'required');
		$this->form_validation->set_rules('djj', 'Denyut Jantung Janin', 'required');
		$this->form_validation->set_rules('kepala', 'Kepala Terhadap PAP', 'required');
		$this->form_validation->set_rules('berat_janin', 'Taksiran Berat Janin', 'required');
		$this->form_validation->set_rules('jumlah_janin', 'Jumlah Janin', 'required');
		$this->form_validation->set_rules('presentasi', 'Presentasi', 'required');
		$this->form_validation->set_rules('status_konseling', 'Status Konseling', 'required');
		$this->form_validation->set_rules('status_imunisasi', 'Status Imunisasi', 'required');
		$this->form_validation->set_rules('status_injeksi', 'Status Injeksi', 'required');
		$this->form_validation->set_rules('status_pencatatan', 'Status Pencatatan', 'required');
		$this->form_validation->set_rules('ps', 'PS', 'required');
		$this->form_validation->set_rules('hb', 'Hb', 'required');
		$this->form_validation->set_rules('protein_urine', 'Protein Urine', 'required');
		$this->form_validation->set_rules('gula_darah', 'Gula Darah', 'required');
		$this->form_validation->set_rules('status_thalasemia', 'Thalasemia', 'required');
		$this->form_validation->set_rules('status_sifilis', 'Sifilis', 'required');
		$this->form_validation->set_rules('hbsag', 'HbsAg', 'required');
		$this->form_validation->set_rules('vct', 'VCT', 'required');
		$this->form_validation->set_rules('serologi', 'serologi', 'required');
		//$this->form_validation->set_rules('arv', 'arv', 'required');
		$this->form_validation->set_rules('malaria', 'malaria', 'required');
		$this->form_validation->set_rules('tb', 'TB', 'required');
		$this->form_validation->set_rules('hdk', 'HDK', 'required');
		$this->form_validation->set_rules('abortus', 'Abortus', 'required');
		$this->form_validation->set_rules('pendarahan', 'Pendarahan', 'required');
		$this->form_validation->set_rules('infeksi', 'Infeksi', 'required');
		$this->form_validation->set_rules('kpd', 'Kpd', 'required');

		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('checkup/kohort_input/');
		}else{
			$databidan				= get_profile();
			$id_desa				= id_desa();
			$id_user				= userid();
			$id_ibu					= inject($this->input->post('id_ibu'));
			$tanggal_periksa		= inject($this->input->post('tanggal_periksa'));
			$waktu_periksa			= inject($this->input->post('waktu_periksa'));
			$status_bpjs			= inject($this->input->post('status_bpjs'));
			$waktu_konsepsi			= inject($this->input->post('waktu_konsepsi'));
			$HPL					= inject($this->input->post('HPL'));
			$trimester				= inject($this->input->post('trimester'));
			$anamnesis				= inject($this->input->post('anamnesis'));
			$berat_badan			= inject($this->input->post('berat_badan'));
			$tinggi_badan			= inject($this->input->post('tinggi_badan'));
			$tekanan_a				= inject($this->input->post('tekanan_a'));
			$tekanan_b				= inject($this->input->post('tekanan_b'));
			$fundung_uterus			= inject($this->input->post('fundung_uterus'));
			$lingkar_lengan			= inject($this->input->post('lingkar_lengan'));
			$status_gizi			= inject($this->input->post('status_gizi'));
			$status_gizi			= inject($this->input->post('status_gizi'));
			$refleksi_patella		= inject($this->input->post('refleksi_patella'));
			$djj					= inject($this->input->post('djj'));
			$kepala					= inject($this->input->post('kepala'));
			$berat_janin			= inject($this->input->post('berat_janin'));
			$jumlah_janin			= inject($this->input->post('jumlah_janin'));
			$presentasi				= inject($this->input->post('presentasi'));
			$status_konseling		= inject($this->input->post('status_konseling'));
			$status_imunisasi		= inject($this->input->post('status_imunisasi'));
			$status_injeksi			= inject($this->input->post('status_injeksi'));
			$status_pencatatan		= inject($this->input->post('status_pencatatan'));
			$ps						= inject($this->input->post('ps'));
			$hb						= inject($this->input->post('hb'));
			$protein_urine			= inject($this->input->post('protein_urine'));
			$gula_darah				= inject($this->input->post('gula_darah'));
			$status_thalasemia		= inject($this->input->post('status_thalasemia'));
			$status_sifilis			= inject($this->input->post('status_sifilis'));
			$hbsag					= inject($this->input->post('hbsag'));
			$vct					= inject($this->input->post('vct'));
			$serologi				= inject($this->input->post('serologi'));
			$arv					= inject($this->input->post('arv'));
			$malaria				= inject($this->input->post('malaria'));
			$kelambu				= inject($this->input->post('kelambu'));
			$tb						= inject($this->input->post('tb'));
			$obat					= inject($this->input->post('obat'));
			$obat2					= inject($this->input->post('obat2'));
			$hdk					= inject($this->input->post('hdk'));
			$abortus				= inject($this->input->post('abortus'));
			$pendarahan				= inject($this->input->post('pendarahan'));
			$infeksi				= inject($this->input->post('infeksi'));
			$kpd					= inject($this->input->post('kpd'));
			$lain_lain				= inject($this->input->post('lain_lain'));
			$data_ibu		= array(
								'status_isi'		=> 1,
								'waktu_ubah'		=> date("Y/m/d h:i:s"),
								'ubah_by'			=> $id_user
							);
			$data_kehamilan	= array(
								'daftar_by'				=> $id_user,
								'id_ibu'				=> $id_ibu,
								'waktu_daftar'			=> date("Y/m/d h:i:s"),
								'waktu_konsepsi'		=> $waktu_konsepsi,
								'status_kehamilan'		=> 0,
								'HPL'					=> $HPL
							);
			$data_periksa	= array(
								'id_ibu'				=> $id_ibu,
								'daftar_by'				=> $id_user,
								'status_bpjs'			=> $status_bpjs,
								'tanggal_periksa'		=> $tanggal_periksa,
								'waktu_periksa'			=> $waktu_periksa,
								'waktu_daftar'			=> date("Y-m-d h:i:s"),
								'trimester'				=> $trimester,
								'anamnesis'				=> $anamnesis,
								'berat_badan'			=> $berat_badan,
								'tinggi_badan'			=> $tinggi_badan,
								'tekanan_a'				=> $tekanan_a,
								'tekanan_b'				=> $tekanan_b,
								'fundung_uterus'		=> $fundung_uterus,
								'lingkar_lengan'		=> $lingkar_lengan,
								'status_gizi'			=> $status_gizi,
								'refleksi_patella'		=> $refleksi_patella,
								'djj'					=> $djj,
								'kepala'				=> $kepala,
								'berat_janin'			=> $berat_janin,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'status_pencatatan'		=> $status_pencatatan,
								'ps'					=> $ps,
								'hb'					=> $hb,
								'protein_urine'			=> $protein_urine,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'arv'					=> $arv,
								'malaria'				=> $malaria,
								'kelambu'				=> $kelambu,
								'tb'					=> $tb,
								'obat'					=> $obat,
								'obat2'					=> $obat2,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd,
								'lain_lain'				=> $lain_lain
							);
			$data_boolean = array(
								'fundung_uterus'		=> $fundung_uterus,
								'status_gizi'			=> $status_gizi,
								'refleksi_patella'		=> $refleksi_patella,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'arv'					=> $arv,
								'malaria'				=> $malaria,
								'tb'					=> $tb,
								'obat'					=> $obat,
								'obat2'					=> $obat2,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd,
								'lain_lain'				=> $lain_lain
			);


           $data_periksa['status_resiko'] = $this->get_risk($data_periksa, $data_boolean, $data_kehamilan);

			//dumper($data_periksa);
			//dumper($status);
			$this->m_ibu->update_ibu($data_ibu, $id_ibu);
			$this->m_kehamilan->insert_kehamilan($data_kehamilan);
			$this->m_pemeriksaan->insert_pemeriksaan($data_periksa);

			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Kohort Baru"));
			redirect('checkup/kohort_input/');
		}

	}

    function get_risk($data_periksa = [],$data_boolean = [],$data_kehamilan = []){
        if(in_array(1 ,$data_boolean)){
            $resiko = 1;
        }else if($data_periksa['lain_lain'] != "" ){
			$resiko = 1;
		}else if($data_periksa['tinggi_badan'] < 145){
            $resiko = 1;
        }else if(($data_periksa['tekanan_a'] / $data_periksa['tekanan_b'] > 110/90) || ($data_periksa['tekanan_a'] / $data_periksa['tekanan_b'] < 90/60)) {
            $resiko = 1;
        }else if($data_periksa['lingkar_lengan'] < 23.5){
            $resiko = 1;
        }else if(($data_periksa['hb'] > 16) || ($data_periksa['hb'] < 12)){
            $resiko = 1;
        }else if(((usia_hamil_convert($data_kehamilan['waktu_konsepsi'])) > 12) && ($data_periksa['kepala'] != 0)){
            $resiko = 1;
        }else if(((usia_hamil_convert($data_kehamilan['waktu_konsepsi'])) > 16) && (($data_periksa['djj'] >160) || ($data_periksa['djj'] <120) )){
            $resiko = 1;
        }else{
            $resiko = 0;
        }
        return $resiko;
    }
	/*./KOHORT*/

	/*Kehamilan*/
	public function kehamilan_berjalan_daftar(){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile                	= get_profile();

		$data['meta_title']			= 'Daftar Kehamilan Berjalan';
		$data['title']				= 'Daftar Kehamilan Berjalan';
		$data['meta_description']   = "Daftar Kehamilan Berjalan Antenatal Care";
		$data['breadcrumb_icon']    = "fa fa-files-o";
        $data['breadcrumb']         = "Antenatal Care~Data Pasien~Kehamilan Berjalan";
		$data['content']			= render_view('bides/kehamilan_berjalan', "", true);
		render_view('template', $data);
	}

    public function source_kehamilan_berjalan_list() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
        $id		 = id_desa();

		if(is_auth(2)){
		$ibu						= $this->m_kehamilan->get_kehamilan_berjalan_by_desa($id,  $_POST, $limit + 1, $start);
		}else if(is_auth([3,4])){
		$ibu						= $this->m_kehamilan->get_all_kehamilan($_POST, $limit + 1, $start);
		}
		for($i=0; $i<count($ibu); $i++){
			$temp 							= $ibu[$i];
			$temp['HPL']  					= date_convert($temp['HPL']);
			$temp['color']		 			= color_convert($temp['current_risk']);
			$temp['status_resiko'] 			= status_convert($temp['current_risk']);
			$temp['id_desa']				= desa_convert($temp['id_desa']);
			$ibu[$i]			   			= $temp;
		}

        $result['content'] = render_view('bides/ajax_kehamilan_berjalan', ['data' => $ibu , 'start' => $start, 'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($ibu) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }

	public function kehamilan_berjalan_detail( $id = ''){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile                	= get_profile();

		$id = inject($id);//
		if($id == ""){ redirect('checkup/kehamilan_berjalan_daftar');}
		$ibu_id 					= simple_decrypt($id);
		$kehamilan    				= $this->m_kehamilan->get_kehamilan_by_id($ibu_id);
		$kehamilan['status_resiko'] = status_convert($kehamilan['current_risk']);
		$kehamilan['HPL']           = date_convert($kehamilan['HPL']);
		$kehamilan['waktu_konsepsi']  = usia_hamil_convert($kehamilan['waktu_konsepsi']);
		$subdata['get']       	    = $kehamilan;
		$data['meta_title']			= 'Detail Kehamilan Berjalan';
		$data['title']				= 'Detail Kehamilan Berjalan';
		$data['meta_description']   = "Detail Kehamilan Berjalan Antenatal Care";
		$data['breadcrumb_icon']    = "fa fa-files-o";
        $data['breadcrumb']         = "Antenatal Care~Kohort~Detail Kehamilan Berjalan";
		$data['content']			= render_view('bides/kehamilan_berjalan_detail', $subdata, true);
		render_view('template', $data);
	}

	public function source_kehamilan_berjalan_detail_list($id = '') {
        //variable
        $page        = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
        $page2        = ISSET($_POST['current_page2']) ? inject($_POST['current_page2']) : 1;

         /* Set Limit */
        $limit 		= 10;
        $start 		= ($limit * $page) - $limit;
        $id		 	= inject($id);

		//dumper($id);
		$id_ibu		= simple_decrypt($id);
		//if(is_auth(2)){
		//dumper($id_ibu);
		$pemeriksaan				= $this->m_pemeriksaan->get_all_pemeriksaan_by_id($id_ibu, $_POST, $limit + 1, $start);
		$rujukan					= $this->m_kehamilan->get_all_rujukan_by_id($id_ibu, $_POST, $limit + 1, $start);
		/*else if(is_auth([3,4])){
		$ibu						= $this->m_kehamilan->get_all_kehamilan();
		}*/
		for($i=0; $i<count($pemeriksaan); $i++){
			$temp 							= $pemeriksaan[$i];
			$temp['tanggal_periksa'] 		= date_convert($temp['tanggal_periksa']);
			$temp['anamnesis'] 				= empty_convert($temp['anamnesis']);
			$temp['fundung_uterus'] 		= fundung_convert($temp['fundung_uterus']);
			$temp['status_gizi'] 			= gizi_convert($temp['status_gizi']);
			$temp['refleksi_patella'] 		= refleksi_convert($temp['refleksi_patella']);
			$temp['kepala'] 				= kepala_convert($temp['kepala']);
			$temp['jumlah_janin'] 			= janin_convert($temp['jumlah_janin']);
			$temp['presentasi'] 			= presentasi_convert($temp['presentasi']);
			$temp['status_konseling'] 		= pelayanan_convert($temp['status_konseling']);
			$temp['status_imunisasi'] 		= pelayanan_convert($temp['status_imunisasi']);
			$temp['status_injeksi'] 		= pelayanan_convert($temp['status_injeksi']);
			$temp['status_pencatatan'] 		= pelayanan_convert($temp['status_pencatatan']);
			$temp['protein_urine'] 			= komplikasi_convert($temp['protein_urine']);
			$temp['gula_darah'] 			= komplikasi_convert($temp['gula_darah']);
			$temp['status_thalasemia'] 		= komplikasi_convert($temp['status_thalasemia']);
			$temp['status_sifilis'] 		= komplikasi_convert($temp['status_sifilis']);
			$temp['hbsag'] 					= komplikasi_convert($temp['hbsag']);
			$temp['vct'] 					= komplikasi_convert($temp['vct']);
			$temp['arv'] 					= empty_convert($temp['arv']);
			$temp['serologi'] 				= komplikasi_convert($temp['serologi']);
			$temp['malaria'] 				= komplikasi_convert($temp['malaria']);
			$temp['obat'] 					= empty_convert($temp['obat']);
			$temp['kelambu'] 				= komplikasi_convert($temp['kelambu']);
			$temp['tb'] 					= komplikasi_convert($temp['tb']);
			$temp['obat2'] 					= empty_convert($temp['obat2']);
			$temp['hdk'] 					= komplikasi_convert($temp['hdk']);
			$temp['abortus'] 				= komplikasi_convert($temp['abortus']);
			$temp['pendarahan'] 			= komplikasi_convert($temp['pendarahan']);
			$temp['infeksi'] 				= komplikasi_convert($temp['infeksi']);
			$temp['kpd'] 					= komplikasi_convert($temp['kpd']);
			$temp['status_bpjs'] 			= bpjs_convert($temp['status_bpjs']);
			$temp['lain_lain'] 				= empty_convert($temp['lain_lain']);
			$temp['color']		 			= color_convert($temp['status_resiko']);
			$temp['status_resiko']			= status_convert($temp['status_resiko']);
			$pemeriksaan[$i]	   			= $temp;
		}

        $result['content'] = render_view('bides/ajax_kehamilan_berjalan_detail', ['data' => $pemeriksaan ,  'limit' => $limit], true);
        $result['page']    = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($pemeriksaan) > $limit) ? 'true' : 'false';
        echo json_encode($result);
	
    }

	public function source_riwayat_rujukan_list($id = '') {
        //variable
        $page2        = ISSET($_POST['current_page2']) ? inject($_POST['current_page2']) : 1;

         /* Set Limit */
        $limit 		= 10;
        $start 		= ($limit * $page2) - $limit;
        $id		 	= inject($id);


		$id_ibu		= simple_decrypt($id);

		$rujukan					= $this->m_kehamilan->get_all_rujukan_by_id($id_ibu, $_POST, $limit + 1, $start);

        $result2['content'] = render_view('bides/ajax_riwayat_rujukan', ['data' => $rujukan ,  'limit' => $limit], true);
        $result2['page']    = $page2;
        $result2['hasPrev'] = ($page2 > 1) ? 'true' : 'false';
        $result2['hasNext'] = (count($rujukan) > $limit) ? 'true' : 'false';
		echo json_encode($result2);
    }

	public function kehamilan_unverified_daftar(){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile                	= get_profile();

		$data['meta_title']			= 'Daftar Kehamilan Belum Terverifikasi';
		$data['title']				= 'Daftar Kehamilan Belum Terverifikasi';
		$data['meta_description']   = "Daftar Kehamilan Belum Terverifikasi";
        $data['breadcrumb']         = "Antenatal Care~Kohort~Daftar Kehamilan Belum Terverifikasi";
		$data['breadcrumb_icon']    = "fa fa-files-o";
		$data['content']			= render_view('bides/kehamilan_unverified', '', true);
		render_view('template', $data);
	}

    public function source_kehamilan_unverified_list() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
        $id							= id_desa();
        if(is_auth(2)){
        $ibu						= $this->m_kehamilan->get_kehamilan_unverified_by_desa($id, $_POST, $limit, $start);
        }else if(is_auth([1,3,4])){
        $ibu						= $this->m_kehamilan->get_all_kehamilan_unverified($_POST, $limit, $start);
        }
        for($i=0; $i<count($ibu)-1; $i++) {
            $temp 							= $ibu[$i];
            $key 							= $temp['nik'];
            $temp['HPL']  					= date_convert($temp['HPL']);
            $temp['color']		 			= color_convert($temp['current_risk']);
            if(is_auth([3,4])){$temp['id_desa']		 		= desa_convert($temp['id_desa']);}
            $temp['status_resiko'] 			= status_convert($temp['current_risk']);
            $temp['color2']			 		= color_convert2($temp['status_kehamilan']);
			$temp['status_kehamilan'] 		= verifikasi_convert($temp['status_kehamilan']);
            $ibu[$i]			   			= $temp;
        }
		//dumper($ibu);
        $result['content'] = render_view('bides/ajax_kehamilan_unverified', ['data' => $ibu , 'start' => $start, 'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($ibu) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }

	public function kehamilan_unverified_detail($id = ''){
		if(!is_auth()) {redirect('discover/keluar');}
        $id = inject($id);//
        if($id == ""){ redirect('checkup/kehamilan_unverified_daftar');}
        $idk 							    = simple_decrypt($id);
        $kehamilan    						= $this->m_kehamilan->get_kehamilan_by_id($idk);
		$waktu								= date("Y-m-d h:m:s");
		$ibu_id								= $kehamilan['nik'];
		$kehamilan['HPL']  					= date_convert($kehamilan['HPL']);
		$kehamilan['tanggal_lahir']  		= umur_convert($kehamilan['tanggal_lahir']);
		$pemeriksaan 						= $this->m_pemeriksaan->get_pemeriksaan_unverified_by_id($ibu_id, $kehamilan['waktu_daftar']);

        if(empty($pemeriksaan)) {
        //     $pemeriksaan = ['tanggal_periksa' 	=> "0000-00-00",
        //     'status_resiko' 		=> "",
        //     'anamnesis' 			=> "",
        //     'fundung_uterus' 		=> "",
        //     'status_gizi' 		=> "",
        //     'refleksi_patella' 	=> "",
        //     'kepala' 				=> "",
        //     'jumlah_janin' 		=> "",
        //     'presentasi' 			=> "",
        //     'status_konseling' 	=> "",
        //     'status_imunisasi' 	=> "",
        //     'status_injeksi' 		=> "",
        //     'status_pencatatan' 	=> "",
        //     'protein_urine' 		=> "",
        //     'gula_darah' 			=> "",
        //     'status_thalasemia' 	=> "",
        //     'status_sifilis' 		=> "",
        //     'hbsag' 				=> "",
        //     'vct' 				=> "",
        //     'arv' 				=> "",
        //     'serologi' 			=> "",
        //     'malaria' 			=> "",
        //     'obat' 				=> "",
        //     'kelambu' 			=> "",
        //     'tb' 					=> "",
        //     'obat2' 				=> "",
        //     'hdk' 				=> "",
        //     'abortus' 			=> "",
        //     'pendarahan' 			=> "",
        //     'infeksi' 			=> "",
        //     'kpd' 				=> "",
        //     'status_bpjs' 		=> "",
        //     'lain_lain' 			=> "",
        //     'status_resiko'		=> "",
        //     'id_pemeriksaan' => "",
        //     'ps' => "",
        //     'hb' => "",
        //     'berat_janin' => "",
        //     'djj' => "",
        //     'lingkar_lengan' => "",
        //     'tekanan_b' => "",
        //     'tekanan_a' => "",
        //     'berat_badan' => "",
        //     'tinggi_badan' => "",
        //     'trimester' => "",
        // ];
        redirect('checkup/kehamilan_unverified_daftar/');
        }


        $idp								= simple_encrypt($pemeriksaan['id_pemeriksaan']);
		$ibu								= simple_encrypt($ibu_id);
		$pemeriksaan['tanggal_periksa'] 	= date_convert($pemeriksaan['tanggal_periksa']);
		$pemeriksaan['anamnesis'] 			= empty_convert($pemeriksaan['anamnesis']);
		$pemeriksaan['fundung_uterus'] 		= fundung_convert($pemeriksaan['fundung_uterus']);
		$pemeriksaan['status_gizi'] 		= gizi_convert($pemeriksaan['status_gizi']);
		$pemeriksaan['refleksi_patella'] 	= refleksi_convert($pemeriksaan['refleksi_patella']);
		$pemeriksaan['kepala'] 				= kepala_convert($pemeriksaan['kepala']);
		$pemeriksaan['jumlah_janin'] 		= janin_convert($pemeriksaan['jumlah_janin']);
		$pemeriksaan['presentasi'] 			= presentasi_convert($pemeriksaan['presentasi']);
		$pemeriksaan['status_konseling'] 	= pelayanan_convert($pemeriksaan['status_konseling']);
		$pemeriksaan['status_imunisasi'] 	= pelayanan_convert($pemeriksaan['status_imunisasi']);
		$pemeriksaan['status_injeksi'] 		= pelayanan_convert($pemeriksaan['status_injeksi']);
		$pemeriksaan['status_pencatatan'] 	= pelayanan_convert($pemeriksaan['status_pencatatan']);
		$pemeriksaan['protein_urine'] 		= komplikasi_convert($pemeriksaan['protein_urine']);
		$pemeriksaan['gula_darah'] 			= komplikasi_convert($pemeriksaan['gula_darah']);
		$pemeriksaan['status_thalasemia'] 	= komplikasi_convert($pemeriksaan['status_thalasemia']);
		$pemeriksaan['status_sifilis'] 		= komplikasi_convert($pemeriksaan['status_sifilis']);
		$pemeriksaan['hbsag'] 				= komplikasi_convert($pemeriksaan['hbsag']);
		$pemeriksaan['vct'] 				= komplikasi_convert($pemeriksaan['vct']);
		$pemeriksaan['arv'] 				= empty_convert($pemeriksaan['arv']);
		$pemeriksaan['serologi'] 			= komplikasi_convert($pemeriksaan['serologi']);
		$pemeriksaan['malaria'] 			= komplikasi_convert($pemeriksaan['malaria']);
		$pemeriksaan['obat'] 				= empty_convert($pemeriksaan['obat']);
		$pemeriksaan['kelambu'] 			= komplikasi_convert($pemeriksaan['kelambu']);
		$pemeriksaan['tb'] 					= komplikasi_convert($pemeriksaan['tb']);
		$pemeriksaan['obat2'] 				= empty_convert($pemeriksaan['obat2']);
		$pemeriksaan['hdk'] 				= komplikasi_convert($pemeriksaan['hdk']);
		$pemeriksaan['abortus'] 			= komplikasi_convert($pemeriksaan['abortus']);
		$pemeriksaan['pendarahan'] 			= komplikasi_convert($pemeriksaan['pendarahan']);
		$pemeriksaan['infeksi'] 			= komplikasi_convert($pemeriksaan['infeksi']);
		$pemeriksaan['kpd'] 				= komplikasi_convert($pemeriksaan['kpd']);
		$pemeriksaan['status_bpjs'] 		= bpjs_convert($pemeriksaan['status_bpjs']);
		$pemeriksaan['lain_lain'] 			= empty_convert($pemeriksaan['lain_lain']);
		$rujukan							= $this->m_pemeriksaan->get_all_rujukan_by_id($kehamilan['id_kehamilan']);
        if(empty($kehamilan)){ redirect('checkup/kehamilan_unverified_daftar');}
        if ($id != '') {
            $subdata['action']     		= site_url('analysist/verifikasi_kehamilan/'.$idp.'/'.$ibu);;
            $subdata['get']       	    = $kehamilan;
            $subdata['h']	      	    = $pemeriksaan;
            $subdata['hasil2']          = $rujukan;
            $data['title']              = 'Informasi Detail Kehamilan';
            $data['meta_title']         = "Informasi Detail Kehamilan";
            $data['meta_description']   = "Informasi Detail Kehamilan Antenatal Care";
			$data['breadcrumb_icon']    = "fa fa-files-o";
            $data['breadcrumb']         = "Antenatal Care~Kohort~Detail Kehamilan Baru";
            $data['content']            = render_view('bides/kehamilan_unverified_detail', $subdata, true);
            render_view('template',$data);
        } else{
            redirect('checkup/kehamilan_unverified_daftar');
        }
    }

	public function kehamilan_unverified_edit($id = ''){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile              	  		  = get_profile();

		$id							= inject($id);
		$idk						= simple_decrypt($id);

		$kehamilan						  = $this->m_kehamilan->get_kehamilan_by_id($idk);
		$nik							  = $kehamilan['nik'];
		$pemeriksaan					  = $this->m_pemeriksaan->get_pemeriksaan_unverified_by_id($nik, $kehamilan['waktu_daftar']);
		//dumper($pemeriksaan);
		$subdata['action']				  = site_url('checkup/kehamilan_unverified_proses_edit/'.$id.'/'.simple_encrypt($nik));
		$subdata['get']					  = $kehamilan;
		$subdata['ibu']					  = $this->m_ibu->get_ibu_by_id($nik);
		$subdata['h']					  = $pemeriksaan;
		$data['title']					  = 'Ubah Data Kehamilan Baru';
		$data['meta_title']        		  = "Ubah Data Kehamilan Baru";
        $data['meta_description']  		  = "Ubah Data Kehamilan Baru";
		$data['breadcrumb_icon']  		  = "fa fa-files-o";
	    $data['breadcrumb']          	  = "Antenatal Care~Kohort~Ubah Data Kehamilan Baru";
		$data['content']				  = render_view('bides/edit_kohort', $subdata, true);
		render_view('template', $data);
	}

	public function kehamilan_unverified_proses_edit($id = '', $nik = ''){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile              	  		  = get_profile();

		$id		= inject($id);
		$nik	= inject($nik);
		$idk	= simple_decrypt($id);
		$id_ibu	= simple_decrypt($nik);

		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('tanggal_periksa', 'Tanggal Periksa', 'required');
		$this->form_validation->set_rules('waktu_periksa', 'Waktu Periksa', 'required');
		$this->form_validation->set_rules('status_bpjs', 'Status Bpjs', 'required');
		$this->form_validation->set_rules('waktu_konsepsi', 'Waktu Konsepsi', 'required');
		$this->form_validation->set_rules('HPL', 'HPL', 'required');
		$this->form_validation->set_rules('trimester', 'Trimester', 'required');
		$this->form_validation->set_rules('berat_badan', 'Berat Badan', 'required');
		$this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'required');
		$this->form_validation->set_rules('tekanan_a', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('tekanan_b', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('fundung_uterus', 'Fundung Uterus', 'required');
		$this->form_validation->set_rules('lingkar_lengan', 'Lingkar Lengan', 'required');
		$this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required');
		$this->form_validation->set_rules('refleksi_patella', 'Refleksi Patella', 'required');
		$this->form_validation->set_rules('djj', 'Denyut Jantung Janin', 'required');
		$this->form_validation->set_rules('kepala', 'Kepala Terhadap PAP', 'required');
		$this->form_validation->set_rules('berat_janin', 'Taksiran Berat Janin', 'required');
		$this->form_validation->set_rules('jumlah_janin', 'Jumlah Janin', 'required');
		$this->form_validation->set_rules('presentasi', 'Presentasi', 'required');
		$this->form_validation->set_rules('status_konseling', 'Status Konseling', 'required');
		$this->form_validation->set_rules('status_imunisasi', 'Status Imunisasi', 'required');
		$this->form_validation->set_rules('status_injeksi', 'Status Injeksi', 'required');
		$this->form_validation->set_rules('status_pencatatan', 'Status Pencatatan', 'required');
		$this->form_validation->set_rules('ps', 'PS', 'required');
		$this->form_validation->set_rules('hb', 'Hb', 'required');
		$this->form_validation->set_rules('protein_urine', 'Protein Urine', 'required');
		$this->form_validation->set_rules('gula_darah', 'Gula Darah', 'required');
		$this->form_validation->set_rules('status_thalasemia', 'Thalasemia', 'required');
		$this->form_validation->set_rules('status_sifilis', 'Sifilis', 'required');
		$this->form_validation->set_rules('hbsag', 'HbsAg', 'required');
		$this->form_validation->set_rules('vct', 'VCT', 'required');
		$this->form_validation->set_rules('serologi', 'serologi', 'required');
		$this->form_validation->set_rules('malaria', 'malaria', 'required');
		$this->form_validation->set_rules('tb', 'TB', 'required');
		$this->form_validation->set_rules('hdk', 'HDK', 'required');
		$this->form_validation->set_rules('abortus', 'Abortus', 'required');
		$this->form_validation->set_rules('pendarahan', 'Pendarahan', 'required');
		$this->form_validation->set_rules('infeksi', 'Infeksi', 'required');
		$this->form_validation->set_rules('kpd', 'Kpd', 'required');

		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('checkup/kehamilan_unverified_edit/'.$id);
		}else{
			$databidan				= get_profile();
			$id_desa				= id_desa();
			$id_user				= userid();
			$id_pemeriksaan			= inject($this->input->post('id_pemeriksaan'));
			$tanggal_periksa		= inject($this->input->post('tanggal_periksa'));
			$waktu_periksa			= inject($this->input->post('waktu_periksa'));
			$status_bpjs			= inject($this->input->post('status_bpjs'));
			$waktu_konsepsi			= inject($this->input->post('waktu_konsepsi'));
			$HPL					= inject($this->input->post('HPL'));
			$trimester				= inject($this->input->post('trimester'));
			$anamnesis				= inject($this->input->post('anamnesis'));
			$berat_badan			= inject($this->input->post('berat_badan'));
			$tinggi_badan			= inject($this->input->post('tinggi_badan'));
			$tekanan_a				= inject($this->input->post('tekanan_a'));
			$tekanan_b				= inject($this->input->post('tekanan_b'));
			$fundung_uterus			= inject($this->input->post('fundung_uterus'));
			$lingkar_lengan			= inject($this->input->post('lingkar_lengan'));
			$status_gizi			= inject($this->input->post('status_gizi'));
			$status_gizi			= inject($this->input->post('status_gizi'));
			$refleksi_patella		= inject($this->input->post('refleksi_patella'));
			$djj					= inject($this->input->post('djj'));
			$kepala					= inject($this->input->post('kepala'));
			$berat_janin			= inject($this->input->post('berat_janin'));
			$jumlah_janin			= inject($this->input->post('jumlah_janin'));
			$presentasi				= inject($this->input->post('presentasi'));
			$status_konseling		= inject($this->input->post('status_konseling'));
			$status_imunisasi		= inject($this->input->post('status_imunisasi'));
			$status_injeksi			= inject($this->input->post('status_injeksi'));
			$status_pencatatan		= inject($this->input->post('status_pencatatan'));
			$ps						= inject($this->input->post('ps'));
			$hb						= inject($this->input->post('hb'));
			$protein_urine			= inject($this->input->post('protein_urine'));
			$gula_darah				= inject($this->input->post('gula_darah'));
			$status_thalasemia		= inject($this->input->post('status_thalasemia'));
			$status_sifilis			= inject($this->input->post('status_sifilis'));
			$hbsag					= inject($this->input->post('hbsag'));
			$vct					= inject($this->input->post('vct'));
			$serologi				= inject($this->input->post('serologi'));
			$arv					= inject($this->input->post('arv'));
			$malaria				= inject($this->input->post('malaria'));
			$kelambu				= inject($this->input->post('kelambu'));
			$tb						= inject($this->input->post('tb'));
			$obat					= inject($this->input->post('obat'));
			$obat2					= inject($this->input->post('obat2'));
			$hdk					= inject($this->input->post('hdk'));
			$abortus				= inject($this->input->post('abortus'));
			$pendarahan				= inject($this->input->post('pendarahan'));
			$infeksi				= inject($this->input->post('infeksi'));
			$kpd					= inject($this->input->post('kpd'));
			$lain_lain				= inject($this->input->post('lain_lain'));
			$data_kehamilan	= array(
								'ubah_by'				=> $id_user,
								'id_ibu'				=> $id_ibu,
								'waktu_ubah'			=> date("Y/m/d h:i:s"),
								'waktu_konsepsi'		=> $waktu_konsepsi,
								'status_kehamilan'		=> 0,
								'HPL'					=> $HPL
							);
			$data_periksa	= array(
								'id_ibu'				=> $id_ibu,
								'ubah_by'				=> $id_user,
								'waktu_ubah'			=> date("Y-m-d h:i:s"),
								'status_bpjs'			=> $status_bpjs,
								'tanggal_periksa'		=> $tanggal_periksa,
								'waktu_periksa'			=> $waktu_periksa,
								'trimester'				=> $trimester,
								'anamnesis'				=> $anamnesis,
								'berat_badan'			=> $berat_badan,
								'tinggi_badan'			=> $tinggi_badan,
								'tekanan_a'				=> $tekanan_a,
								'tekanan_b'				=> $tekanan_b,
								'fundung_uterus'		=> $fundung_uterus,
								'lingkar_lengan'		=> $lingkar_lengan,
								'status_gizi'			=> $status_gizi,
								'refleksi_patella'		=> $refleksi_patella,
								'djj'					=> $djj,
								'kepala'				=> $kepala,
								'berat_janin'			=> $berat_janin,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'status_pencatatan'		=> $status_pencatatan,
								'ps'					=> $ps,
								'hb'					=> $hb,
								'protein_urine'			=> $protein_urine,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'arv'					=> $arv,
								'malaria'				=> $malaria,
								'kelambu'				=> $kelambu,
								'tb'					=> $tb,
								'obat'					=> $obat,
								'obat2'					=> $obat2,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd,
								'lain_lain'				=> $lain_lain
							);
			$data_boolean = array(
								'fundung_uterus'		=> $fundung_uterus,
								'status_gizi'			=> $status_gizi,
								'refleksi_patella'		=> $refleksi_patella,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'protein_urine'			=> $protein_urine,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'malaria'				=> $malaria,
								'tb'					=> $tb,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd
			);

           $data_periksa['status_resiko'] = $this->get_risk($data_periksa, $data_boolean, $data_kehamilan);

		   if($data_periksa['status_resiko'] != ''){
			   $this->m_kehamilan->update_kehamilan($data_kehamilan, $idk);
			   $this->m_pemeriksaan->update_pemeriksaan($data_periksa, $id_pemeriksaan);
			   $this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Mengubah Data Kohort"));
				redirect('checkup/kehamilan_unverified_daftar/');
		   }else{
			   echo "error";
		   }
		}
	}

	public function kehamilan_delete($id = '') {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('checkup/kehamilan_unverified_daftar');}

        $idk = simple_decrypt($id);
        $kehamilan   = $this->m_kehamilan->get_kehamilan_unverified_by_id($idk);
        $nik         = $kehamilan['nik'];
		$waktu_daftar= $kehamilan['waktu_daftar'];
		$pemeriksaan = $this->m_pemeriksaan->get_pemeriksaan_unverified_by_id($nik, $waktu_daftar);
		$idp		 = $pemeriksaan['id_pemeriksaan'];
        if(empty($kehamilan)){ redirect('checkup/kehamilan_unverified_daftar');}

        if ($id !='') {
			$data	= array('status_isi' => 0);
            $this->m_kehamilan->delete_kehamilan($idk);
            $this->m_pemeriksaan->delete_pemeriksaan($idp);
            $this->m_ibu->update_ibu($data, $nik);
            $this->session->set_flashdata('message', render_success('Berhasil!', 'Data kehamilan telah dihapus.'));
            redirect ('checkup/kehamilan_unverified_daftar');
        }else {
            redirect ('checkup/kehamilan_unverified_daftar');
        }
    }



	public function data_lahir_input($id = ''){
		if(!is_auth(2)) {redirect('discover/keluar');}

		$profile              	  	= get_profile();
		$id							= inject($id);
		$idk						= simple_decrypt($id);

		$kehamilan					= $this->m_kehamilan->get_kehamilan_by_id($idk);

		if(empty($kehamilan)) {redirect('checkup/kehamilan_berjalan_daftar');}
		if ($id != ''){
			$subdata['action']			= site_url('checkup/data_lahir_proses_input/'.$id);
			$subdata['get']				= $kehamilan;
			$data['title']              = 'Tambah Data Kelahiran';
            $data['meta_title']         = "Tambah Data Kelahiran";
            $data['meta_description']   = "Tambah Data Kelahiran Ibu";
			$data['breadcrumb_icon']    = "fa fa-table";
            $data['breadcrumb']         = "Antenatal Care~Data Pasien~Ubah Status";
			$data['content']            = render_view('bides/data_lahir_input', $subdata, true);
			render_view('template',$data);
		}else{
            redirect('checkup/kehamilan_berjalan_daftar');
        }

	}

	public function data_lahir_proses_input($id = ''){
		if(!is_auth(2)) {redirect('discover/keluar');}

		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('waktu_lahir', 'Waktu Lahir', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('lahir_by', 'Penolong Persalinan', 'required');

		if(empty($id)) {redirect('discover/keluar');}
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('checkup/data_lahir_input/'.$id);
		}else{
			$profile           	= get_profile();
			$bidan				= userid();
			$id					= inject($id);
			$idk				= simple_decrypt($id);
			$time				= date("Y-m-d h:i:s");
			$tanggal_lahir		= inject($this->input->post('tanggal_lahir'));
			$waktu_lahir		= inject($this->input->post('waktu_lahir'));
			$tempat_lahir		= inject($this->input->post('tempat_lahir'));
			$lahir_by			= inject($this->input->post('lahir_by'));
			$data				=array(
										'id_kehamilan'			=> $idk,
										'tanggal_lahir'			=> $tanggal_lahir,
										'waktu_lahir'			=> $waktu_lahir,
										'tempat_lahir'			=> $tempat_lahir,
										'lahir_by'				=> $lahir_by,
										'daftar_by'				=> $bidan
									);
			$data2				=array(
										'status_kehamilan' => 3,
										'waktu_akhir' => $time,
										'waktu_ubah' => $time,
										'ubah_by' => $bidan
									);
			$this->m_kehamilan->insert_kelahiran($data);
			$this->m_kehamilan->update_kehamilan($data2, $idk);
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Kelahiran Baru,Status Kehamilan Telah Diubah"));
			redirect('checkup/kehamilan_berjalan_daftar/');
		}
	}

	public function data_abortus_input($id = ''){
		if(!is_auth(2)) {redirect('discover/keluar');}

		$profile              	  	= get_profile();
		$id							= inject($id);
		$idk						= simple_decrypt($id);
		$kehamilan					= $this->m_kehamilan->get_kehamilan_by_id($idk);

		if(empty($kehamilan)) {redirect('checkup/kehamilan_berjalan_daftar');}

		if ($id != ''){
			$subdata['action']			= site_url('checkup/data_abortus_proses_input/'.$id);
			$subdata['get']				= $kehamilan;
			$data['title']              = 'Tambah Data Abortus';
            $data['meta_title']         = "Tambah Data Abortus";
            $data['meta_description']   = "Tambah Data Abortus Ibu";
			$data['breadcrumb_icon']    = "fa fa-table";
            $data['breadcrumb']         = "Antenatal Care~Data Pasien~Ubah Status";
			$data['content']            = render_view('bides/data_abortus_input', $subdata, true);
			render_view('template',$data);
		}else{
            redirect('checkup/kehamilan_berjalan_daftar');
        }

	}

	public function data_abortus_proses_input($id = ''){
		if(!is_auth(2)) {redirect('discover/keluar');}
		if(empty($id)) {redirect('discover/keluar');}

		$this->form_validation->set_rules('tanggal_abortus', 'Tanggal Abortus', 'required');
		$this->form_validation->set_rules('penyebab', 'Penyebab Abortus', 'required');
		$this->form_validation->set_rules('kondisi_ibu', 'Kondisi Ibu', 'required');


		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('checkup/data_abortus_input/'.$id);
		}else{
			$profile              	  	= get_profile();
			$bidan						= userid();
			$id							= inject($id);
			$idk						= simple_decrypt($id);
			$time						= date("Y-m-d h:i:s");
			$tanggal_abortus			= inject($this->input->post('tanggal_abortus'));
			$penyebab					= inject($this->input->post('penyebab'));
			$kondisi_ibu				= inject($this->input->post('kondisi_ibu'));
			$data						=array(
												'id_kehamilan'			=> $idk,
												'tanggal_abortus'		=> $tanggal_abortus,
												'penyebab'				=> $penyebab,
												'kondisi_ibu'			=> $kondisi_ibu,
												'daftar_by'				=> $bidan
											);
			$data2						=array(
												'status_kehamilan' => 4,
												'waktu_akhir' => $time,
												'waktu_ubah' => $time,
												'ubah_by' => $bidan
											);
			$this->m_kehamilan->insert_abortus($data);
			$this->m_kehamilan->update_kehamilan($data2, $idk);
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Abortus,Status Kehamilan Telah Diubah"));
			redirect('checkup/kehamilan_berjalan_daftar/');
		}
	}

	public function data_kematian_input($id = ''){
		if(!is_auth(2)) {redirect('discover/keluar');}

		$profile              	  	= get_profile();
		$id							= inject($id);
		$idk						= simple_decrypt($id);
		$kehamilan					= $this->m_kehamilan->get_kehamilan_by_id($idk);
		$nik						= simple_encrypt($kehamilan['nik']);

		if(empty($kehamilan)) {redirect('checkup/kehamilan_berjalan_daftar');}

		if ($id != ''){
			$subdata['action']			= site_url('checkup/data_kematian_proses_input/'.$id.'/'.$nik);
			$subdata['get']				= $kehamilan;
			$data['title']              = 'Tambah Data Kematian';
            $data['meta_title']         = "Tambah Data Kematian";
            $data['meta_description']   = "Tambah Data Kematian Ibu";
			$data['breadcrumb_icon']    = "fa fa-table";
            $data['breadcrumb']         = "Antenatal Care~Data Pasien~Ubah Status";
			$data['content']            = render_view('bides/data_kematian_input', $subdata, true);
			render_view('template',$data);
		}else{
            redirect('checkup/kehamilan_berjalan_daftar');
        }

	}

	public function data_kematian_proses_input($id = '', $nik = ''){
		if(!is_auth(2)) {redirect('discover/keluar');}
		if(empty($id)) {redirect('discover/keluar');}

		$this->form_validation->set_rules('tanggal_kematian', 'Tanggal Kematian', 'required');
		$this->form_validation->set_rules('penyebab', 'Penyebab Kematian', 'required');

		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('checkup/data_kematian_input/'.$id);
		}else{
			$profile              	  	= get_profile();
			$bidan						= userid();
			$time						= date("Y-m-d h:i:s");
			$idk						= simple_decrypt($id);
			$id_ibu						= simple_decrypt($nik);
			$tanggal_kematian			= inject($this->input->post('tanggal_kematian'));
			$penyebab					= inject($this->input->post('penyebab'));
			$data						=array(
												'id_kehamilan'			=> $idk,
												'tanggal_kematian'		=> $tanggal_kematian,
												'penyebab'				=> $penyebab,
												'daftar_by'				=> $bidan
											);

			$data2						=array(
												'status_kehamilan' => 5,
												'waktu_akhir' => $time,
												'waktu_ubah' => $time,
												'ubah_by' => $bidan
										);
			$this->m_kehamilan->update_kehamilan($data2, $idk);
			$this->m_ibu->delete_ibu($id_ibu, $time, $bidan);
			$this->m_kehamilan->insert_kematian($data);
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Kematian,Status Kehamilan Telah Diubah"));
			redirect('checkup/kehamilan_berjalan_daftar/');
		}
	}

	/*./Kehamilan*/

	/*Pemeriksaan*/
	public function pemeriksaan_input() {
		if(!is_auth(2)) {redirect('discover/keluar');}
		$profile               	    = get_profile();
		$id							= id_desa();
		$subdata['action']			= site_url('checkup/pemeriksaan_proses_input');
		$subdata['hasil']			= $this->m_kehamilan->get_kehamilan_berjalan_by_desa($id);
		$data['title']				= 'Tambah Data Pemeriksaan Baru';
		$data['meta_title']         = "Tambah Data Pemeriksaan Baru";
        $data['meta_description']   = "Tambah Data Pemeriksaan Baru Antenatal Care";
		$data['breadcrumb_icon']    = "fa fa-file-o";
        $data['breadcrumb']         = "Antenatal Care~Kohort~Tambah Pemeriksaan";
		$data['content']			= render_view('bides/input_pemeriksaan', $subdata, true);
		render_view('template', $data);
	}

	public function pemeriksaan_proses_input() {
		if(!is_auth(2)) {redirect('discover/keluar');}
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('id_ibu', 'Data Ibu', 'required');
		$this->form_validation->set_rules('tanggal_periksa', 'Tanggal Periksa', 'required');
		$this->form_validation->set_rules('waktu_periksa', 'Waktu Periksa', 'required');
		$this->form_validation->set_rules('status_bpjs', 'Status Bpjs', 'required');
		$this->form_validation->set_rules('trimester', 'Trimester', 'required');
		$this->form_validation->set_rules('berat_badan', 'Berat Badan', 'required');
		$this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'required');
		$this->form_validation->set_rules('tekanan_a', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('tekanan_b', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('fundung_uterus', 'Fundung Uterus', 'required');
		$this->form_validation->set_rules('lingkar_lengan', 'Lingkar Lengan', 'required');
		$this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required');
		$this->form_validation->set_rules('refleksi_patella', 'Refleksi Patella', 'required');
		$this->form_validation->set_rules('djj', 'Denyut Jantung Janin', 'required');
		$this->form_validation->set_rules('kepala', 'Kepala Terhadap PAP', 'required');
		$this->form_validation->set_rules('berat_janin', 'Taksiran Berat Janin', 'required');
		$this->form_validation->set_rules('jumlah_janin', 'Jumlah Janin', 'required');
		$this->form_validation->set_rules('presentasi', 'Presentasi', 'required');
		$this->form_validation->set_rules('status_konseling', 'Status Konseling', 'required');
		$this->form_validation->set_rules('status_imunisasi', 'Status Imunisasi', 'required');
		$this->form_validation->set_rules('status_injeksi', 'Status Injeksi', 'required');
		$this->form_validation->set_rules('status_pencatatan', 'Status Pencatatan', 'required');
		$this->form_validation->set_rules('ps', 'PS', 'required');
		$this->form_validation->set_rules('hb', 'Hb', 'required');
		$this->form_validation->set_rules('protein_urine', 'Protein Urine', 'required');
		$this->form_validation->set_rules('gula_darah', 'Gula Darah', 'required');
		$this->form_validation->set_rules('status_thalasemia', 'Thalasemia', 'required');
		$this->form_validation->set_rules('status_sifilis', 'Sifilis', 'required');
		$this->form_validation->set_rules('hbsag', 'HbsAg', 'required');
		$this->form_validation->set_rules('vct', 'VCT', 'required');
		$this->form_validation->set_rules('serologi', 'serologi', 'required');
		$this->form_validation->set_rules('malaria', 'malaria', 'required');
		$this->form_validation->set_rules('tb', 'TB', 'required');
		$this->form_validation->set_rules('hdk', 'HDK', 'required');
		$this->form_validation->set_rules('abortus', 'Abortus', 'required');
		$this->form_validation->set_rules('pendarahan', 'Pendarahan', 'required');
		$this->form_validation->set_rules('infeksi', 'Infeksi', 'required');
		$this->form_validation->set_rules('kpd', 'Kpd', 'required');

		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('checkup/pemeriksaan_input/');
		}else{
			$databidan				= get_profile();
			$id_desa				= id_desa();
			$id_user				= userid();
			$id_ibu					= inject($this->input->post('id_ibu'));
			$tanggal_periksa		= inject($this->input->post('tanggal_periksa'));
			$waktu_periksa			= inject($this->input->post('waktu_periksa'));
			$trimester				= inject($this->input->post('trimester'));
			$anamnesis				= inject($this->input->post('anamnesis'));
			$berat_badan			= inject($this->input->post('berat_badan'));
			$tinggi_badan			= inject($this->input->post('tinggi_badan'));
			$tekanan_a				= inject($this->input->post('tekanan_a'));
			$tekanan_b				= inject($this->input->post('tekanan_b'));
			$fundung_uterus			= inject($this->input->post('fundung_uterus'));
			$lingkar_lengan			= inject($this->input->post('lingkar_lengan'));
			$status_bpjs			= inject($this->input->post('status_bpjs'));
			$status_gizi			= inject($this->input->post('status_gizi'));
			$refleksi_patella		= inject($this->input->post('refleksi_patella'));
			$djj					= inject($this->input->post('djj'));
			$kepala					= inject($this->input->post('kepala'));
			$berat_janin			= inject($this->input->post('berat_janin'));
			$jumlah_janin			= inject($this->input->post('jumlah_janin'));
			$presentasi				= inject($this->input->post('presentasi'));
			$status_konseling		= inject($this->input->post('status_konseling'));
			$status_imunisasi		= inject($this->input->post('status_imunisasi'));
			$status_injeksi			= inject($this->input->post('status_injeksi'));
			$status_pencatatan		= inject($this->input->post('status_pencatatan'));
			$ps						= inject($this->input->post('ps'));
			$hb						= inject($this->input->post('hb'));
			$protein_urine			= inject($this->input->post('protein_urine'));
			$gula_darah				= inject($this->input->post('gula_darah'));
			$status_thalasemia		= inject($this->input->post('status_thalasemia'));
			$status_sifilis			= inject($this->input->post('status_sifilis'));
			$hbsag					= inject($this->input->post('hbsag'));
			$vct					= inject($this->input->post('vct'));
			$serologi				= inject($this->input->post('serologi'));
			$arv					= inject($this->input->post('arv'));
			$malaria				= inject($this->input->post('malaria'));
			$kelambu				= inject($this->input->post('kelambu'));
			$tb						= inject($this->input->post('tb'));
			$obat					= inject($this->input->post('obat'));
			$obat2					= inject($this->input->post('obat2'));
			$hdk					= inject($this->input->post('hdk'));
			$abortus				= inject($this->input->post('abortus'));
			$pendarahan				= inject($this->input->post('pendarahan'));
			$infeksi				= inject($this->input->post('infeksi'));
			$kpd					= inject($this->input->post('kpd'));
			$lain_lain				= inject($this->input->post('lain_lain'));
			$data_kehamilan	= $this->db->get_where('kehamilan', ['id_ibu' => $id_ibu,'status_kehamilan' => 1])->row_array();
			//dumper($data_kehamilan);
			$data_periksa	= array(
								'id_ibu'				=> $id_ibu,
								'daftar_by'				=> $id_user,
								'status_bpjs'			=> $status_bpjs,
								'tanggal_periksa'		=> $tanggal_periksa,
								'waktu_periksa'			=> $waktu_periksa,
								'waktu_daftar'			=> date("Y-m-d h:i:s"),
								'trimester'				=> $trimester,
								'anamnesis'				=> $anamnesis,
								'berat_badan'			=> $berat_badan,
								'tinggi_badan'			=> $tinggi_badan,
								'tekanan_a'				=> $tekanan_a,
								'tekanan_b'				=> $tekanan_b,
								'fundung_uterus'		=> $fundung_uterus,
								'lingkar_lengan'		=> $lingkar_lengan,
								'status_gizi'			=> $status_gizi,
								'djj'					=> $djj,
								'refleksi_patella'		=> $refleksi_patella,
								'kepala'				=> $kepala,
								'berat_janin'			=> $berat_janin,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'status_pencatatan'		=> $status_pencatatan,
								'ps'					=> $ps,
								'hb'					=> $hb,
								'protein_urine'			=> $protein_urine,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'arv'					=> $arv,
								'malaria'				=> $malaria,
								'kelambu'				=> $kelambu,
								'tb'					=> $tb,
								'obat'					=> $obat,
								'obat2'					=> $obat2,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd,
								'lain_lain'				=> $lain_lain
							);
			$data_boolean = array(
								'fundung_uterus'		=> $fundung_uterus,
								'status_gizi'			=> $status_gizi,
								'refleksi_patella'		=> $refleksi_patella,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'protein_urine'			=> $protein_urine,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'malaria'				=> $malaria,
								'tb'					=> $tb,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd
			);

            $data_periksa['status_resiko'] = $this->get_risk($data_periksa, $data_boolean, $data_kehamilan);

			$this->m_pemeriksaan->insert_pemeriksaan($data_periksa);

			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Pemeriksaan Baru"));
			redirect('checkup/pemeriksaan_input/');
		}
	}

	public function ajax_pemeriksaan($id = '') {
		$id = inject($id);
		$user  					  = $this->db->get_where('ibu', ['nik' => $id])->row_array();
		$kehamilan				  = $this->db->get_where('kehamilan', ['id_ibu' => $id, 'status_kehamilan' => 1])->row_array();
		$user['tanggal_lahir']	  = date_convert($user['tanggal_lahir']);
		$user['usia_kandungan']   = usia_hamil_convert($kehamilan['waktu_konsepsi']);
		$user['HPL'] 			  = date_convert($kehamilan['HPL']);
		echo json_encode($user);
	}

	public function pemeriksaan_unverified_daftar(){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile                	= get_profile();

		$data['meta_title']			= 'Daftar Pemeriksaan Belum Terverifikasi';
		$data['title']				= 'Daftar Pemeriksaan Belum Terverifikasi';
		$data['meta_description']   = "Daftar Pemeriksaan Belum Terverifikasi";
		$data['breadcrumb_icon']    = "fa fa-file-o";
        $data['breadcrumb']         = "Antenatal Care~Kohort~Daftar Pemeriksaan Belum Terverifikasi";
		$data['content']			= render_view('bides/pemeriksaan_unverified', '', true);
		render_view('template', $data);
	}


    public function source_pemeriksaan_unverified_list() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
        $id									= id_desa();
        if(is_auth(2)){
        $ibu							= $this->m_pemeriksaan->get_pemeriksaan_unverified_by_desa($id, $_POST, $limit, $start);
        }else if(is_auth([3,4])){
            $ibu							= $this->m_pemeriksaan->get_all_pemeriksaan_unverified($_POST, $limit, $start);
        }
        for($i=0; $i<count($ibu); $i++){
            $temp 							= $ibu[$i];
            $temp['usia_kandungan'] 		= usia_hamil_convert($temp['waktu_konsepsi']);
            $temp['HPL']  					= date_convert($temp['HPL']);
            $temp['color']		 			= color_convert($temp['status_resiko']);
            $temp['status_resiko'] 			= status_convert($temp['status_resiko']);
            $temp['id_desa']				= desa_convert($temp['id_desa']);
			$temp['color2']			 		= color_convert2($temp['status_verifikasi']);
			$temp['status_verifikasi'] 		= verifikasi_convert($temp['status_verifikasi']);
            $ibu[$i]			   			= $temp;
        }


        $result['content'] = render_view('bides/ajax_pemeriksaan_unverified', ['data' => $ibu , 'start' => $start, 'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($ibu) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }

	public function pemeriksaan_unverified_detail($id = ''){
		if(!is_auth(2)) {redirect('discover/keluar');}
        $id = inject($id);//
        if($id == ""){ redirect('checkup/pemeriksaan_unverified_daftar');}
		$idp 							= simple_decrypt($id);
		$waktu								= date("Y-m-d h:m:s");
		//$kehamilan['HPL']  					= date_convert($kehamilan['HPL']);
		$pemeriksaan 						= $this->m_pemeriksaan->get_pemeriksaan_unverified_by_idp($idp);
		//dumper($pemeriksaan);
		$ibu_id								= $pemeriksaan['id_ibu'];
		$kehamilan    						= $this->db->get_where('kehamilan', ['id_ibu' => $ibu_id, 'status_kehamilan' => '1'])->row_array();
		$data_ibu    						= $this->db->get_where('ibu', ['nik' => $ibu_id])->row_array();
		$kehamilan['nik']					= $data_ibu['nik'];
		$kehamilan['nama_ibu']				= $data_ibu['nama_ibu'];
		$kehamilan['alamat']				= $data_ibu['alamat'];
		$kehamilan['nomor_darurat']			= $data_ibu['nomor_darurat'];
		$kehamilan['tanggal_lahir']  		= umur_convert($data_ibu['tanggal_lahir']);
		$ibu								= simple_encrypt($ibu_id);
		$pemeriksaan['tanggal_periksa'] 	= date_convert($pemeriksaan['tanggal_periksa']);
		$pemeriksaan['status_resiko'] 		= status_convert($pemeriksaan['status_resiko']);
		$pemeriksaan['anamnesis'] 			= empty_convert($pemeriksaan['anamnesis']);
		$pemeriksaan['fundung_uterus'] 		= fundung_convert($pemeriksaan['fundung_uterus']);
		$pemeriksaan['status_gizi'] 		= gizi_convert($pemeriksaan['status_gizi']);
		$pemeriksaan['refleksi_patella'] 	= refleksi_convert($pemeriksaan['refleksi_patella']);
		$pemeriksaan['kepala'] 				= kepala_convert($pemeriksaan['kepala']);
		$pemeriksaan['catatan'] 			= empty_convert($pemeriksaan['catatan']);
		$pemeriksaan['jumlah_janin'] 		= janin_convert($pemeriksaan['jumlah_janin']);
		$pemeriksaan['presentasi'] 			= presentasi_convert($pemeriksaan['presentasi']);
		$pemeriksaan['status_konseling'] 	= pelayanan_convert($pemeriksaan['status_konseling']);
		$pemeriksaan['status_imunisasi'] 	= pelayanan_convert($pemeriksaan['status_imunisasi']);
		$pemeriksaan['status_injeksi'] 		= pelayanan_convert($pemeriksaan['status_injeksi']);
		$pemeriksaan['status_pencatatan'] 	= pelayanan_convert($pemeriksaan['status_pencatatan']);
		$pemeriksaan['protein_urine'] 		= komplikasi_convert($pemeriksaan['protein_urine']);
		$pemeriksaan['gula_darah'] 			= komplikasi_convert($pemeriksaan['gula_darah']);
		$pemeriksaan['status_thalasemia'] 	= komplikasi_convert($pemeriksaan['status_thalasemia']);
		$pemeriksaan['status_sifilis'] 		= komplikasi_convert($pemeriksaan['status_sifilis']);
		$pemeriksaan['hbsag'] 				= komplikasi_convert($pemeriksaan['hbsag']);
		$pemeriksaan['vct'] 				= komplikasi_convert($pemeriksaan['vct']);
		$pemeriksaan['arv'] 				= empty_convert($pemeriksaan['arv']);
		$pemeriksaan['serologi'] 			= komplikasi_convert($pemeriksaan['serologi']);
		$pemeriksaan['malaria'] 			= komplikasi_convert($pemeriksaan['malaria']);
		$pemeriksaan['obat'] 				= empty_convert($pemeriksaan['obat']);
		$pemeriksaan['kelambu'] 			= komplikasi_convert($pemeriksaan['kelambu']);
		$pemeriksaan['tb'] 					= komplikasi_convert($pemeriksaan['tb']);
		$pemeriksaan['obat2'] 				= empty_convert($pemeriksaan['obat2']);
		$pemeriksaan['hdk'] 				= komplikasi_convert($pemeriksaan['hdk']);
		$pemeriksaan['abortus'] 			= komplikasi_convert($pemeriksaan['abortus']);
		$pemeriksaan['pendarahan'] 			= komplikasi_convert($pemeriksaan['pendarahan']);
		$pemeriksaan['infeksi'] 			= komplikasi_convert($pemeriksaan['infeksi']);
		$pemeriksaan['kpd'] 				= komplikasi_convert($pemeriksaan['kpd']);
		$pemeriksaan['status_bpjs'] 		= bpjs_convert($pemeriksaan['status_bpjs']);
		$pemeriksaan['lain_lain'] 			= empty_convert($pemeriksaan['lain_lain']);
		$pemeriksaan['status_resiko']		= status_convert($pemeriksaan['status_resiko']);
		$rujukan							= $this->m_pemeriksaan->get_all_rujukan_by_id($kehamilan['id_kehamilan']);
        if(empty($kehamilan)){ redirect('checkup/kehamilan_unverified_daftar');}
        if ($id != '') {
            $subdata['action']     		= site_url('analysist/verifikasi_pemeriksaan/'.$id);;
            $subdata['get']       	    = $kehamilan;
            $subdata['h']	      	    = $pemeriksaan;
            $data['title']              = 'Informasi Detail Pemeriksaan';
            $data['meta_title']         = "Informasi Detail Pemeriksaan";
            $data['meta_description']   = "Informasi Detail Pemeriksaan Antenatal Care";
			$data['breadcrumb_icon']    = "fa fa-file-o";
            $data['breadcrumb']         = "Antenatal Care~Kohort~Detail Pemeriksaan Belum Terverifikasi";
            $data['content']            = render_view('bides/pemeriksaan_unverified_detail', $subdata, true);
            render_view('template',$data);
        } else{
            redirect('checkup/pemeriksaan_unverified_daftar');
        }
    }

	public function pemeriksaan_unverified_edit($id = ''){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile              	  		  = get_profile();

		$id								  = inject($id);
		$idp							  = simple_decrypt($id);
		$pemeriksaan					  = $this->m_pemeriksaan->get_pemeriksaan_unverified_by_idp($idp);
		$nik							  = $pemeriksaan['id_ibu'];
		//dumper($idp);
		$kehamilan						  = $this->db->get_where('kehamilan', ['id_ibu' => $nik, 'status_kehamilan' => '1'])->row_array();

		//if(empty($kehamilan)){ redirect('checkup/pemeriksaan_unverified_daftar');}
		$subdata['action']				  = site_url('checkup/pemeriksaan_unverified_proses_edit/'.$id);
		$subdata['get']					  = $kehamilan;
		$subdata['ibu']					  = $this->m_ibu->get_ibu_by_id($nik);
		$subdata['h']					  = $pemeriksaan;
		$data['title']					  = 'Ubah Data Pemeriksaan Baru';
		$data['meta_title']        		  = "Ubah Data Pemeriksaan Baru";
        $data['meta_description']  		  = "Ubah Data Pemeriksaan Baru";
		$data['breadcrumb_icon']    	  = "fa fa-file-o";
	    $data['breadcrumb']          	  = "Antenatal Care~Kohort~Ubah Pemeriksaan Baru";
		$data['content']				  = render_view('bides/edit_pemeriksaan', $subdata, true);
		render_view('template', $data);
	}

	public function pemeriksaan_unverified_proses_edit($id = ''){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile              	  		  = get_profile();

		$id		= inject($id);
		$idp	= simple_decrypt($id);

		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('tanggal_periksa', 'Tanggal Periksa', 'required');
		$this->form_validation->set_rules('waktu_periksa', 'Waktu Periksa', 'required');
		$this->form_validation->set_rules('status_bpjs', 'Status Bpjs', 'required');
		$this->form_validation->set_rules('usia_kandungan_daftar', 'Usia Hamil', 'required');
		$this->form_validation->set_rules('HPL', 'HPL', 'required');
		$this->form_validation->set_rules('trimester', 'Trimester', 'required');
		$this->form_validation->set_rules('berat_badan', 'Berat Badan', 'required');
		$this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'required');
		$this->form_validation->set_rules('tekanan_a', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('tekanan_b', 'Tekanan Darah', 'required');
		$this->form_validation->set_rules('fundung_uterus', 'Fundung Uterus', 'required');
		$this->form_validation->set_rules('lingkar_lengan', 'Lingkar Lengan', 'required');
		$this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required');
		$this->form_validation->set_rules('refleksi_patella', 'Refleksi Patella', 'required');
		$this->form_validation->set_rules('djj', 'Denyut Jantung Janin', 'required');
		$this->form_validation->set_rules('kepala', 'Kepala Terhadap PAP', 'required');
		$this->form_validation->set_rules('berat_janin', 'Taksiran Berat Janin', 'required');
		$this->form_validation->set_rules('jumlah_janin', 'Jumlah Janin', 'required');
		$this->form_validation->set_rules('presentasi', 'Presentasi', 'required');
		$this->form_validation->set_rules('status_konseling', 'Status Konseling', 'required');
		$this->form_validation->set_rules('status_imunisasi', 'Status Imunisasi', 'required');
		$this->form_validation->set_rules('status_injeksi', 'Status Injeksi', 'required');
		$this->form_validation->set_rules('status_pencatatan', 'Status Pencatatan', 'required');
		$this->form_validation->set_rules('ps', 'PS', 'required');
		$this->form_validation->set_rules('hb', 'Hb', 'required');
		$this->form_validation->set_rules('protein_urine', 'Protein Urine', 'required');
		$this->form_validation->set_rules('gula_darah', 'Gula Darah', 'required');
		$this->form_validation->set_rules('status_thalasemia', 'Thalasemia', 'required');
		$this->form_validation->set_rules('status_sifilis', 'Sifilis', 'required');
		$this->form_validation->set_rules('hbsag', 'HbsAg', 'required');
		$this->form_validation->set_rules('vct', 'VCT', 'required');
		$this->form_validation->set_rules('serologi', 'serologi', 'required');
		//$this->form_validation->set_rules('arv', 'arv', 'required');
		$this->form_validation->set_rules('malaria', 'malaria', 'required');
		$this->form_validation->set_rules('tb', 'TB', 'required');
		$this->form_validation->set_rules('hdk', 'HDK', 'required');
		$this->form_validation->set_rules('abortus', 'Abortus', 'required');
		$this->form_validation->set_rules('pendarahan', 'Pendarahan', 'required');
		$this->form_validation->set_rules('infeksi', 'Infeksi', 'required');
		$this->form_validation->set_rules('kpd', 'Kpd', 'required');

		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('checkup/kehamilan_unverified_edit/'.$id);
		}else{
			$databidan				= get_profile();
			$id_desa				= id_desa();
			$id_user				= userid();
			$tanggal_periksa		= inject($this->input->post('tanggal_periksa'));
			$waktu_periksa			= inject($this->input->post('waktu_periksa'));
			$status_bpjs			= inject($this->input->post('status_bpjs'));
			$usia_kandungan_daftar	= inject($this->input->post('usia_kandungan_daftar'));
			$HPL					= inject($this->input->post('HPL'));
			$trimester				= inject($this->input->post('trimester'));
			$anamnesis				= inject($this->input->post('anamnesis'));
			$berat_badan			= inject($this->input->post('berat_badan'));
			$tinggi_badan			= inject($this->input->post('tinggi_badan'));
			$tekanan_a				= inject($this->input->post('tekanan_a'));
			$tekanan_b				= inject($this->input->post('tekanan_b'));
			$fundung_uterus			= inject($this->input->post('fundung_uterus'));
			$lingkar_lengan			= inject($this->input->post('lingkar_lengan'));
			$status_gizi			= inject($this->input->post('status_gizi'));
			$status_gizi			= inject($this->input->post('status_gizi'));
			$refleksi_patella		= inject($this->input->post('refleksi_patella'));
			$djj					= inject($this->input->post('djj'));
			$kepala					= inject($this->input->post('kepala'));
			$berat_janin			= inject($this->input->post('berat_janin'));
			$jumlah_janin			= inject($this->input->post('jumlah_janin'));
			$presentasi				= inject($this->input->post('presentasi'));
			$status_konseling		= inject($this->input->post('status_konseling'));
			$status_imunisasi		= inject($this->input->post('status_imunisasi'));
			$status_injeksi			= inject($this->input->post('status_injeksi'));
			$status_pencatatan		= inject($this->input->post('status_pencatatan'));
			$ps						= inject($this->input->post('ps'));
			$hb						= inject($this->input->post('hb'));
			$protein_urine			= inject($this->input->post('protein_urine'));
			$gula_darah				= inject($this->input->post('gula_darah'));
			$status_thalasemia		= inject($this->input->post('status_thalasemia'));
			$status_sifilis			= inject($this->input->post('status_sifilis'));
			$hbsag					= inject($this->input->post('hbsag'));
			$vct					= inject($this->input->post('vct'));
			$serologi				= inject($this->input->post('serologi'));
			$arv					= inject($this->input->post('arv'));
			$malaria				= inject($this->input->post('malaria'));
			$kelambu				= inject($this->input->post('kelambu'));
			$tb						= inject($this->input->post('tb'));
			$obat					= inject($this->input->post('obat'));
			$obat2					= inject($this->input->post('obat2'));
			$hdk					= inject($this->input->post('hdk'));
			$abortus				= inject($this->input->post('abortus'));
			$pendarahan				= inject($this->input->post('pendarahan'));
			$infeksi				= inject($this->input->post('infeksi'));
			$kpd					= inject($this->input->post('kpd'));
			$lain_lain				= inject($this->input->post('lain_lain'));
			$data_kehamilan	= array(
								'usia_kandungan_daftar'	=> $usia_kandungan_daftar,
								'HPL'					=> $HPL
							);
			$data_periksa	= array(
								'ubah_by'				=> $id_user,
								'waktu_ubah'			=> date("Y-m-d h:i:s"),
								'status_bpjs'			=> $status_bpjs,
								'tanggal_periksa'		=> $tanggal_periksa,
								'waktu_periksa'			=> $waktu_periksa,
								'trimester'				=> $trimester,
								'anamnesis'				=> $anamnesis,
								'berat_badan'			=> $berat_badan,
								'tinggi_badan'			=> $tinggi_badan,
								'tekanan_a'				=> $tekanan_a,
								'tekanan_b'				=> $tekanan_b,
								'fundung_uterus'		=> $fundung_uterus,
								'lingkar_lengan'		=> $lingkar_lengan,
								'status_gizi'			=> $status_gizi,
								'refleksi_patella'		=> $refleksi_patella,
								'djj'					=> $djj,
								'kepala'				=> $kepala,
								'berat_janin'			=> $berat_janin,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'status_pencatatan'		=> $status_pencatatan,
								'ps'					=> $ps,
								'hb'					=> $hb,
								'protein_urine'			=> $protein_urine,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'arv'					=> $arv,
								'malaria'				=> $malaria,
								'kelambu'				=> $kelambu,
								'tb'					=> $tb,
								'obat'					=> $obat,
								'obat2'					=> $obat2,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd,
								'lain_lain'				=> $lain_lain
							);
			$data_boolean = array(
								'fundung_uterus'		=> $fundung_uterus,
								'status_gizi'			=> $status_gizi,
								'refleksi_patella'		=> $refleksi_patella,
								'jumlah_janin'			=> $jumlah_janin,
								'presentasi'			=> $presentasi,
								'status_konseling'		=> $status_konseling,
								'status_imunisasi'		=> $status_imunisasi,
								'status_injeksi'		=> $status_injeksi,
								'protein_urine'			=> $protein_urine,
								'gula_darah'			=> $gula_darah,
								'status_thalasemia'		=> $status_thalasemia,
								'status_sifilis'		=> $status_sifilis,
								'hbsag'					=> $hbsag,
								'vct'					=> $vct,
								'serologi'				=> $serologi,
								'malaria'				=> $malaria,
								'tb'					=> $tb,
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd
			);

           $data_periksa['status_resiko'] = $this->get_risk($data_periksa, $data_boolean, $data_kehamilan);

		   if($data_periksa['status_resiko'] != ''){
			   $this->m_pemeriksaan->update_pemeriksaan($data_periksa, $idp);
			   $this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Mengubah Data Kohort"));
				redirect('checkup/pemeriksaan_unverified_daftar/');
		   }else{
			   echo "error";
		   }
		}
	}

	public function pemeriksaan_delete($id = '') {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('checkup/pemeriksaan_unverified_daftar');}

        $idp = simple_decrypt($id);
        $pemeriksaan    = $this->m_pemeriksaan->get_pemeriksaan_unverified_by_idp($idp);
        if(empty($pemeriksaan)){ redirect('doctor/user_daftar');}

        if ($id !='') {
            $this->m_pemeriksaan->delete_pemeriksaan($idp);

             $this->session->set_flashdata('message', render_success('Berhasil!', 'Data pemeriksaan telah dihapus.'));
            redirect ('checkup/pemeriksaan_unverified_daftar');
        }else {
            redirect ('checkup/pemeriksaan_unverifieddaftar');
        }
    }
	/*./Pemeriksaan*/

	/*Kegiatan rujukan*/
	public function rujukan_input(){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile              	  	= get_profile();
		$id	    		 			= id_desa();
		$subdata['hasil']			= $this->m_kehamilan->get_kehamilan_berjalan_by_desa($id);
		$subdata['action']	  		= site_url('checkup/rujukan_proses_input/');
		$data['title']				= 'Menambah Data Rujukan Baru';
		$data['meta_title']         = "Menambah Data Rujukan Baru";
        $data['meta_description']   = "Menambah Data Rujukan Baru";
		$data['breadcrumb_icon']    = "fa fa-table";
        $data['breadcrumb']         = "Antenatal Care~Data Pasien~Tambah Rujukan";
		$data['content']			= render_view('bides/input_rujukan', $subdata, true);
		render_view('template',$data);
	}

	public function rujukan_proses_input() {
		if(!is_auth()) {redirect('discover/keluar');}
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('id_kehamilan', 'Data Ibu', 'required');
		$this->form_validation->set_rules('pendeteksi_resiko', 'Pendeteksi Resiko', 'required');
		$this->form_validation->set_rules('tanggal_rujukan', 'Tanggal Rujukan', 'required');
		$this->form_validation->set_rules('tempat_rujukan', 'Tempat Rujukan', 'required');
		$this->form_validation->set_rules('keadaan_tiba', 'Keadaan Tiba', 'required');
		$this->form_validation->set_rules('keadaan_pulang', 'Keadaan Pulang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', render_error('Validasi Error', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('checkup/rujukan_input/');
		}else{
			$profile       	    = get_profile();
			$id_desa			= id_desa();
			$id_user			= userid();
			$id_kehamilan		= inject($this->input->post('id_kehamilan'));
			$pendeteksi_resiko	= inject($this->input->post('pendeteksi_resiko'));
			$tanggal_rujukan	= inject($this->input->post('tanggal_rujukan'));
			$tempat_rujukan		= inject($this->input->post('tempat_rujukan'));
			$keadaan_tiba		= inject($this->input->post('keadaan_tiba'));
			$keadaan_pulang		= inject($this->input->post('keadaan_pulang'));
				$data			= array(
									'id_kehamilan'			=> $id_kehamilan,
									'pendeteksi_resiko'		=> $pendeteksi_resiko,
									'tanggal_rujukan'		=> $tanggal_rujukan,
									'tempat_rujukan'		=> $tempat_rujukan,
									'keadaan_tiba'			=> $keadaan_tiba,
									'keadaan_pulang'		=> $keadaan_pulang,
									'waktu_daftar'			=> date("Y-m-d h:i:s"),
									'daftar_by'				=> $id_user
								);
			$this->m_kehamilan->insert_rujukan($data);
			$this->session->set_flashdata('message',render_success('Berhasil!', 'Data rujukan telah ditambahkan'));
			redirect('patient/ibu_input/');
		}
	}

	public function rujukan_berjalan_daftar(){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile                	= get_profile();

		$data['meta_title']			= 'Daftar Rujukan Berjalan';
		$data['title']				= 'Daftar Rujukan Berjalan';
		$data['meta_description']   = "Daftar Rujukan Berjalan Antenatal Care";
        $data['breadcrumb_icon']    = "fa fa-table";
        $data['breadcrumb']         = "Antenatal Care~Data Pasien~Daftar Rujukan Berjalan";
		$data['content']			= render_view('rujukan_berjalan', "", true);
		render_view('template', $data);
	}

    public function source_rujukan_berjalan_daftar() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
        $id		 = id_desa();

		if(is_auth(2)){
		$rujukan						= $this->m_kehamilan->get_rujukan_by_desa($id,  $_POST, $limit + 1, $start);
		}else if(is_auth([3,4])){
		$rujukan						= $this->m_kehamilan->get_all_rujukan($_POST, $limit + 1, $start);
		}
		for($i=0; $i<count($rujukan); $i++){
			$temp 							= $rujukan[$i];
			$temp['usia_kandungan_daftar']  = usia_hamil_convert($temp['usia_kandungan_daftar'],$temp['waktu_daftar']);
			$temp['id_desa']				= desa_convert($temp['id_desa']);
			$temp['tanggal_rujukan']		= date_convert($temp['tanggal_rujukan']);
			$temp['pendeteksi_resiko']		= pendeteksi_convert($temp['pendeteksi_resiko']);
			$rujukan[$i]			   		= $temp;
		}

        $result['content'] = render_view('ajax_rujukan_berjalan', ['data' => $rujukan ,  'start' => $start, 'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($rujukan) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }
	/*./Kegiatan rujukan*/
}
?>
