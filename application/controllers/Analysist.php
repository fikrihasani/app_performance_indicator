<?php 
Class Analysist extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('m_ibu');
		$this->load->model('m_kehamilan');
		$this->load->model('m_pemeriksaan');
    }
	/*Kehamilan*/
	public function verifikasi_kehamilan($id = '', $nik=''){                                        
		if(!is_auth()) {redirect('discover/keluar');}

        $id = inject($id);
        $nik = inject($nik);
		$user = userid();
		$status_resiko			= inject($this->input->post('status_resiko'));
        if($id == ""){ redirect('checkup/kehamilan_unverified_daftar');}
        $idp 	= simple_decrypt($id);
		$ibu_id				= simple_decrypt($nik);
        if ($idp != '') {
			$time = date("Y-m-d h:i:s");
            $this->m_kehamilan->set_kehamilan_verified($ibu_id, $time, $user);
			$data2 = array('status_verifikasi' => 1, 'status_resiko' => $status_resiko,'waktu_ubah' => $time, 'ubah_by' => $user);
            $this->m_pemeriksaan->set_pemeriksaan_verified($idp, $data2);
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Melakukan verifikasi,Status Kehamilan Telah Diubah"));
            redirect('checkup/kehamilan_unverified_daftar');
        } else{
            redirect('checkup/kehamilan_unverified_daftar');
        }
    }  
	
	public function unverifikasi_kehamilan($id = ''){                                        
		if(!is_auth()) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('checkup/kehamilan_berjalan_daftar');}
		$idk						= simple_decrypt($id);
		$kehamilan					= $this->m_kehamilan->get_kehamilan_unverified_by_id($idk);
        $subdata['action']			= site_url('analysist/unverifikasi_kehamilan_proses_input/'.$id);
		$subdata['get']				= $kehamilan;
		$data['title']              = 'Tambah Catatan';
		$data['meta_title']         = "Tambah Catatan";
		$data['meta_description']   = "Tambah Catatan";
		$data['breadcrumb_icon']    = "fa fa-file-o";
		$data['breadcrumb']         = "Antenatal Care~Kohort~Unverifikasi";
		$data['content']            = render_view('bikor/unverifikasi_kehamilan', $subdata, true);
		render_view('template',$data);
    }

	public function unverifikasi_kehamilan_proses_input($id = ''){
		if(!is_auth()) {redirect('discover/keluar');}
		
		$id = inject($id);
		$idk = simple_decrypt($id);
		
		$this->form_validation->set_rules('catatan', 'Catatan Untuk Bidan Desa', 'required');
		if(empty($id)) {redirect('discover/keluar');}
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('analysist/unverifikasi_kehamilan/'.$id);
		}else{
			$kehamilan    	= $this->m_kehamilan->get_kehamilan_unverified_by_id($idk);
			$bidan			= userid();
			$time 			= date("Y-m-d h:i:s");
			$ibu_id			= $kehamilan['nik'];
			$pemeriksaan 	= $this->m_pemeriksaan->get_pemeriksaan_unverified_by_id($ibu_id, $kehamilan['waktu_daftar']);
			$idp			= $pemeriksaan['id_pemeriksaan'];
			$catatan		= inject($this->input->post('catatan'));
			$data			= array(
									'catatan'			=> $catatan,
									'ubah_by'			=> $bidan,
									'waktu_ubah'		=> date("Y-m-d h:m:s"),
								);
			$data2			= array(
									'status_kehamilan'  => 2,
									'waktu_ubah'		=> date("Y-m-d h:m:s"),
									'ubah_by'			=> $bidan
								);
		
            $this->m_kehamilan->set_kehamilan_unverified($idk, $data2);
            $this->m_pemeriksaan->insert_catatan($idp, $data);
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambah Catatan,Status Kehamilan Telah Diubah"));
			redirect('checkup/kehamilan_unverified_daftar/');
		}		
	}
	/*Kehamilan*/
	
	/*Pemeriksaan*/
	public function verifikasi_pemeriksaan($id = ''){                                        
		if(!is_auth()) {redirect('discover/keluar');}

        $id = inject($id);
		$user = userid();
        if($id == ""){ redirect('checkup/kehamilan_berjalan_daftar');}
        $idp 				= simple_decrypt($id);
        if ($id != '') {
			$time = date("Y-m-d h:i:s");
			$data = array('status_verifikasi' => 1, 'waktu_ubah' => $time, 'ubah_by' => $user);
            $this->m_pemeriksaan->set_pemeriksaan_verified($idp, $data);
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Melakukan verifikasi,Status Pemeriksaan Telah Diubah"));
            redirect('checkup/pemeriksaan_unverified_daftar');
        } else{
            redirect('checkup/pemeriksaan_unverified_daftar');
        }
    } 

	public function unverifikasi_pemeriksaan($nik = '', $id = ''){                                        
		if(!is_auth()) {redirect('discover/keluar');}

        $nik = inject($nik);
		$id  = inject($id);
        if($id == ""){ redirect('checkup/kehamilan_berjalan_daftar');}
		$id_ibu						= simple_decrypt($nik);
		$ibu						= $this->m_ibu->get_ibu_by_id($id_ibu);
        $subdata['action']			= site_url('analysist/unverifikasi_pemeriksaan_proses_input/'.$id);
		$subdata['get']				= $ibu;
		$data['title']              = 'Tambah Catatan';
		$data['meta_title']         = "Tambah Catatan";
		$data['meta_description']   = "Tambah Catatan";
		$data['breadcrumb_icon']    = "fa fa-file-o";
		$data['breadcrumb']         = "Antenatal Care~Kohort~Unverifikasi Pemeriksaan";
		$data['content']            = render_view('bikor/unverifikasi_pemeriksaan', $subdata, true);
		render_view('template',$data);
    }
	
	public function unverifikasi_pemeriksaan_proses_input($id = ''){
		if(!is_auth()) {redirect('discover/keluar');}
		
		$id = inject($id);
		$idp = simple_decrypt($id);
		
		$this->form_validation->set_rules('catatan', 'Catatan Untuk Bidan Desa', 'required');
		if(empty($id)) {redirect('discover/keluar');}
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('analysist/unverifikasi_pemeriksaan/'.$id);
		}else{
			$bidan			= userid();
			$time 			= date("Y-m-d h:i:s");
			$catatan		= inject($this->input->post('catatan'));
			$data			= array(
									'catatan'			=> $catatan,
									'ubah_by'			=> $bidan,
									'waktu_ubah'		=> date("Y-m-d h:m:s"),
									'status_verifikasi'	=> 2
								);
		
            $this->m_pemeriksaan->set_pemeriksaan_unverified($idp, $data);
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambah Catatan,Status Kehamilan Telah Diubah"));
			redirect('checkup/pemeriksaan_unverified_daftar/');
		}		
	}
	/*./Pemeriksaan*/
}
?>