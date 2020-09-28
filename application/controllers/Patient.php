<?php
Class Patient extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('m_ibu');
    }

	/*Ibu*/
	public function ibu_input(){
		if(!is_auth()) {redirect('discover/keluar');}
		$profile              	  	= get_profile();
		$subdata['action']	  		= site_url('patient/ibu_proses_input/');
		$data['title']				= 'Menambah Data Pasien Baru';
		$data['meta_title']         = "Tambah Data Pasien";
        $data['meta_description']   = "Tambah Data Pasien ";
		$data['breadcrumb_icon']    = "fa fa-user";
        $data['breadcrumb']         = "Antenatal Care~Pasien~Tambah";
		$data['content']			= render_view('bides/input_ibu', $subdata, true);
		render_view('template',$data);
	}

	public function ibu_proses_input() {
		if(!is_auth()) {redirect('discover/keluar');}
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('nik', 'Nomor Induk Kependudukan', 'required');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir Ibu', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('nomor_darurat', 'Nomor Darurat', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', render_error('Validasi Error', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
			redirect('patient/ibu_input/');
		}else{
			$profile        = get_profile();
			$id_desa		= id_desa();
			$id_user		= userid();
			$nik			= inject($this->input->post('nik'));
			$nama_ibu		= inject($this->input->post('nama_ibu'));
			$tanggal_lahir	= inject($this->input->post('tanggal_lahir'));
			$alamat			= inject($this->input->post('alamat'));
			$nomor_darurat	= inject($this->input->post('nomor_darurat'));
			$data			= array(
								'nik'				=> $nik,
								'nama_ibu'			=> $nama_ibu,
								'tanggal_lahir'		=> $tanggal_lahir,
								'id_desa'			=> $id_desa,
								'alamat'			=> $alamat,
								'nomor_darurat'		=> $nomor_darurat,
								'waktu_daftar'		=> date("Y/m/d h:i:s"),
								'daftar_by'			=> $id_user,

							);
			$this->m_ibu->insert_ibu($data);
			$this->session->set_flashdata('message',render_success('Berhasil!', 'Data ibu telah ditambahkan'));
			redirect('patient/ibu_input/');
		}
	}

	public function ibu_daftar(){
        if(!is_auth(2)) {redirect('discover/keluar');}
		$profile           	  	    = get_profile();
    	$id					        = id_desa();
		$subdata['hasil']			= $this->m_ibu->get_ibu_by_desa($id);
        $data['title']              = 'Pasien';
        $data['meta_title']         = "Daftar Pasien";
        $data['meta_description']   = "Daftar Ibu Antenatal Care";
		$data['breadcrumb_icon']    = "fa fa-user";
        $data['breadcrumb']         = "Antenatal Care~Pasien~Daftar";
        $data['content']            = render_view('bides/ibu', $subdata, true);
        render_view('template', $data);
    }

    public function source_ibu_list() {
        //variable
        $page        = inject($_POST['current_page']);

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
        $id		 = id_desa();


        $content = $this->m_ibu->get_ibu_by_desa($id, $_POST, $limit + 1, $start);

        $result['content'] = render_view('bides/ajax_ibu', ['data' => $content , 'start' => $start, 'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }

	public function ibu_edit($id = ''){
        if(!is_auth(2)) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('patient/ibu_daftar');}
        $user_id = simple_decrypt($id); //dumper($user_id);
        $user    = $this->m_ibu->get_ibu_by_id($user_id);
		//dumper($user);
        if(empty($user)){ redirect('patient/ibu_daftar');}

        if ($id != '') {
			$profile           	  	    = get_profile();
            $subdata['action']     	    = site_url('patient/ibu_proses_edit/'.$id);
            $subdata['get']        		= $user;
            $data['title']              = 'Ubah Data Ibu';
            $data['meta_title']         = "Ubah Data Ibu";
            $data['meta_description']   = "Ubah Data Ibu Antenatal Care";
            $data['breadcrumb_icon']    = "fa fa-user";
            $data['breadcrumb']         = "Antenatal Care~Pasien~Ubah";
            $data['content']            =render_view('bides/edit_ibu', $subdata, true);

            render_view('template',$data);
        } else{
            redirect('patient/ibu_daftar');
        }
    }

	public function ibu_proses_edit($id = ''){
        if(!is_auth(2)) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('patient/ibu_daftar');}

        $user_id = simple_decrypt($id); //dumper($user_id);
        $user    = $this->m_ibu->get_ibu_by_id($user_id);
        if(empty($user)){ redirect('patient/ibu_daftar');}
        //dumper($user);
        if ($id != '') {
            $this->form_validation->set_rules('nik', 'NIK', 'required');
            $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
            $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('alamat', 'alamat', 'required');
            $this->form_validation->set_rules('nomor_darurat', 'Nomor Darurat', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', render_error('Validasi Error', validation_errors()));
                redirect('patient/ibu_edit/'.$id);
            } else {
				$profile        = get_profile();
				$id_desa		= id_desa();
				$id_user		= userid();
                $nik            = inject($this->input->post('nik'));
                $nama_ibu       = inject($this->input->post('nama_ibu'));
                $tgl_lahir      = inject($this->input->post('tanggal_lahir'));
                $alamat	        = inject($this->input->post('alamat'));
                $nomor_darurat  = inject($this->input->post('nomor_darurat'));
                $data           = array(
                                'nik'         			 => $nik,
                                'nama_ibu'      	     => $nama_ibu,
                                'tanggal_lahir'          => $tgl_lahir,
                                'alamat'     			 => $alamat,
                                'nomor_darurat'     	 => $nomor_darurat,
								'waktu_ubah'   			 => date("Y/m/d h:i:s"),
								'ubah_by'				=> $id_user,
                );
                $this->m_ibu->update_ibu($data, $user_id);
                $this->session->set_flashdata('message', render_success('Berhasil!', 'Data Ibu telah diubah.'));
                redirect('patient/ibu_edit/'.$id);
            }
        } else{
            redirect('patient/ibu_daftar');
        }
    }

	public function ibu_delete($id = '') {
        if(!is_auth(2)) {redirect('patient/ibu_daftar');}

        $id = inject($id);
		$ibu_id = simple_decrypt($id);
        if($id == ""){ redirect('patient/ibu_daftar');}

         //dumper($user_id);
        //$user    = $this->m_users->get_ibu_by_id($user_id);
        if(empty($ibu_id)){ redirect('patient/ibu_daftar');}
        if ($id !='') {
            $this->m_ibu->delete_ibu($ibu_id);
            $this->session->set_flashdata('message', render_success('Berhasil!', 'Data Ibu telah dihapus.'));
            redirect ('patient/ibu_daftar');
        }else {
            redirect ('patient/ibu_daftar');
        }
    }
	/*Ibu*/

	/*Ajax Ibu*/
	public function ajax_ibu($id = ''){
		if(!is_auth(2)) {redirect('patient/ibu_daftar');}
		
		$id = inject($id);
		//$ibu_id = simple_decrypt($id);
        if($id == ""){ redirect('patient/ibu_daftar');}
		
		$result    = $this->m_ibu->get_ibu_by_id($id);
		$result['tanggal_lahir'] = date_convert($result['tanggal_lahir']);
		echo json_encode($result);
	}
	/*Ajax Ibu*/
}
?>
