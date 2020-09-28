<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Login Page';

		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		}else{
			// validasinya success
			$this->_login();
		}
	}

	public function _login(){
	    date_default_timezone_set('Asia/Jakarta');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		
		// jika usernya ada
		if($user){
			//jika usernya aktif
			if($user['is_active']==1){
				// cek password
				if(password_verify($password, $user['password'])){
					$data= [
						'username' => $user['username'],
						'level' => $user['level'],
						'nama' => $user['nama']
					];

					$this->session->set_userdata($data);
					if($user['level']==1){
						//insert ke tabel history system
						$data2 = [
							"nama_user" => $this->session->userdata('nama'),
							"time" => date("Y-m-d H:i:s", time()),
							"nama_menu" => 'Login',
							"aksi" => 'Berhasil Login Kedalam System',
						];
						$this->db->insert('history_system',$data2);
						redirect('profile');
					}
					else if($user['level']==2){
						//insert ke tabel history system
						$data2 = [
							"nama_user" => $this->session->userdata('nama'),
							"time" => date("Y-m-d H:i:s", time()),
							"nama_menu" => 'Login',
							"aksi" => 'Berhasil Login Kedalam System',
						];
						$this->db->insert('history_system',$data2);
						redirect('profile');
					}
					else if($user['level']==3){
						//insert ke tabel history system
						$data2 = [
							"nama_user" => $this->session->userdata('nama'),
							"time" => date("Y-m-d H:i:s", time()),
							"nama_menu" => 'Login',
							"aksi" => 'Berhasil Login Kedalam System',
						];
						$this->db->insert('history_system',$data2);
						redirect('profile');
					}
					else if($user['level']==4){
						//insert ke tabel history system
						$data2 = [
							"nama_user" => $this->session->userdata('nama'),
							"time" => date("Y-m-d H:i:s", time()),
							"nama_menu" => 'Login',
							"aksi" => 'Berhasil Login Kedalam System',
						];
						$this->db->insert('history_system',$data2);
						redirect('gudang');
					}
				}	
				else{
					//insert ke tabel history system
					$data2 = [
						"nama_user" => $this->session->userdata('nama'),
						"time" => date("Y-m-d H:i:s", time()),
						"nama_menu" => 'Login',
						"aksi" => 'Gagal Login Kedalam System, Password salah!',
					];
					$this->db->insert('history_system',$data2);

					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Login failed! Wrong password.</div>');
					redirect('auth');
				}
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			  This Account has not been activited</div>');
				redirect('auth');
			}
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			Account is not registered</div>');
			redirect('auth');
		}
	}

	public function logout(){
	    date_default_timezone_set('Asia/Jakarta');
		//insert ke tabel history system
		$data2 = [
			"nama_user" => $this->session->userdata('nama'),
			"time" => date("Y-m-d H:i:s", time()),
			"nama_menu" => 'Logout',
			"aksi" => 'Logout System',
		];
		$this->db->insert('history_system',$data2);

		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			  You have been logout</div>');
			redirect('auth');
	}

	public function forgotPassword(){
        $data['title'] = 'Forgot Password';

		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		if($this->form_validation->run()==FALSE){
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth_footer');
		}
		else{
			$email = $this->input->post('email');
			$user = $this->db->get_where('user',['email' => $email, 'is_active' => 1])->row_array();

			if($user){
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => date("Y-m-d H:i:s", time())
				];

				$this->db->insert('user_token',$user_token);
				$this->_sendEmail($token,'forgot');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Pleace check your email to reset your password!</div>');
				redirect('auth/forgotPassword');

			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Email is not registered or activated!</div>');
				redirect('auth/forgotPassword');
			}

		}
		
	}

	private function _sendEmail($token,$type){
        $config = [
            'protocol' => 'ssmtp',
            'smtp_host' => 'ssl://ssmtp.googlemail.com',
            'smtp_user' => 'aps.ahmad.yani@gmail.com',
            'smtp_pass' => 'bandara@30',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];


        $this->load->library('email',$config);  
        $this->email->initialize($config); 

        $this->email->from('aps.ahmad.yani@gmail.com','PT. Angkasa Pura Supports Semarang');
        $this->email->to($this->input->post('email'));

        if($type == 'forgot'){
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="'. base_url() . 'auth/resetpassword?email=' .$this->input->post('email') . '&token=' .urlencode($token). '">Reset Password</a>');
        }

        if($this->email->send()){
            return true;
        }
        else{
            echo $this->email->print_debugger();
            die;
        }
	}
	
	public function resetPassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user',['email' => $email])->row_array();

		if($user){
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
		
			if($user_token){
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Reset password failed! Wrong token.</div>');
				redirect('auth');
			}
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Reset password failed! Wrong email.</div>');
				redirect('auth');
		}
	}

	public function changePassword(){

		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}

		$this->form_validation->set_rules('password1','Password','trim|required|min_length[5]|matches[password2]');
		$this->form_validation->set_rules('password2','Password','trim|required|min_length[5]|matches[password1]');

		if($this->form_validation->run()==FALSE){
			$data['title'] = 'Change Password!';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/change-password');
			$this->load->view('templates/auth_footer');
		}
		else{
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password',$password);
			$this->db->where('email',$email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Password has been changed! Please login.</div>');
				redirect('auth');

		}
			
	}
}
