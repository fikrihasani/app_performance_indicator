<?php
Class Discover extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_lokasi');
        //$this->load->model('m_kehamilan');
        $this->load->model('m_users');
        $this->load->model('m_stock');
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
        $this->session->set_userdata('transaksi', array());
        $this->session->set_userdata('updater', array());
        $subdata['username']      		    = username();
        $cabang			      		   		= $this->m_login->get_cabang(id_cabang());
        $data['cabang']      		   		= $cabang['nama_cabang'];
		$data['title']						= 'Beranda';
		$data['meta_title']        		  	= "Beranda";
		$data['meta_description']  		  	= "Beranda APS Inventory";
		$data['breadcrumb_icon']  		  	= "fa fa-dashboard";
		$data['breadcrumb']          	  	= "APS Inventory~Beranda";
        if ($level == '1'){
			$subdata['jml_gudang']			= $this->m_lokasi->count_gudang_by_cabang(id_cabang());
			$subdata['jml_stock']			= $this->m_stock->count_stock_by_cabang(id_cabang());
			$subdata['jml_permintaan']		= 0;
			$subdata['jml_penerimaan']		= 0;
			$data['content']				  = render_view('admin/beranda', $subdata, true);
			render_view('template', $data);
        }else if ($level == '2'){
			$subdata['jml_gudang']			= $this->m_lokasi->count_gudang_by_cabang(id_cabang());
			$subdata['jml_stock']			= $this->m_stock->count_stock_by_cabang(id_cabang());
			$subdata['jml_permintaan']		= 0;
			$subdata['jml_penerimaan']		= 0;
			$data['content']				= render_view('staff/beranda', $subdata, true);
			render_view('template', $data);

        }else if ($level == '3'){
			$subdata['jml_gudang']			= $this->m_lokasi->count_gudang_by_cabang(id_cabang());
			$subdata['jml_stock']			= $this->m_stock->count_stock_by_cabang(id_cabang());
			$subdata['jml_permintaan']		= 0;
			$subdata['jml_penerimaan']		= 0;
			$data['content']				  = render_view('branchmanager/beranda', $subdata, true);
			render_view('template', $data);
        }
        else if ($level == '4'){
			$subdata['jml_gudang']			= $this->m_lokasi->count_gudang_by_cabang(id_cabang());
			$subdata['jml_stock']			= $this->m_stock->count_stock_by_cabang(id_cabang());
			$subdata['jml_permintaan']		= 0;
			$subdata['jml_penerimaan']		= 0;
			$data['content']				  	  = render_view('plga/beranda', $subdata, true);
			render_view('template', $data);
        }else {
            dumper($dataku);
        }
    }

    function cek(){
        echo phpinfo();
    }

}
