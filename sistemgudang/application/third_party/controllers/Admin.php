<?php
Class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('m_users');
        $this->load->model('m_cabang');
    }

    //User_input() :
    public function user_input() {
        if(!is_auth(1)) {redirect('discover/keluar');}

        $profile                    = get_profile();
        $subdata['action']          = site_url('admin/user_proses_input');
		$subdata['hasil']			= $this->m_cabang->get_all_cabang();
        //$subdata['hasil']           = $this->db->query("SELECT id_cabang, nama_cabang FROM daftar_cabang where id_cabang NOT IN (SELECT DISTINCT desa.id_desa from user join desa ON user.id_desa = desa.id_desa)")->result_array();

        $data['title']              = 'Tambah Pengguna';
        $data['meta_title']         = "Tambah Pengguna";
        $data['meta_description']   = "Tambah Pengguna Antenatal Care";
        $data['breadcrumb']         = "Antenatal Care~Pengguna~Tambah";

        $data['js_assets'] = [
            render_inline_js("
                $(document).ready(function(){

                    $('.select2').on('select2:select', function (e) {
                        var data = e.params.data;

                        if(data.id == '2') {
                            $('.select2disable').removeAttr('disabled');
                        }else {
                            $('.select2disable').select2('enable', false);
                        }
                    });
                })

            "),
            ];

        $data['content']            = render_view('admin/input_user', $subdata, true);
        render_view('template', $data);
    }

    public function user_proses_input() {
        if(!is_auth(1)) {redirect('discover/keluar');}

        //untuk validasi ketika required = belum keisi maka nnti akan di peringati
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[35]');
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[25]');
        $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'required|max_length[25]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|integer|max_length[12]');
        $this->form_validation->set_rules('id_level', 'level', 'required');
        $level          = inject($this->input->post('id_level'));
		$nip            = inject($this->input->post('nip'));
		$ceknip			= $this->db->query("SELECT * from user WHERE nip = '$nip'")->row_array();
        if($level == 2){
            $this->form_validation->set_rules('id_desa', 'Desa', 'required');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', render_error('Validasi Error!', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
            redirect('doctor/user_input/');
        }else if($ceknip !=""){
			$this->session->set_flashdata('message', render_error('ID Pengguna telah digunakan', validation_errors()));
			$this->session->set_flashdata('last_posting', $_POST);
            redirect('doctor/user_input/');
		}else{
            $nama           = inject($this->input->post('nama'));
            $nip            = inject($this->input->post('nip'));
            $username       = inject($this->input->post('username'));
            $password       = inject($this->input->post('password'));
            $no_telp        = inject($this->input->post('no_telp'));
            $level          = inject($this->input->post('id_level'));
            $id_desa        = inject($this->input->post('id_desa'));
            $data           = array(
                                'nama'          => $nama,
                                'nip'           => $nip,
                                'username'      => $username,
                                'password'      => md5($password),
                                'no_telp'       => $no_telp,
                                'id_level'      => $level
                            );
            if ($id_desa != "" && $level == 2) {
                    $data['id_desa']        = $id_desa;
                }else{
					$data['id_desa']		= null;
				}
            $this->m_users->insert_user($data);
            $this->session->set_flashdata('message', render_success('Input Berhasil', "Berhasil Menambahkan Data Pengguna"));
            redirect('admin/user_input/');
        }
    }

    public function user_daftar() {
        if(!is_auth(1)) {redirect('discover/keluar');}

        $subdata['username']    = $this->session->userdata('username');
        $subdata['level']       = $this->m_users->get_level();
        $data['title']              = 'Pengguna';
        $data['meta_title']         = "Pengguna";
        $data['meta_description']   = "Pengguna Antenatal Care";
        $data['breadcrumb']         = "Antenatal Care~Pengguna~Daftar";
        $data['content']            = render_view('admin/user', $subdata, true);
        render_view('template', $data);
    }

    public function source_user_list() {
        //variable
        $page        = inject($_POST['current_page']);

         /* Set Limit */
        $limit = 10;
        $start = ($limit * $page) - $limit;

        $content = $this->m_users->get_all_user($_POST, $limit + 1, $start);
        $level   = $this->m_users->get_level();

        $result['content'] = render_view('admin/ajax_user', ['data' => $content, 'level' => $level,  'limit' => $limit], true);
        $result['page'] = $page;
        $result['hasPrev'] = ($page > 1) ? 'true' : 'false';
        $result['hasNext'] = (count($content) > $limit) ? 'true' : 'false';

        echo json_encode($result);

    }

    public function user_edit($id = ''){
        if(!is_auth()) redirect('discover/keluar');
        $id = inject($id);

        if($id == "") redirect('admin/user_daftar');

        $user_id = simple_decrypt($id);
        $user    = $this->m_users->get_user_by_id($user_id);

        if(empty($user)) redirect('admin/user_daftar') ;

        if ($id != '') {
            $subdata['action']      = site_url('admin/user_proses_edit/'.$id);
            $subdata['get']         = $user;
            $subdata['desa']        = $this->m_cabang->get_all_cabang();

            // $subdata['desa2']       = $this->db->query("SELECT id_desa, nama_desa FROM desa where id_desa NOT IN (SELECT DISTINCT desa.id_desa from user join desa ON user.id_desa = desa.id_desa WHERE  user.id_desa <> '99')")->result_array();

            $subdata['desa_user'] = $this->db->query("SELECT DISTINCT id_cabang FROM user WHERE id_cabang <> 99 and id_cabang IS NOT NULL")->result_array();


            $subdata['level']       = $this->db->query("SELECT id_level, level FROM level where id_level NOT IN (SELECT DISTINCT level.id_level from user join level ON user.id_level = level.id_level WHERE NOT user.id_level = '5' AND NOT user.id_level = '2')")->result_array();
            $data['title']              = 'Ubah Data Pengguna';
            $data['meta_title']         = "Ubah Data Pengguna";
            $data['meta_description']   = "Ubah Data Pengguna Antenatal Care";
            $data['breadcrumb']         = "Antenatal Care~Pengguna~Ubah";
			if(is_auth(1)){
				$data['content']            =render_view('admin/edit_user', $subdata, true);
			}else{
				$data['content']            =render_view('edit_user', $subdata, true);
			}

            render_view('template',$data);
        } else{
            redirect('admin/user_daftar');
        }
    }

    public function user_proses_edit($id = ''){
        if(!is_auth()) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('admin/user_daftar');}

        $user_id = simple_decrypt($id);
        $user    = $this->m_users->get_user_by_id($user_id);
        if(empty($user)){ redirect('admin/user_daftar');}
		if(!is_auth()) {redirect('discover/keluar');}
        if ($id != '') {
            $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[35]');
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[25]');
			$this->form_validation->set_rules('no_telp', 'No Telepon', 'required|integer|max_length[12]');
			$id_level       = inject($this->input->post('id_level'));
			$nip            = inject($this->input->post('nip'));
            $ceknip			= $this->db->query("SELECT * from user WHERE nip = '$nip'")->row_array();

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', render_error('Validasi Error', validation_errors()));
                redirect('admin/user_edit/'.$id);
            }else if($ceknip !="" && $ceknip['nip'] !== $nip){
				$this->session->set_flashdata('message', render_error('ID Pengguna telah digunakan', validation_errors()));
				$this->session->set_flashdata('last_posting', $_POST);
				redirect('admin/user_input/');
			}else {
				if(is_auth(1)){
					$nama           = inject($this->input->post('nama'));
					$username       = inject($this->input->post('username'));
					$password       = inject($this->input->post('password'));
					$no_telp        = inject($this->input->post('no_telp'));
					$id_desa        = inject($this->input->post('id_desa'));

					$data           = array(
									'nama'          => $nama,
									'nip'           => $nip,
									'username'      => $username,
									'id_level'      => $id_level,
									'no_telp'       => $no_telp,
									
					);

                    if($id_desa != ""){
                        $data['id_desa'] = $id_desa;
                    }

					if ($password != "") {
						$data['password']       = md5($password);
					}
				}else{
					$nama           = inject($this->input->post('nama'));
					$username       = inject($this->input->post('username'));
					$no_telp        = inject($this->input->post('no_telp'));
					$data           = array(
									'nama'          => $nama,
									'username'      => $username,
									'no_telp'       => $no_telp
					);
				}


                $this->m_users->update_user($data, $user_id);
                $this->session->set_flashdata('message', render_success('Berhasil!', 'Data pengguna telah diubah.'));
                redirect('admin/user_edit/'.$id);
            }
        } else{

            redirect('admin/user_daftar');
        }
    }

    public function user_change($id = '') {
        if(!is_auth(1)) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('admin/user_daftar');}

        $user_id = simple_decrypt($id); //dumper($user_id);
        $user    = $this->m_users->get_user_by_id($user_id);
        if(empty($user)){ redirect('admin/user_daftar');}

        if ($id !='') {
			if ($user['user_status'] == 0){
				$data  = array(
						 'user_status'   => 1
					);
				if($user['id_level'] == 2){
					$data['id_desa'] = 99;
				}
				$this->m_users->update_user($data, $user_id);
				$this->session->set_flashdata('message', render_success('Berhasil!', 'Data pengguna telah di Non-Aktifkan.'));
				redirect ('admin/user_daftar');
			}else if($user['user_status'] == '1'){
				$data  = array(
						 'user_status'   => 0
					);
				if($user['id_level'] == 3 || $user['id_level'] == 4){
					$data['id_level'] = 5;
				}
				$this->m_users->update_user($data, $user_id);
			$this->session->set_flashdata('message', render_success('Berhasil!', 'Data pengguna telah diaktifkan kembali.'));
            redirect ('admin/user_daftar');
			}
        }else {
            redirect ('admin/user_daftar');
        }
    }

	public function user_delete($id = '') {
        if(!is_auth(1)) {redirect('discover/keluar');}

        $id = inject($id);
        if($id == ""){ redirect('admin/user_daftar');}

        $user_id = simple_decrypt($id); //dumper($user_id);
        $user    = $this->m_users->get_user_by_id($user_id);
        if(empty($user)){ redirect('doctor/user_daftar');}

        if ($id !='') {
				$this->m_users->delete_user($user_id);
				$this->session->set_flashdata('message', render_success('Berhasil!', 'Data pengguna telah di Hapus'));
				redirect ('admin/user_daftar');
        }else {
            redirect ('admin/user_daftar');
        }
    }

	public function password_update($id = ''){
      if(!is_auth()) {redirect('discover/keluar');}

      $profile = get_profile();

      $id = inject($id);
      $id_user    = simple_decrypt($id);
      $user        = $this->m_users->get_user_by_id($id_user);
      if($id == ""){ redirect('discover/keluar');}
      if(empty($user)){ redirect('discover/keluar');}

      if ($id != '') {
          $subdata['action']      = site_url('doctor/password_proses_update/'.$id);
          $subdata['get']		     	= $user;
          $data['title']              = 'Ubah Password';
          $data['meta_title']         = "Ubah Password";
          $data['meta_description']   = "Ubah Password Pengguna Antenatal Care";
          $data['breadcrumb']         = "Antenatal Care~Password~Ubah";
          $data['content']            = render_view('password_update', $subdata, true);
          render_view('template',$data);

      } else{
          redirect('discover/keluar');
      }
  }

  public function password_proses_update($id = ''){
      if(!is_auth()) {redirect('discover/keluar');}
	  $profile = get_profile();

      $id = inject($id);
      $id_user     = simple_decrypt($id);
      if($id == ""){ redirect('discover/keluar');}

      if ($id !='') {
          $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
          $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[8]');
          $this->form_validation->set_rules('konfirmasi_password_baru', 'Konfirmasi Password', 'required|matches[password_baru]');

          $password_lama      		 = inject($this->input->post('password_lama'));
          $password        	  		 = md5($password_lama);
          $password_baru  	  		 = inject($this->input->post('password_baru'));
          $password_x   	  		 = md5($password_baru);
          $konfirmasi_password_baru  = inject($this->input->post('konfirmasi_password_baru'));
          if ($this->form_validation->run() == FALSE) {
              $this->session->set_flashdata('message', render_error('Validasi Error', validation_errors()));
			  $this->session->set_flashdata('last_posting', $_POST);
              redirect('doctor/password_update/'.$id);
          }else if ($password != password()){
            $this->session->set_flashdata('message',render_error("Perhatian!", "Password Lama Salah"));
			$this->session->set_flashdata('last_posting', $_POST);
            redirect('doctor/password_update/'.$id);
          }else if ($password_x == password()){
            $this->session->set_flashdata('message',render_error("Perhatian!", "Password Baru Tidak Boleh Sama Dengan Password Lama"));
			$this->session->set_flashdata('last_posting', $_POST);
            redirect('doctor/password_update/'.$id);
          }else{
            $data           = array(
                                'password'     => md5($password_baru),
                                'waktu_ubah'   => date('Y-m-d H:i:s'),
                                'ubah_by'      => $id_user
                            );
              $this->m_users->update_user($data, $id_user);
              $this->session->set_flashdata('message', render_success('Berhasil!', 'Password telah diubah.'));
              redirect('admin/password_update/'.$id);
          }
      } else{
          redirect('discover/keluar');
      }
    }
}
