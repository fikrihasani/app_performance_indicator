<?php
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_users');
		$this->load->model('m_desa');
		$this->load->model('m_ibu');
		$this->load->model('m_kehamilan');
		$this->load->model('m_pemeriksaan');
    }
    
    public function index() {
		$user = $this->session->userdata('level');
		if(!empty($user) && $user['username'] != ''){
			redirect('home/dashboard');
			}
			$this->load->view('login');
    }
    
	
	/*LOGIN*/
	public function masuk(){
			$akun = array(
					'username' => inject($this->input->post('username')),
					'password' => md5(inject($this->input->post('password')))   
			);
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata("error", '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
                Username dan Password tidak boleh kosong
              </div>');
				redirect('home/');
			}else{				
			$query = $this->m_login->get_user($akun);
            if ($query->num_rows() > 0) {
                $row = $query->row_array(); 
                //jika berhasil login maka akan di buat session
                $this->session->set_userdata('pengguna',$row);
                redirect('home/dashboard');
				}
				else{
					$this->session->set_flashdata("error", '<div class="alert alert-danger alert-dismissible">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
																<h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
																 Username / Password yang anda masukkan salah.
															  </div>');
					redirect('home/');
				}
			
			}
			
		}
	/*LOGIN*/
	
	
	/*LOGOUT*/
	public function keluar(){
			$this->session->sess_destroy();
			$this->session->set_flashdata('message', '<div class="alert alert-success"style="width:95%"><a class="close"></a><p>Berhasil Mengakhiri Sesi Anda/p></div>');
			redirect('home/');
		}
	/*LOGOUT*/
	
	/*DASHBOARD*/
	public function dashboard(){
	credential_administrator (array(1,2,3,4));
		$dataku = $this->session->userdata('pengguna');
		$level = $dataku['id_level'];
		if ($level == '1'){
				$subdata['title']   	 ='Selamat Datang'; 
				$subdata['nama']	 	 = $dataku['nama'];
				$data['content']   		 = $this->load->view('admin/beranda',$subdata,true);  
				$this->load->view('admin/template', $data);
		}else if ($level == '2'){
				$subdata['title']   	 ='Selamat Datang Bidan ';
				$subdata['nama']	 	 = $dataku['nama'];
				$subdata['username'] 	 = $dataku['username'];
				$data['content']   		 = $this->load->view('bides/beranda',$subdata,true);  
				$this->load->view('bides/template', $data);	
		}else if ($level == '3'){
				$subdata['title']   	 ='Selamat Datang Bidan ';
				$subdata['nama']	 	 = $dataku['nama'];
				$subdata['username'] 	 = $dataku['username'];
				$data['content']   		 = $this->load->view('bikor/beranda',$subdata,true);  
				$this->load->view('bikor/template', $data);
		}
		else if ($level == '4'){
				$subdata['title']   	 ='Selamat Datang Dokter '; 
				$subdata['nama']	 	 = $dataku['nama'];
				$subdata['username'] 	 = $dataku['username'];
				$data['content']   		 = $this->load->view('kapus/beranda',$subdata,true);  
				$this->load->view('kapus/template', $data);
		}else {echo $level;}   
	}
	/*DASHBOARD*/
	
	/*USERS*/
	public function user_input() {
		credential_administrator(1);
		$subdata['action']		= site_url('home/user_proses_input');
		$subdata['alert']		= $this->session->flashdata('message');
		$subdata['hasil']		= $this->m_desa->get_all_desa();
		$subdata['title']		= 'Tambah Pengguna';
		$data['content']		= $this->load->view('admin/input_user', $subdata, true);
		$this->load->view('admin/template', $data);	
	}
	
	public function user_proses_input() {
		credential_administrator(1);
		
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[35]');
		$this->form_validation->set_rules('username', 'Username', 'required|max_length[25]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('no_telp', 'No Telepon', 'required|integer|max_length[12]');
		$this->form_validation->set_rules('id_level', 'level', 'required');
		$level			= inject($this->input->post('id_level'));
		if($level == 2){
			$this->form_validation->set_rules('id_desa', 'Desa', 'required');
		}
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert" style="width:95%"> <a class="close"></a><p>'.validation_errors().'</p></div>');
			redirect('home/user_input/');
		}else{
			$nama			= inject($this->input->post('nama'));
			$username		= inject($this->input->post('username'));
			$password		= inject($this->input->post('password'));
			$no_telp		= inject($this->input->post('no_telp'));
			$level			= inject($this->input->post('id_level'));
			$id_desa		= inject($this->input->post('id_desa'));
			
			$data			= array(
								'nama'			=> $nama,
								'username'		=> $username,
								'password'		=> md5($password),
								'no_telp'		=> $no_telp,
								'id_level'			=> $level
							);
			if ($id_desa != "") {
					$data['id_desa']		= $id_desa;
				}
							
			$this->m_users->insert_user($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success"style="width:95%"><a class="close"></a><p>Berhasil Menambahkan Data Pengguna</p></div>');
			redirect('home/user_input/');
		}
	
	}
	
	public function user_daftar(){                                        
		credential_administrator(1);
		$subdata['hasil']		= $this->m_users->get_all_user();
		$subdata['username']    = $this->session->userdata('username');
		$subdata['title']		= 'Daftar Pengguna';
		$data['content']		= $this->load->view('admin/user', $subdata, true);
		$this->load->view('admin/template', $data);	
	}
	
	public function user_edit($id = ''){
		credential_administrator(array(1,2,3,4));
		$id = inject($id);
		if ($id != '') {
			$subdata['action']	 	= site_url('home/user_proses_edit/'.$id);
			$subdata['get']			= $this->m_users->get_user_by_id($id);
			$subdata['desa']		= $this->m_desa->get_all_desa();
			$subdata['alert']		= $this->session->flashdata('message');
			$subdata['title']		= 'Ubah Data Pengguna';
			$data['content']		=$this->load->view('admin/edit_user', $subdata, true);
			$this->load->view('admin/template',$data);
		} else{
			redirect('home/user_daftar');
		}
	}
	
	public function user_proses_edit($id = ''){
		credential_administrator(array(1,2,3,4));
		$id = inject($id);
		if ($id != '') {
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
			$this->form_validation->set_rules('id_level', 'Hak Akses', 'required');
			
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message', '<div class="callout callout-warning" style="width:95%"><a class="close"></a><p>'.validation_errors().'</p></div>');
				redirect('home/user_edit/');
			} else {
				$nama			= inject($this->input->post('nama'));
				$username		= inject($this->input->post('username'));
				$password		= inject($this->input->post('password'));
				$no_telp		= inject($this->input->post('no_telp'));
				$data			= array(
								'nama'			=> $nama,
								'username'		=> $username,
								'no_telp'		=> $no_telp
				);
				if ($password != "") {
					$data['password']		= md5($password);
				}
				
				$this->m_users->update_user($data, $id);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
																<h4><i class="icon fa fa-check"></i> Sukses!</h4>
																Data pengguna telah diubah.
															  </div>');
				redirect('home/user_edit/'.$id);
			}
		} else{
			redirect('home/user_daftar');
		}
	}
	
	public function user_delete($id = '') {
		credential_administrator(1);
		$id = inject($id);
		if ($id !='') {
			$this->m_users->delete_user($id);
			redirect ('home/user_daftar');
		}else {
			redirect ('home/user_daftar');
		}
	}
    /*USERS*/
	
	/*Ibu*/
	public function ibu_input(){
		credential_administrator(2);
			$subdata['action']	  	= site_url('home/ibu_proses_input/');
			$databidan			    = $this->session->userdata('pengguna');
			$id						= $databidan['id_user'];
			$subdata['alert']		= $this->session->flashdata('message');
			$subdata['title']		= 'Menambah Data Ibu Baru';
			$data['content']		=$this->load->view('bides/input_ibu', $subdata, true);
			$this->load->view('bides/template',$data);
	}
	
	public function ibu_proses_input() {
		credential_administrator(2);
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('nik', 'Nomor Induk Kependudukan', 'required');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir Ibu', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('status_bpjs', 'Bpjs', 'required');
		$this->form_validation->set_rules('status_resiko', 'Status Resiko', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="callout callout-warning"></a><p>'.validation_errors().'</p></div>');
			redirect('home/ibu_input/');
		}else{
			$databidan		= $this->session->userdata('pengguna');
			$id_desa		= $databidan['id_desa'];
			$id_user		= $databidan['id_user'];	
			$nik			= inject($this->input->post('nik'));
			$nama_ibu		= inject($this->input->post('nama_ibu'));
			$tanggal_lahir	= inject($this->input->post('tanggal_lahir'));
			$alamat			= inject($this->input->post('alamat'));
			$status_bpjs	= inject($this->input->post('status_bpjs'));
			$status_resiko	= inject($this->input->post('status_resiko'));		
			$data			= array(
								'nik'				=> $nik,
								'nama_ibu'			=> $nama_ibu,
								'tanggal_lahir'		=> $tanggal_lahir,
								'id_desa'			=> $id_desa,
								'alamat'			=> $alamat,
								'status_bpjs'		=> $status_bpjs,
								'waktu_daftar'		=> date("Y/m/d h:i:s"),
								'status_resiko'		=> $status_resiko,
								'daftar_by'			=> $id_user,
								
							);			
			$this->m_ibu->insert_ibu($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success"style="width:95%"><a class="close"></a><p>Berhasil Menambahkan Data Ibu</p></div>');
			redirect('home/ibu_input/');
		}
	}
	/*Ibu*/

	/*KOHORT*/
	public function kohort_input() {
		credential_administrator(2);
		$subdata['action']		= site_url('home/kohort_proses_input');
		$subdata['alert']		= $this->session->flashdata('message');
		$databidan			    = $this->session->userdata('pengguna');
		$id						= $databidan['id_desa'];
		$subdata['hasil']		= $this->m_ibu->get_ibu_by_desa($id);
		$subdata['title']		= 'Tambah Data Kehamilan Baru';
		$data['content']		= $this->load->view('bides/input_kohort', $subdata, true);
		$this->load->view('bides/template', $data);	
	}
	
	public function kohort_proses_input() {
		credential_administrator(2);
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('id_ibu', 'Data Ibu', 'required');
		//$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		//$this->form_validation->set_rules('bpjs', 'Bpjs', 'required');
		$this->form_validation->set_rules('usia_hamil', 'Usia Hamil', 'required');
		$this->form_validation->set_rules('trimester', 'Trimester', 'required');
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
		$this->form_validation->set_rules('hdk', 'HDK', 'required');
		$this->form_validation->set_rules('abortus', 'Abortus', 'required');
		$this->form_validation->set_rules('pendarahan', 'Pendarahan', 'required');
		$this->form_validation->set_rules('infeksi', 'Infeksi', 'required');
		$this->form_validation->set_rules('kpd', 'Kpd', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="callout callout-warning"></a><p>'.validation_errors().'</p></div>');
			redirect('home/kohort_input/');
		}else{
			$databidan		= $this->session->userdata('pengguna');
			$id_desa		= $databidan['id_desa'];
			$id_user			= $databidan['id_user'];
			$id_ibu				= inject($this->input->post('id_ibu'));
			//$alamat			= inject($this->input->post('alamat'));
			//$bpjs				= inject($this->input->post('bpjs'));
			$usia_hamil			= inject($this->input->post('usia_hamil'));
			$hpl				= inject($this->input->post('hpl'));
			$trimester			= inject($this->input->post('trimester'));
			$anamnesis			= inject($this->input->post('anamnesis'));
			$berat_badan		= inject($this->input->post('berat_badan'));
			$tinggi_badan		= inject($this->input->post('tinggi_badan'));
			$tekanan_a			= inject($this->input->post('tekanan_a'));
			$tekanan_b			= inject($this->input->post('tekanan_b'));
			$fundung_uterus		= inject($this->input->post('fundung_uterus'));
			$lingkar_lengan		= inject($this->input->post('lingkar_lengan'));
			$status_gizi		= inject($this->input->post('status_gizi'));
			$status_gizi		= inject($this->input->post('status_gizi'));
			$refleksi_patella	= inject($this->input->post('refleksi_patella'));
			$djj				= inject($this->input->post('djj'));
			$kepala				= inject($this->input->post('kepala'));
			$berat_janin		= inject($this->input->post('berat_janin'));
			$jumlah_janin		= inject($this->input->post('jumlah_janin'));
			$presentasi			= inject($this->input->post('presentasi'));
			$status_konseling	= inject($this->input->post('status_konseling'));
			$status_imunisasi	= inject($this->input->post('status_imunisasi'));
			$status_injeksi		= inject($this->input->post('status_injeksi'));
			$status_pencatatan	= inject($this->input->post('status_pencatatan'));
			$ps					= inject($this->input->post('ps'));
			$hb					= inject($this->input->post('hb'));
			$protein_urine		= inject($this->input->post('protein_urine'));
			$gula_darah			= inject($this->input->post('gula_darah'));
			$status_thalasemia	= inject($this->input->post('status_thalasemia'));
			$status_sifilis		= inject($this->input->post('status_sifilis'));
			$hbsag				= inject($this->input->post('hbsag'));
			$hdk				= inject($this->input->post('hdk'));
			$abortus			= inject($this->input->post('abortus'));
			$pendarahan			= inject($this->input->post('pendarahan'));
			$infeksi			= inject($this->input->post('infeksi'));
			$kpd				= inject($this->input->post('kpd'));
			$data_kehamilan	= array(
								'id_user'				=> $id_user,
								'id_ibu'				=> $id_ibu,
								'waktu_daftar'			=> date("Y/m/d h:i:s"),
								'usia_kandungan_daftar'	=> $usia_hamil,
								//'alamat'				=> $alamat,
								//'bpjs'				=> $bpjs,
								'HPL'					=> $hpl
							);
			$data_periksa	= array(
								'id_ibu'				=> $id_ibu,
								'id_user'				=> $id_user,
								'tanggal_periksa'		=> date("Y/m/d"),
								'waktu_periksa'			=> time("h:i:s"),
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
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd
							);
							
			$this->m_kehamilan->insert_kehamilan($data_kehamilan);
			$this->m_pemeriksaan->insert_pemeriksaan($data_periksa);
			$this->session->set_flashdata('message', '<div class="alert alert-success"style="width:95%"><a class="close"></a><p>Berhasil Menambahkan Data Kehamilan</p></div>');
			redirect('home/kohort_input/');
		}
	
	}
	/*KOHORT*/
	
	/*Pemeriksaan*/
	public function pemeriksaan_input() {
		credential_administrator(2);
		$subdata['action']		= site_url('home/pemeriksaan_proses_input');
		$subdata['alert']		= $this->session->flashdata('message');
		$databidan			    = $this->session->userdata('pengguna');
		$id						= $databidan['id_desa'];
		$subdata['hasil']		= $this->m_kehamilan->get_kehamilan_berjalan_by_desa($id);
		$subdata['title']		= 'Tambah Data Pemeriksaan Baru';
		$data['content']		= $this->load->view('bides/input_kohort', $subdata, true);
		$this->load->view('bides/template', $data);	
	}
	
	public function pemeriksaan_proses_input() {
		credential_administrator(2);
		//untuk validasi ketika required = belum keisi maka nnti akan di peringati
		$this->form_validation->set_rules('id_ibu', 'Data Ibu', 'required');
		//$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		//$this->form_validation->set_rules('bpjs', 'Bpjs', 'required');
		$this->form_validation->set_rules('usia_hamil', 'Usia Hamil', 'required');
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
		$this->form_validation->set_rules('hdk', 'HDK', 'required');
		$this->form_validation->set_rules('abortus', 'Abortus', 'required');
		$this->form_validation->set_rules('pendarahan', 'Pendarahan', 'required');
		$this->form_validation->set_rules('infeksi', 'Infeksi', 'required');
		$this->form_validation->set_rules('kpd', 'Kpd', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="callout callout-warning"></a><p>'.validation_errors().'</p></div>');
			redirect('home/kohort_input/');
		}else{
			$databidan		= $this->session->userdata('pengguna');
			$id_desa		= $databidan['id_desa'];
			$id_user			= $databidan['id_user'];
			$id_ibu				= inject($this->input->post('id_ibu'));
			//$alamat			= inject($this->input->post('alamat'));
			//$bpjs				= inject($this->input->post('bpjs'));
			$usia_hamil			= inject($this->input->post('usia_hamil'));
			$hpl				= inject($this->input->post('hpl'));
			$trimester			= inject($this->input->post('trimester'));
			$anamnesis			= inject($this->input->post('anamnesis'));
			$berat_badan		= inject($this->input->post('berat_badan'));
			$tinggi_badan		= inject($this->input->post('tinggi_badan'));
			$tekanan_a			= inject($this->input->post('tekanan_a'));
			$tekanan_b			= inject($this->input->post('tekanan_b'));
			$fundung_uterus		= inject($this->input->post('fundung_uterus'));
			$lingkar_lengan		= inject($this->input->post('lingkar_lengan'));
			$status_gizi		= inject($this->input->post('status_gizi'));
			$status_gizi		= inject($this->input->post('status_gizi'));
			$refleksi_patella	= inject($this->input->post('refleksi_patella'));
			$djj				= inject($this->input->post('djj'));
			$kepala				= inject($this->input->post('kepala'));
			$berat_janin		= inject($this->input->post('berat_janin'));
			$jumlah_janin		= inject($this->input->post('jumlah_janin'));
			$presentasi			= inject($this->input->post('presentasi'));
			$status_konseling	= inject($this->input->post('status_konseling'));
			$status_imunisasi	= inject($this->input->post('status_imunisasi'));
			$status_injeksi		= inject($this->input->post('status_injeksi'));
			$status_pencatatan	= inject($this->input->post('status_pencatatan'));
			$ps					= inject($this->input->post('ps'));
			$hb					= inject($this->input->post('hb'));
			$protein_urine		= inject($this->input->post('protein_urine'));
			$gula_darah			= inject($this->input->post('gula_darah'));
			$status_thalasemia	= inject($this->input->post('status_thalasemia'));
			$status_sifilis		= inject($this->input->post('status_sifilis'));
			$hbsag				= inject($this->input->post('hbsag'));
			$hdk				= inject($this->input->post('hdk'));
			$abortus			= inject($this->input->post('abortus'));
			$pendarahan			= inject($this->input->post('pendarahan'));
			$infeksi			= inject($this->input->post('infeksi'));
			$kpd				= inject($this->input->post('kpd'));
			$data_periksa	= array(
								'id_ibu'				=> $id_ibu,
								'id_user'				=> $id_user,
								'tanggal_periksa'		=> date("Y/m/d"),
								'waktu_periksa'			=> time("h:i:s"),
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
								'hdk'					=> $hdk,
								'abortus'				=> $abortus,
								'pendarahan'			=> $pendarahan,
								'infeksi'				=> $infeksi,
								'kpd'					=> $kpd
							);
							
			$this->m_kehamilan->insert_kehamilan($data_kehamilan);
			$this->m_pemeriksaan->insert_pemeriksaan($data_periksa);
			$this->session->set_flashdata('message', '<div class="alert alert-success"style="width:95%"><a class="close"></a><p>Berhasil Menambahkan Data Kehamilan</p></div>');
			redirect('home/kohort_input/');
		}
	
	}
	/*Pemeriksaan*/
	
	/*Kehamilan*/
	public function kehamilan_berjalan_daftar(){                                        
		credential_administrator(2);
		$databidan				= $this->session->userdata('pengguna');
		$id						= $databidan['id_desa'];
		$subdata['hasil']		= $this->m_kehamilan->get_kehamilan_berjalan_by_desa($id);
		//$subdata['username']    = $this->session->userdata('username');
		$subdata['title']		= 'Daftar Kehamilan Berjalan';
		$data['content']		= $this->load->view('bides/kehamilan_berjalan', $subdata, true);
		$this->load->view('bides/template', $data);	
	}
	/*Kehamilan*/
	
	
}
    
?>