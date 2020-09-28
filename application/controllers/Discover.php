<?php
Class Discover extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_ibu');
        $this->load->model('m_kehamilan');
        $this->load->model('m_users');
    }

    //Index() : Untuk Akses Dashboard perlu login terlebih dahulu
    public function index() {
        if(is_auth()) {
            redirect('discover/dashboard');
        }
        //dumper(is_auth());
        render_view('login');
    }

    //Masuk() : Fungsi Login, Create Session
    public function masuk() {

        $akun = array(
            'username' => inject($this->input->post('username')),
            'password' => md5(inject($this->input->post('password')))
        );

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('message',render_error("Perhatian!", "Username dan Password tidak boleh kosong"));
            redirect('discover');
        } else {
            $query = $this->m_login->get_user($akun);
            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                $this->session->set_userdata('pengguna',$row );
                redirect('discover/dashboard');
            }
            else{
                $this->session->set_flashdata('message',render_error("Perhatian!", "Username / Password yang anda masukkan salah."));
                redirect('discover');
            }
        }
    }


    //Keluar: Fungsi Logout
    public function keluar(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', render_success('Logout Berhasil', "Anda Berhasil Logout"));
        redirect('discover');
    }


    //Dashboard() : Menampilkan Dashboard Masing Masing User
    public function dashboard() {
        if(!is_auth(array(1,2,3,4))) { redirect('discover/keluar'); }

        //dumper(get_profile());

        $dataku = get_profile();
        $level = level();

        $subdata['username']      		    = username();
		$data['title']						= 'Beranda';
		$data['meta_title']        		  	= "Beranda";
		$data['meta_description']  		  	= "Beranda Antenatal Care";
		$data['breadcrumb_icon']  		  	= "fa fa-dashboard";
		$data['breadcrumb']          	  	= "Antenatal Care~Beranda";
        if ($level == '1'){
			$subdata['jml_pengguna']		  = $this->m_users->count_user_all();
			$subdata['jml_kehamilan_baru']	  = $this->m_kehamilan->count_kehamilan_th_all();;
			$subdata['jml_kehamilan_berj']	  = $this->m_kehamilan->count_kehamilan_berj_all();
			$subdata['jml_abortus']			  = $this->m_kehamilan->count_kehamilan_xx_all();
			$data['content']				  = render_view('admin/beranda', $subdata, true);
			render_view('template', $data);
        }else if ($level == '2'){
			$idd							  = id_desa();
			$subdata['jml_ibu']				  = $this->m_ibu->count_ibu_desa($idd);
			$subdata['jml_kehamilan_baru']	  = $this->m_kehamilan->count_kehamilan_th_desa($idd);;
			$subdata['jml_kehamilan_berj']	  = $this->m_kehamilan->count_kehamilan_berj_desa($idd);
			$subdata['jml_abortus']			  = $this->m_kehamilan->count_kehamilan_xx_desa($idd);
			$data['content']				  = render_view('bides/beranda', $subdata, true);
			render_view('template', $data);

        }else if ($level == '3'){
			$subdata['jml_ibu']				  = $this->m_ibu->count_ibu_all();
			$subdata['jml_kehamilan_baru']	  = $this->m_kehamilan->count_kehamilan_th_all();;
			$subdata['jml_kehamilan_berj']	  = $this->m_kehamilan->count_kehamilan_berj_all();
			$subdata['jml_abortus']			  = $this->m_kehamilan->count_kehamilan_xx_all();
			$data['content']				  = render_view('bides/beranda', $subdata, true);
			render_view('template', $data);
        }
        else if ($level == '4'){
			$subdata['jml_ibu']				  = $this->m_ibu->count_ibu_all();
			$subdata['jml_kehamilan_baru']	  = $this->m_kehamilan->count_kehamilan_th_all();;
			$subdata['jml_kehamilan_berj']	  = $this->m_kehamilan->count_kehamilan_berj_all();
			$subdata['jml_abortus']			  = $this->m_kehamilan->count_kehamilan_xx_all();
			$data['content']				  = render_view('bides/beranda', $subdata, true);
			render_view('template', $data);
        }else {
            dumper($dataku);
        }
    }

    function cek(){
        echo phpinfo();
    }

}
