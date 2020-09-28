<?php
    

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_barang');
        $this->load->model('m_kategori');
        $this->load->model('m_lokasi');
        //$this->load->model('Barang_model');
        $this->load->model('m_stock');
        $this->load->model('m_users');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('m_penyimpanan');
        // $this->session->set_userdata('transaksi', array());
    }

	public function barang_daftar() {
        if(!is_auth(2)) {redirect('discover/keluar');}
		$page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
		
		/* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
		
        $subdata['username']    = $this->session->userdata('username');
        $subdata['level']       = $this->m_users->get_level();
        $data['title']              = 'Daftar Barang';
        $data['meta_title']         = "Daftar barang";
        $data['meta_description']   = "Daftar Barang Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Barang~Daftar";
        $data['content']            = render_view('staff/barang', $subdata, true);
        render_view('template', $data);
    }
	
	public function source_barang_daftar() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $content = $this->m_barang->get_all_barang(id_cabang(), $_POST, $limit + 1, $start);
        dumper($content);
		$level   = $this->m_users->get_level();

        $result['content'] = render_view('staff/ajax_barang', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }
	
	public function barang_input() {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/barang_proses_input');
        $subdata['kategori']        = $this->m_kategori->get_kategori_by_idc(id_cabang());
        $subdata['lokasi']        	= $this->m_lokasi->get_satuan();
//dumper($subdata['lokasi']);
        $data['title']              = 'Tambah Barang Baru';
        $data['meta_title']         = "Tambah Barang Baru";
        $data['meta_description']   = "Tambah Barang Baru";
        $data['breadcrumb']         = "APS Inventory~Barang~Tambah";

        $data['content']            = render_view('staff/input_barang', $subdata, true);
        render_view('template', $data);
    }
	
	public function barang_proses_input() {
		//validasi isi form
		$this->form_validation->set_rules('nama_barang', 'Barang', 'required');
		$this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
		$this->form_validation->set_rules('id_satuan', 'Satuan Barang', 'required');
		$this->form_validation->set_rules('kode_barang', 'Kode Unik', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			//jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('barang/barang_masuk/');
		}else{
			//jika validasi terpenuhi, definisikan data
			$nama_barang				= inject($this->input->post('nama_barang'));
			$id_kategori			= inject($this->input->post('id_kategori'));
			$id_satuan				= inject($this->input->post('id_satuan'));
			$kode					= inject($this->input->post('kode_barang'));
			$id_cabang				= id_cabang();
			
			$data   = array (
				'nama_barang'             => $nama_barang,
				'id_kategori'           => $id_kategori,
				'id_satuan'           => $id_satuan,
				'kode'             	 => $kode,
				'id_cabang'             => $id_cabang,
				'create_date'           => date("Y/m/d h:i:s"),
				'create_by'          	 => userid()
			);
			$this->m_barang->input_barang($data);
			
			
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Barang"));
			redirect('barang/barang_daftar/');
		}
	}
	
	public function kategori_daftar() {
        if(!is_auth(2)) {redirect('discover/keluar');}
		$page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
		
		/* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
		
        $subdata['username']    = $this->session->userdata('username');
        $subdata['level']       = $this->m_users->get_level();
        $data['title']              = 'Daftar Kategori';
        $data['meta_title']         = "Daftar Kategori";
        $data['meta_description']   = "Daftar Kategori Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Kategori~Daftar";
        $data['content']            = render_view('staff/kategori', $subdata, true);
        render_view('template', $data);
    }
	
	public function source_kategori_daftar() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $content = $this->m_kategori->get_all_kategori(id_cabang(), $_POST, $limit + 1, $start);
        $level   = $this->m_users->get_level();

        $result['content'] = render_view('staff/ajax_kategori', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }

    public function kategori_input() {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/kategori_proses_input');
        $subdata['kategori']        = $this->m_kategori->get_kategori_by_idc(id_cabang());
        // $subdata['lokasi']          = $this->m_kategori->get_kategori();
//dumper($subdata['lokasi']);
        $data['title']              = 'Tambah Kategori Baru';
        $data['meta_title']         = "Tambah Kategori Baru";
        $data['meta_description']   = "Tambah Kategori Baru";
        $data['breadcrumb']         = "APS Inventory~Kategori~Tambah";

        $data['content']            = render_view('staff/kategori_input', $subdata, true);
        render_view('template', $data);
    }
	
    public function kategori_proses_input() {
        //validasi isi form
        $this->form_validation->set_rules('nama_kategori', 'Kategori', 'required');
        
        
        if ($this->form_validation->run() == FALSE) {
            //jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
            redirect('barang/kategori_input/');
        }else{
            //jika validasi terpenuhi, definisikan data
            $nama_kategori            = inject($this->input->post('nama_kategori'));
            // $alamat                 = inject($this->input->post('alamat'));
            $id_cabang              = id_cabang();
            
            $data   = array (
                'nama_kategori'             => $nama_kategori,
                'id_cabang'             => $id_cabang,
                // 'create_by'              => userid()
            );
            $this->m_kategori->input_kategori($data);
            
            
            $this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Kategori"));
            redirect('barang/kategori_daftar/');
        }
    }

    public function penyimpanan_daftar() {
        if(!is_auth(2)) {redirect('discover/keluar');}
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
        
        /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        // $id_gudang = id_gudang();
        // $subdata['penyimpanan']     = $this->m_penyimpanan->get_penyimpanan_by_idc($id_gudang);
        // var_dump($this->session->userdata());
        // die();
        $subdata['penyimpanan']     = $this->m_penyimpanan->get_penyimpanan();
        $subdata['username']        = $this->session->userdata('username');
        $subdata['level']           = $this->m_users->get_level();
        $data['title']              = 'Daftar Penyimpanan';
        $data['meta_title']         = "Daftar Penyimpanan";
        $data['meta_description']   = "Daftar Penyimpanan Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Penyimpanan~Daftar";
        $data['content']            = render_view('staff/penyimpanan', $subdata, true);
        render_view('template', $data);
    }

    // public function source_penyimpanan_daftar() {
    //     //variable
    //     $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

    //      /* Set Limit */
    //     $limit = 10;
    //     $start = ($limit * $page) - $limit;

    //     // $content = $this->m_penyimpanan->get_penyimpanan_by_cabang(id_cabang(), $_POST, $limit + 1, $start);
    //     $level   = $this->m_users->get_level();

    //     // $result['content'] = render_view('staff/ajax_gudang', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
    //     $result['page'] = $page;
    //     $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
    //     $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

    //     // echo json_encode($result);
    // }

    public function penyimpanan_input() {
        if(!is_auth(2)) {redirect('discover/keluar');}

         $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $subdata['gudang'] = $this->m_lokasi->get_gudang_by_cabang(id_cabang(), $_POST, $limit + 1, $start);

        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/penyimpanan_proses_input');
        // $subdata['lokasi']          = $this->m_lokasi->get_satuan();
//dumper($subdata['lokasi']);
        $data['title']              = 'Tambah Penyimpanan Baru';
        $data['meta_title']         = "Tambah Penyimpanan Baru";
        $data['meta_description']   = "Tambah Penyimpanan Baru";
        $data['breadcrumb']         = "APS Inventory~Penyimpanan~Tambah";

        $data['content']            = render_view('staff/penyimpanan_input', $subdata, true);
        render_view('template', $data);
    }

    public function penyimpanan_proses_input() {
        //validasi isi form
        $this->form_validation->set_rules('nama_penyimpanan', 'Penyimpanan', 'required');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required');
        $this->form_validation->set_rules('sisa', 'sisa', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            //jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
            redirect('barang/penyimpanan_input/');
        }else{
            //jika validasi terpenuhi, definisikan data
            $nama_penyimpanan            = inject($this->input->post('nama_penyimpanan'));
            $kapasitas                   = inject($this->input->post('kapasitas'));
            $sisa                        = inject($this->input->post('sisa'));
            $id_gudang                   = inject($this->input->post('gudang'));
            
            $data   = array (
                'nama_penyimpanan'             => $nama_penyimpanan,
                'kapasitas'           => $kapasitas,
                'sisa'                  => $sisa,
                'id_gudang'             => $id_gudang,
                'create_date'           => date("Y/m/d h:i:s"),
            );
            // var_dump($data);
            // die();
            $this->m_penyimpanan->input_penyimpanan($data);
            
            
            $this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Gudang"));
            redirect('barang/penyimpanan_daftar/');
        }
    }

	public function gudang_daftar() {
        if(!is_auth(2)) {redirect('discover/keluar');}
		$page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
		
		/* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
		
        $subdata['username']    = $this->session->userdata('username');
        $subdata['level']       = $this->m_users->get_level();
        $data['title']              = 'Daftar Gudang';
        $data['meta_title']         = "Daftar Gudang";
        $data['meta_description']   = "Daftar Gudang Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Gudang~Daftar";
        $data['content']            = render_view('staff/gudang', $subdata, true);
        render_view('template', $data);
    }
	

	public function source_gudang_daftar() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $content = $this->m_lokasi->get_gudang_by_cabang(id_cabang(), $_POST, $limit + 1, $start);
        $level   = $this->m_users->get_level();

        $result['content'] = render_view('staff/ajax_gudang', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);
    }
	
    public function gudang_input() {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/gudang_proses_input');
        $subdata['gudang']          = $this->m_lokasi->get_gudang_by_idc(id_cabang());
        $subdata['lokasi']          = $this->m_lokasi->get_satuan();
//dumper($subdata['lokasi']);
        $data['title']              = 'Tambah Gudang Baru';
        $data['meta_title']         = "Tambah Gudang Baru";
        $data['meta_description']   = "Tambah Gudang Baru";
        $data['breadcrumb']         = "APS Inventory~Barang~Tambah";

        $data['content']            = render_view('staff/gudang_input', $subdata, true);
        render_view('template', $data);
    }

    public function gudang_proses_input() {
        //validasi isi form
        $this->form_validation->set_rules('nama_gudang', 'Gudang', 'required');
        $this->form_validation->set_rules('alamat', 'Nama Alamat', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            //jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
            redirect('barang/gudang_input/');
        }else{
            //jika validasi terpenuhi, definisikan data
            $nama_gudang            = inject($this->input->post('nama_gudang'));
            $alamat                 = inject($this->input->post('alamat'));
            $id_cabang              = id_cabang();
            
            $data   = array (
                'nama_gudang'             => $nama_gudang,
                'alamat'           => $alamat,
                // 'id_satuan'           => $id_satuan,
                'id_cabang'             => $id_cabang,
                'create_date'           => date("Y/m/d h:i:s"),
                // 'create_by'              => userid()
            );
            $this->m_lokasi->input_gudang($data);
            
            
            $this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Gudang"));
            redirect('barang/gudang_daftar/');
        }
    }
	
	public function penerimaan_input() {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/penerimaan_proses_input');
        $subdata['kategori']        = $this->m_kategori->get_kategori(id_cabang());
        //$subdata['lokasi']        	= $this->m_lokasi->get_satuan();
	//dumper($subdata['lokasi']);
        $data['title']              = 'Barang Datang Baru';
        $data['meta_title']         = "Barang Datang Baru";
        $data['meta_description']   = "Barang Datang Baru";
        $data['breadcrumb']         = "APS Inventory~Penerimaan Barang~Tambah";

        $data['content']            = render_view('staff/penerimaan_barang', $subdata, true);
        render_view('template', $data);
    }
	
	public function penerimaan_proses_input() {
		//validasi isi form
		$this->form_validation->set_rules('nama_barang', 'Barang', 'required');
		$this->form_validation->set_rules('nama_shipper', 'ID Kategori', 'required');
		$this->form_validation->set_rules('nama_forwarder', 'Satuan Barang', 'required');
		$this->form_validation->set_rules('jumlah', 'Kode Unik', 'required');
		$this->form_validation->set_rules('nomor_po', 'Kode Unik', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			//jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('barang/barang_masuk/');
		}else{
			//jika validasi terpenuhi, definisikan data
			$nama_barang				= inject($this->input->post('nama_barang'));
			$nama_shipper				= inject($this->input->post('nama_shipper'));
			$nama_forwarder				= inject($this->input->post('nama_forwarder'));
			$jumlah						= inject($this->input->post('jumlah'));
			$nomor_po					= inject($this->input->post('nomor_po'));
			$id_cabang					= id_cabang();
			
			$data   = array (
				'nama_barang'           => $nama_barang,
				'nama_shipper'           => $nama_shipper,
				'nama_forwarder'        => $nama_forwarder,
				'jumlah'          		=> $jumlah,
				'nomor_po'           	=> $nomor_po,
				'id_cabang'				=> $id_cabang,
				'create_date'           => date("Y/m/d h:i:s"),
				'create_by'          	=> userid()
			);
			$this->m_barang->input_penerimaan_barang($data);
			
			
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Penerimaan"));
			redirect('barang/penerimaan_barang_daftar/');
		}
	}
	
	public function penerimaan_barang_daftar() {
        if(!is_auth(2)) {redirect('discover/keluar');}
		$page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
		
		/* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
		
        $subdata['username']    = $this->session->userdata('username');
        $subdata['level']       = $this->m_users->get_level();
        $data['title']              = 'Daftar Penerimaan Barang';
        $data['meta_title']         = "Daftar penerimaan barang";
        $data['meta_description']   = "Daftar Penerimaan Barang Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Penerimaan Barang~Daftar";
        $data['content']            = render_view('staff/penerimaan_barang_daftar', $subdata, true);
        render_view('template', $data);
    }
	
	public function source_penerimaan_daftar() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $content = $this->m_barang->get_all_penerimaan(id_cabang(), $_POST, $limit + 1, $start);
        $level   = $this->m_users->get_level();

        $result['content'] = render_view('staff/ajax_penerimaan_barang', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }
	
	public function penerimaan_barang_print($id) {
        if(!is_auth(2)) {redirect('discover/keluar');}
		$page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
		
		/* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
		
        $subdata['username']    = $this->session->userdata('username');
        $subdata['level']       = $this->m_users->get_level();
        $data['title']              = 'Daftar Penerimaan Barang';
        $data['meta_title']         = "Daftar penerimaan barang";
        $data['meta_description']   = "Daftar Penerimaan Barang Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Penerimaan Barang~Daftar";
        $data['content']            = render_view('staff/penerimaan_barang_print', $subdata, true);
        render_view('template', $data);
    }
	
	public function stock_in_daftar() {
        if(!is_auth(2)) {redirect('discover/keluar');}
		$page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
		
		/* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
		
        $subdata['username']    	= $this->session->userdata('username');
		$content					= $this->m_stock->get_stock_in_by_idc(id_cabang(), $_POST, $limit + 1, $start);
        $subdata['level']       	= $this->m_users->get_level();
        $data['title']              = 'Daftar Stock In';
        $data['meta_title']         = "Daftar Stock In";
        $data['meta_description']   = "Daftar Stock In Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Stock In~Daftar";
        $data['content']            = render_view('staff/stock_in_daftar', $subdata, true);
        render_view('template', $data);
    }
	
	public function source_stock_in_daftar() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $content = $this->m_barang->get_all_penerimaan(id_cabang(), $_POST, $limit + 1, $start);
		$level   = $this->m_users->get_level();

        $result['content'] = render_view('staff/ajax_stock_in_daftar', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }
	
	public function stock_in_input() {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/stock_in_proses_input');
        $subdata['barang']        	= $this->m_barang->get_barang_by_idc(id_cabang());
		$subdata['po'] 				= $this->m_barang->get_all_penerimaan_by_idc(id_cabang());
		$subdata['penyimpanan']     = $this->m_lokasi->get_penyimpanan_by_idc(id_cabang());
        $data['title']              = 'Stock In Baru';
        $data['meta_title']         = "Stock In Baru";
        $data['meta_description']   = "Stock In Baru";
        $data['breadcrumb']         = "APS Inventory~Stock In~Tambah";

        $data['content']            = render_view('staff/stock_in_input', $subdata, true);
        render_view('template', $data);
    }
	
	public function stock_in_proses_input() {
		//validasi isi form
		$this->form_validation->set_rules('id_barang', 'Barang', 'required');
		$this->form_validation->set_rules('id_penerimaan', 'ID Penerimaan', 'required');
		$this->form_validation->set_rules('id_penyimpanan', 'ID Penyimpanan', 'required');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			//jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('barang/stock_in_input/');
		}else{
			//jika validasi terpenuhi, definisikan data
			$id_barang					= inject($this->input->post('id_barang'));
			$id_penerimaan				= inject($this->input->post('id_penerimaan'));
			$jumlah						= inject($this->input->post('jumlah'));
			$id_penyimpanan				= inject($this->input->post('id_penyimpanan'));
			
			//cek apakah dipenyimpanan sudah ada stock
			$cek_stock = $this->m_stock->cek_stock($id_barang, $id_penyimpanan);
			
			//jika sudah ada di list
			if ($cek_stock <> ''){
				$id_stock	= $cek_stock['id_stock'];
				
				$stockbaru = $cek_stock['stock'] + $jumlah;
				$datastock = array (
					'stock'		=>$stockbaru,
					'edit_date'	=> date("Y/m/d h:i:s"),
					'edit_by'	=> userid()
				);
				$this->m_stock->update_stock($id_stock, $datastock); 
				
				$data_transaksi   = array (
				'id_barang'           	=> $id_barang,
				'id_penerimaan'        	=> $id_penerimaan,
				'id_stock'  	      	=> $id_stock,
				'jumlah'          	  	=> $jumlah,
				'id_penyimpanan'      	=> $id_penyimpanan,
				'create_date'         	=> date("Y/m/d h:i:s"),
				'status'         		=> 0,
				'create_by'         	=> userid()
				);
				
				$namasimpan = simple_encrypt($id_stock);
				
			}else{
				$datastock = array (
					'id_barang'			=> $id_barang,
					'stock'				=> $jumlah,
					'id_penyimpanan'	=> $id_penyimpanan,
					'create_date'	=> date("Y/m/d h:i:s"),
					'create_by'	=> userid()
				);
				$this->m_stock->insert_stock($datastock);
				
				//ambil id_stocknya
				$cek_stock2 = $this->m_stock->cek_stock($id_barang, $id_penyimpanan);
				$id_stock2	= $cek_stock2['id_stock'];
				
				
				//Buat QR Code
				//enskripsi dulu id stocknya
				$namasimpan = simple_encrypt($id_stock2).'.png';
				$this->load->library('ciqrcode');
				
                $params['data'] = $id_stock2;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH.'./assets/qr/'.$namasimpan.'.png';
                $this->ciqrcode->generate($params);
				//dumper($params);
				$data_qr = array (
					'qrcode'			=> $namasimpan
				);
				
				//update tabel stock tambahkan link qr
				$this->m_stock->update_stock($id_stock2,  $data_qr); 
				
				//masukkan ke tabel transaksi
				$data_transaksi   = array (
					'id_barang'           	=> $id_barang,
					'id_penerimaan'        	=> $id_penerimaan,
					'id_stock'  	      	=> $id_stock2,
					'jumlah'          	  	=> $jumlah,
					'id_penyimpanan'      	=> $id_penyimpanan,
					'create_date'         	=> date("Y/m/d h:i:s"),
					'status'         		=> 0,
					'create_by'         	=> userid()
				);
			}
			
			$this->m_barang->input_stock_in($data_transaksi);
			
			
			
			$this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Stock IN"));
			
			redirect('barang/stock_in_detail/'.$namasimpan);
			//redirect('barang/stock_in_daftar/');
		}
	}

    public function stock_out_input() {
        if(!is_auth(2)) {redirect('discover/keluar');}

        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/stock_out_proses_input');
        $subdata['barang']          = $this->m_barang->get_barang_by_idc(id_cabang());
        $subdata['po']              = $this->m_barang->get_all_penerimaan_by_idc(id_cabang());
        $subdata['penyimpanan']     = $this->m_lokasi->get_penyimpanan_by_idc(id_cabang());
        $data['title']              = 'Stock out Baru';
        $data['meta_title']         = "Stock out Baru";
        $data['meta_description']   = "Stock out Baru";
        $data['breadcrumb']         = "APS Inventory~Stock In~Tambah";

        $data['content']            = render_view('staff/stock_out_input', $subdata, true);
        render_view('template', $data);
    }
	
	public function cek_stock_out(){
        if(!is_auth(2)) {redirect('discover/keluar');}

		$this->form_validation->set_rules('id_stock', 'Barang', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			//jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('barang/stock_out_input/');
		}else{
		$id_stock					= inject($this->input->post('id_stock'));
		$subdata['barang']			= $this->m_stock->get_stock_detail_by_id($id_stock);
		$subdata['action']          = site_url('barang/stock_out_proses_input');
		}
        $profile                    = get_profile();
        $data['title']              = 'Stock out Baru';
        $data['meta_title']         = "Stock out Baru";
        $data['meta_description']   = "Stock out Baru";
        $data['breadcrumb']         = "APS Inventory~Stock Out~Tambah";

        $data['content']            = render_view('staff/stock_out_input', $subdata, true);
        render_view('template', $data);
    }
	
	public function add_stock_out(){
        if(!is_auth(2)) {redirect('discover/keluar');}

		// $this->form_validation->set_rules('id_stock', 'Barangs', 'required');
        // $this->$this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12
		
		if ($this->form_validation->run() == TRUE) {
			//jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('barang/stock_out_input/');
		}else{
        // get data     
        $id_stock = inject($this->input->post('id_stocks'));
        $nama_barang = inject($this->input->post('nama_barang'));
        $jumlah = inject($this->input->post('jumlah'));
        $stock = inject($this->input->post('stock'));

        $newStock = $stock - $jumlah;

		$item = array(
            'id_stock' => $id_stock,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah
        );

        $itemUpdater = array(
            'id_stock' => $id_stock,
            'stock' => $newStock
        );

        $transaksi = $this->session->userdata('transaksi');
        $updater = $this->session->userdata('updater');

        if($item['id_stock'] != NULL){
            array_push($transaksi, $item);    
            array_push($updater, $itemUpdater);  
        }
        

        $this->session->set_userdata('transaksi', $transaksi);
        $this->session->set_userdata('updater', $updater);
        

		$subdata['action']          = site_url('barang/stock_out_proses_input');
		
		}
        $profile                    = get_profile();
        $data['title']              = 'Stock out Baru';
        $data['meta_title']         = "Stock out Baru";
        $data['meta_description']   = "Stock out Baru";
        $data['breadcrumb']         = "APS Inventory~Stock Out~Tambah";

        $data['content']            = render_view('staff/stock_out_input', $subdata, true);
        render_view('template', $data);
    }

    public function transaksi(){
        $user = userid();
        $requester = 1;
        $this->m_stock->batchUpdate();
        $data_resi = array(
            'user' => $user,
            'requester' => $requester
        );
        $this->m_stock->insert_resi($data_resi);
        $resi = $this->m_stock->get_resi(); // select * from resi desc limit 1
        //$resi = $this->m_barang->get_resi();
        $no_resi = $resi['id'];
        $barang = $this->session->userdata('transaksi');

        // var_dump($no_resi);
        //dumper($barang);
        $profile                    = get_profile();
        $subdata['action']          = site_url('barang/stock_out_print');
        $subdata['barang']          = $barang;
        $subdata['user']            = userid();
        $subdata['no_resi']         = $no_resi;
        $subdata['tanggal']         = date("Y/m/d h:i:s");
        //$subdata['no']              = $this->m_lokasi->get_penyimpanan_by_idc(id_cabang());
        $data['title']              = 'RESI';
        $data['meta_title']         = "RESI";
        $data['meta_description']   = "RESI";
        $data['breadcrumb']         = "APS Inventory~Stock In~Tambah";

        $data['content']            = render_view('staff/stock_out_resi', $subdata, true);
        render_view('template', $data);
    }

    public function delete_item_transaksi(){
        $id = $this->input->get('id');
        $current_transaksi = $this->session->userdata('transaksi');
        array_splice($current_transaksi, $id, 1);
        $this->session->set_userdata('transaksi', $current_transaksi);
        $this->stock_out_input();
    }

     public function resi_print(){
        $user = userid();
        $requester = 1;
        $this->m_stock->batchUpdate();
        $data_resi = array(
            'user' => $user,
            'requester' => $requester
        );
        $this->m_stock->insert_resi($data_resi);
        $resi = $this->m_stock->get_resi();
        $no_resi = $resi['id'];
        $barang = $this->session->userdata('transaksi');
        $profile                    = get_profile();
        $subdata['barang']          = $barang;
        $subdata['user']            = userid();
        $subdata['requester']       = 'test';
        $subdata['no_resi']         = $no_resi;
        $subdata['tanggal']         = date("Y/m/d h:i:s");
        $data['title']              = 'RESI';
        $data['meta_title']         = "RESI";
        $data['meta_description']   = "RESI";
        $data['breadcrumb']         = "APS Inventory~Stock In~Tambah";
        render_view('staff/resi_print', $subdata);
    }


	
	public function stock_in_detail($id = ''){
        if(!is_auth(2)) {redirect('discover/keluar');}
			$ids = simple_decrypt($id);
        if ($id != '') {
			$profile           	  	    = get_profile();
            $subdata['get']        		= $id;
            $data['title']              = 'QR Code';
            $data['meta_title']         = "QR Code";
            $data['meta_description']   = "QR Code Inventory";
            $data['breadcrumb_icon']    = "fa fa-user";
            $data['breadcrumb']         = "APS Inventory~Stock In~QR";
			$subdata['gambar'] 			= $id;
			//dumper($id);
			$subdata['barang'] 			= $this->m_stock->get_stock_detail_by_id($ids);
			$subdata['cabang'] 			= $this->m_lokasi->get_cabang_by_id(id_cabang());
            $data['content']            =render_view('staff/qr_view', $subdata, true);
            render_view('template',$data);
        } else{
            redirect('barang/barang_daftar');
        }
    }
	
	public function qr_print($id) 
    {
		//$ids = simple_decrypt($id);
        $row = $this->m_barang->get_gambar_by_id($id);
		$ids = simple_decrypt($id);
		$data['barang'] 			= $this->m_stock->get_stock_detail_by_id($ids);
        $data['gambar'] = $id.'.png';
		$data['cabang'] 			= $this->m_lokasi->get_cabang_by_id(id_cabang());
        $this->load->view('staff/qr_print', $data);
    }
	
	public function stock_out_daftar() {
        if(!is_auth(2)) {redirect('discover/keluar');}
		$page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;
		
		/* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;
		
        $subdata['username']    = $this->session->userdata('username');
        $subdata['level']       = $this->m_users->get_level();
        $data['title']              = 'Daftar Stock Out';
        $data['meta_title']         = "Daftar Stock Out";
        $data['meta_description']   = "Daftar Stock Out Inventory APS";
        $data['breadcrumb']         = "APS Inventory~Stock Out~Daftar";
        $data['content']            = render_view('staff/stock_out_daftar', $subdata, true);
        render_view('template', $data);
    }
	
	public function source_stock_out_daftar() {
        //variable
        $page = ISSET($_POST['current_page']) ? inject($_POST['current_page']) : 1;

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $content = $this->m_barang->get_all_penerimaan(id_cabang(), $_POST, $limit + 1, $start);
        $level   = $this->m_users->get_level();

        $result['content'] = render_view('staff/ajax_stock_out_daftar', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }
	

	
    public function daftar_barang(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_roows($q);
        $barang = $this->Barang_model->get_limit_dataa($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_data' => $barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('barang/stock_list', $data);
    }

	public function barang_masuk_daftar() {
		//if(!is_auth()) {redirect('discover/keluar');}
		//$profile              	  		  = get_profile();
		$data['action']				  = site_url('barang/barang_masuk_input');
		//$id					 			  = id_desa();
		//$data['hasil']				  = $this->m_barang->get_all_barang(($id_cabang, $filter = [], $limit = 0, $start = 0));
		//$data['hasil2']				  = $this->m_kategori->get_all_kategori();
		//$data['hasil3']				  = $this->m_lokasi->get_all_lokasi();
		$data['title']					  = 'Input Barang Masuk';
		
		//$this->load->view('v_header');
		//$data['content']				  = render_view('bides/input_kohort', $subdata, true);
		//render_view('template', $data);
		$this->load->view('barang/barang_masuk',$data);
	}
	
	//public function barang_masuk() {
		//if(!is_auth()) {redirect('discover/keluar');}
		//$profile              	  		  = get_profile();
		//$data['action']				  = site_url('barang/barang_masuk_input');
		//$id					 			  = id_desa();
		//$data['hasil']				  = $this->m_barang->get_all_barang();
		//$data['hasil2']				  = $this->m_kategori->get_all_kategori();
		//$data['hasil3']				  = $this->m_lokasi->get_all_lokasi();
		//$data['title']					  = 'Input Barang Masuk';
		
		//$this->load->view('v_header');
		//$data['content']				  = render_view('bides/input_kohort', $subdata, true);
		//render_view('template', $data);
		//$this->load->view('barang/barang_masuk',$data);
	//}
	
	
	
	
	public function barang_masuk_input() {
		//validasi isi form
		$this->form_validation->set_rules('id_barang', 'Barang', 'required');
		$this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
		$this->form_validation->set_rules('pengirim', 'Nama Pengirim', 'required');
		$this->form_validation->set_rules('id_lokasi', 'Lokasi Penyimpanan', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
		$this->form_validation->set_rules('fungsi', 'Fungsi', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			//jika validasi tidak terpenuhi,kembali ke halaman barang masuk
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			redirect('barang/barang_masuk/');
		}else{
			//jika validasi terpenuhi, definisikan data
			$id_barang				= inject($this->input->post('nama_barang'));
			$id_kategori			= inject($this->input->post('id_kategori'));
			$pengirim				= inject($this->input->post('pengirim'));
			$id_lokasi				= inject($this->input->post('id_lokasi'));
			$jumlah					= inject($this->input->post('jumlah'));
			$fungsi					= inject($this->input->post('fungsi'));
			
		

        $id_item = $this->m_barang->get_id_transaksi();
        $kode = $id_item['id_item'];

        $namabarcode = $id_item['id_item'].'.'.$id_barang.'.'.$id_lokasi.'.'.$id_kategori.'.'.$jumlah.'.'.$pengirim.'.'.$fungsi;
		
		

        $gambar = $namabarcode.'.png';
		
		//ambil id transaksinya
		
        // dumper($gambar);    
        // $this->m_barang->update_qr($kode, $gambar);
		
		//dumper($kode);
		
		//BUAT QR Code, isi: ID_transaksi, nama barang, nama_lokasi.
		
		//dumper($namabarcode);

                // $tanggal = date('Y-m-d H:i:s');
                // $tgl = date('Y-m-d');

                // $namabarcode = $this->input->post('nama_barang').'.'.$tgl.$this->input->post('stok').'.'.$this->input->post('satuan');

        $data   = array (
            //'daftar_by'               => $id_user,
            'id_barang'             => $id_barang,
            'id_kategori'           => $id_kategori,
            'pengirim'              => $pengirim,
            'id_lokasi'             => $id_lokasi,
            'jumlah'                => $jumlah,
            'fungsi'                => $fungsi,
            'gambar'                => $namabarcode.'.png',
            'create_time'           => date("Y/m/d h:i:s")
        );

        //input  tabel transaksi
        $this->m_barang->input_masuk($data);

                $dummy = 'mamas';

                // buat barcode
                require 'vendor/autoload.php';

                $redColor = [255, 0, 0];

                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                file_put_contents('./assets/barcode/'.$namabarcode.'.png', $generator->getBarcode($namabarcode, $generator::TYPE_CODE_128, 3, 50, $redColor));;
                // akhir buat barcode

                //buat qr
                $this->load->library('ciqrcode');

                $params['data'] = $namabarcode;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH.'./assets/qr/'.$namabarcode.'.png';
                $this->ciqrcode->generate($params);
		
		// $this->load->library('ciqrcode');

		// $params['data'] = $kode;
		// $params['level'] = 'H';
		// $params['size'] = 10;
		// $params['savename'] = FCPATH.'./assets/qr/'.$id_item['id_item'].'.png';
		// $this->ciqrcode->generate($params['data']);

		// $this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Barang Masuk Baru"));
		// $data2['link'] = $params['savename'];
		
		//dumper($data2['link']);
		//ke halaman print qr code
        $this->session->set_flashdata('message', 'Create Record Success');
		redirect('barang/viewqr/'.$namabarcode);
		}
	}

    
    public function daftar_barangx(){
        // $this->load->view('v_header');
        // $this->load->view('v_menu');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_rows($q);
        $barang = $this->Barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_data' => $barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('barang/daftar_barang',$data);
        // $this->load->view('v_footer');
        // $this->load->view('v_script');

    }

    public function daftar_barang_masuk(){
        // $data['title'] = "Daftar Penyimpanan";
        // $this->load->view('v_header');
        // $this->load->view('v_menu');
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_rows($q);
        $barang = $this->Barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_data' => $barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('barang/daftar_simpan',$data);
        // $this->load->view('v_footer');
        // $this->load->view('v_script');
    }

    function CheckNamaBarang($nama_barang){
        if($this->model->check_namabarang($nama_barang)==''){
            return true;
        }else{
            $this->form_validation->set_message('nama_barang', 'nama_barang'.$nama_barang.'sudah ada!');
            return false;
        }
    }

    function CheckNamaLokasi($lokasi){
        if($this->model->check_namalokasi($lokasi)==''){
            return true;
        }else{
            $this->form_validation->set_message('lokasi', 'lokasi'.$lokasi.'sudah ada!');
            return false;
        }
    }
    
    public function index()
    {
        // $this->load->view('v_header');
        // $this->load->view('v_menu');
        // if ($this->admin->logged_id()) {
        //     $this->load->view("barang");
        // }
        // else{
        //     redirect("login");
        // }
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang/index.html';
            $config['first_url'] = base_url() . 'barang/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_model->total_rows($q);
        $barang = $this->Barang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_data' => $barang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('barang/barang', $data);
        // $this->load->view('v_footer');
        // $this->load->view('v_script');
    }


    public function viewqr($id) 
    {
        $row = $this->m_barang->get_gambar_by_id($id);
        $data['gambar'] = $id.'.png';
        $this->load->view('barang/qr_print', $data);
    }


    public function read($id) 
    {
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_barang' => $row->id_barang,
		'nama_barang' => $row->nama_barang,
		'id_kategori' => $row->id_kategori,
		'tgl_masuk' => $row->tgl_masuk,
		'pengirim' => $row->pengirim,
		'id_lokasi' => $row->id_lokasi,
		'barcode' => $row->barcode,
		'qr' => $row->qr,
        'stok' => $row->stok,
        'satuan' => $row->satuan,
        'fungsi' => $row->fungsi,
        'pengambil' => $row->pengambil,
        'kirim' => $row->kirim,
	    );
            $this->load->view('barang/barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function create() 
    {

		
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang/create_action'),
    	    'id_barang' => set_value('id_barang'),
    	    'nama_barang' => set_value('nama_barang'),
    	    // 'id_kategori' => set_value('id_kategori'),
    	    // 'tgl_masuk' => set_value('tgl_masuk'),
    	    // 'pengirim' => set_value('pengirim'),
    	    // 'id_lokasi' => set_value('id_lokasi'),
    	    // 'barcode' => set_value('barcode'),
    	    // 'qr' => set_value('qr'),
         //    'stok' => set_value('stok'),
            'kode' => set_value('kode'),
            'satuan' => set_value('satuan'),
            // 'fungsi' => set_value('fungsi'),
            // 'pengambil' => set_value('pengambil'),
            // 'kirim' => set_value('kirim'),
	);
	
		$data['hasil']				  = $this->m_barang->get_all_barang();
        $data['hasil1']                = $this->m_barang->get_all_kode();
		$data['hasil2']				  = $this->m_barang->get_all_satuan();
		
        $this->load->view('barang/barang_form', $data);
    }
    
    public function create_action() 
    {
		$nmbrg = $this->input->post('nama_barang',TRUE);
        $nmsatuan = $this->input->post('satuan',TRUE);
		// var_dump($nmbrg);
  //       var_dump($nmsatuan);
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            require 'vendor/autoload.php';

            // cek buku ada apa gak
            $nmbrg = $this->input->post('nama_barang',TRUE);
            $nmkode = $this->input->post('kode',TRUE);
            $nmsatuan = $this->input->post('satuan',TRUE);
			// dumper($nmbrg);
            $ceknama = $this->m_barang->check_namabarang($nmbrg);
            if($ceknama>0){
                // panggil model get by name
                $dt = array(
                    'check' => $ceknama,
                    'namaBarang' => $nmbrg,
                    'keterangan' => $this->m_barang->get_by_name($nmbrg)
                );
                $this->load->view('barang/avail',$dt);
            }
            else{

                $data = array(
        		'nama_barang' => $this->input->post('nama_barang',TRUE),
                'kode' => $this->input->post('kode',TRUE),
        		//'id_kategori' => $this->input->post('id_kategori',TRUE),
        		// 'tgl_masuk' => $tanggal,
        		// 'pengirim' => $this->input->post('pengirim',TRUE),
        		//'id_lokasi' => $this->input->post('id_lokasi',TRUE),
        		//'barcode' => $namabarcode.'.png',
        		//'qr' => $namabarcode.'.png',
                //'stok' => $this->input->post('stok',TRUE),
                'satuan' => $this->input->post('satuan',TRUE),
                // 'fungsi' => $this->input->post('fungsi',TRUE),
                // 'pengambil' => $this->input->post('pengambil',TRUE),
                // 'kirim' => $this->input->post('kirim',TRUE),
    	    );

                $this->m_barang->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('barang/barang_list'));
            }
        }
    }

    public function create_lokasi() 
    {

        
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang/create_lokasi_action'),
            'id_rak' => set_value('id_rak'),
            'lokasi' => set_value('lokasi'),
            // 'id_kategori' => set_value('id_kategori'),
            // 'tgl_masuk' => set_value('tgl_masuk'),
            // 'pengirim' => set_value('pengirim'),
            // 'id_lokasi' => set_value('id_lokasi'),
            // 'barcode' => set_value('barcode'),
            // 'qr' => set_value('qr'),
         //    'stok' => set_value('stok'),
            'kapasitas' => set_value('kapasitas'),
            // 'fungsi' => set_value('fungsi'),
            // 'pengambil' => set_value('pengambil'),
            // 'kirim' => set_value('kirim'),
    );
    
        $data['hasil']                = $this->m_lokasi->get_all_lokasi();
        $data['hasil2']               = $this->m_lokasi->get_all_kapasitas();
        
        $this->load->view('barang/lokasi_form', $data);
    }
    
    public function create_lokasi_action() 
    {
        $nmlks = $this->input->post('lokasi',TRUE);
        $nmkps = $this->input->post('kapasitas',TRUE);
        //dumper($nmlks);
  //       var_dump($nmsatuan);
    // $this->form_validation->set_rules('id_rak', 'Lokasi', 'trim|required');
    // $this->form_validation->set_rules('kapasitas', 'kapasitas', 'trim|required');
    // $this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');

        // $this->_rules();

        // $this->form_validation->set_rules('id_lokasi', 'Lokasi', 'trim');
        $this->form_validation->set_rules('lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create_lokasi();
        } else {

            require 'vendor/autoload.php';

            // cek buku ada apa gak
            $nmlks = $this->input->post('lokasi',TRUE);
            $nmkps = $this->input->post('kapasitas',TRUE);
            // dumper($nmkps);
            $ceknama = $this->m_lokasi->check_namalokasi($nmlks);
            if($ceknama>0){
                // panggil model get by name
                $dt = array(
                    'check' => $ceknama,
                    'namaLokasi' => $nmlks,
                    'keterangan' => $this->m_lokasi->get_by_name($nmlks)
                );
                $this->load->view('barang/avail2',$dt);
            }
            else{

                $data = array(
                'lokasi' => $this->input->post('lokasi',TRUE),
                //'id_kategori' => $this->input->post('id_kategori',TRUE),
                // 'tgl_masuk' => $tanggal,
                // 'pengirim' => $this->input->post('pengirim',TRUE),
                //'id_lokasi' => $this->input->post('id_lokasi',TRUE),
                //'barcode' => $namabarcode.'.png',
                //'qr' => $namabarcode.'.png',
                //'stok' => $this->input->post('stok',TRUE),
                'kapasitas' => $this->input->post('kapasitas',TRUE),
                // 'fungsi' => $this->input->post('fungsi',TRUE),
                // 'pengambil' => $this->input->post('pengambil',TRUE),
                // 'kirim' => $this->input->post('kirim',TRUE),
            );

                $this->m_lokasi->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('barang/index'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/update_action'),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
		'pengirim' => set_value('pengirim', $row->pengirim),
		'id_lokasi' => set_value('id_lokasi', $row->id_lokasi),
		'barcode' => set_value('barcode', $row->barcode),
		'qr' => set_value('qr', $row->qr),
        'stok' => set_value('stok', $row->stok),
        'satuan' => set_value('satuan', $row->satuan),
        'fungsi' => set_value('fungsi', $row->fungsi),
        'pengambil' => set_value('pengambil', $row->pengambil),
        'kirim' => set_value('kirim', $row->kirim),
	    );
            $this->load->view('barang/barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang', TRUE));
        } else {
            $data = array(
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'id_kategori' => $this->input->post('id_kategori',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'pengirim' => $this->input->post('pengirim',TRUE),
		'id_lokasi' => $this->input->post('id_lokasi',TRUE),
		'barcode' => $this->input->post('barcode',TRUE),
		'qr' => $this->input->post('qr',TRUE),
        'stok' => $this->input->post('stok',TRUE),
        'satuan' => $this->input->post('satuan',TRUE),
        'fungsi' => $this->input->post('fungsi',TRUE),
        'pengambil' => $this->input->post('pengambil',TRUE),
        'kirim' => $this->input->post('kirim',TRUE),
	    );

            $this->Barang_model->update($this->input->post('id_barang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $this->Barang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function _rules() 
    {
	// $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required|is_unique[barang.nama_barang]',
 //    array(
 //        'required' => 'You have not provided %s.',
 //        'is_unique' => '%s sudah ada!!'
 //    )
 //    );
	// $this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	// $this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
	// $this->form_validation->set_rules('pengirim', 'pengirim', 'trim|required');
	// $this->form_validation->set_rules('id_lokasi', 'id lokasi', 'trim|required');
	// $this->form_validation->set_rules('barcode', 'barcode', 'trim|required');
	// $this->form_validation->set_rules('qr', 'qr', 'trim|required');
    // $this->form_validation->set_rules('stok', 'stok', 'trim|required');
    $this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
    $this->form_validation->set_rules('kode', 'kode', 'trim|required');
    // $this->form_validation->set_rules('fungsi', 'fungsi', 'trim|required');
    // $this->form_validation->set_rules('pengambil', 'pengambil', 'trim|required');
    // $this->form_validation->set_rules('kirim', 'kirim', 'trim|required');


	$this->form_validation->set_rules('id_barang', 'id_barang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    
        // $this->form_validation->set_rules('id_rak', 'Lokasi', 'trim|required');
        // $this->form_validation->set_rules('kapasitas', 'kapasitas', 'trim|required');
        // $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-06 19:47:17 */
/* http://harviacode.com */