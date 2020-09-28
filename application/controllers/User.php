<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_Model');

        if($this->session->userdata('level') != 1){
            $url=base_url();
            redirect($url);
        }
    }

    public function index(){
        $data['title'] = 'Menu User';
        $data['user2'] = $this->User_Model->getAllUser();
        $data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('user/index',$data);
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
    }

    public function in_add(){
        $data['title'] = 'Add User';
        $data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
        
        $this->form_validation->set_rules('username','Username','required|trim|min_length[5]|is_unique[user.username]',[
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('password1','Password','required|trim|min_length[5]|matches[password2]',[
            'matches' => 'Password dont match!',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');
        $this->form_validation->set_rules('nama','Nama Lengkap','required|trim');
        $this->form_validation->set_rules('nik','Nik','required|trim|min_length[16]|numeric');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('jabatan','Jabatan','required|trim');


        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('user/add_user');
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/theme');
            $this->load->view('templates/footer');
        }else{
            //  Cek jika ada gambar yang ingin di upload
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/profile/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    $new_image = $this->upload->data('file_name');
                    $this->User_Model->addData($new_image);

                    // // siapkan token
                    // $email = $this->input->post('email',TRUE);
                    // $token = base64_encode(random_bytes(32));
                    // $user_token = [
                    //     'email' => $email,
                    //     'token' => $token,
                    //     'date_created' => time()
                    // ];

                    // //input database
                    // $this->db->insert('user_token',$user_token);
                    // $this->_sendEmail($token,'verify');
				}
				else{
					$this->session->set_flashdata('flash','Gagal ditambahkan, photo tidak sesuai ketentuan');
                    redirect('user/in_add');
				}
			}
			else{
				$foto = 'default.png';
                $this->User_Model->addData($foto);
                
                //  // siapkan token
                //  $email = $this->input->post('email',TRUE);
                //  $token = base64_encode(random_bytes(32));
                //  $user_token = [
                //      'email' => $email,
                //      'token' => $token,
                //      'date_created' => time()
                //  ];

                //  //input database
                //  $this->db->insert('user_token',$user_token);
                //  $this->_sendEmail($token,'verify');
			}
			
			 $this->session->set_flashdata('flash','Berhasil Ditambahkan');
			 redirect('user');
        }
		
    }

    private function _sendEmail($token,$type){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'fajarhdytt30@gmail.com',
            'smtp_pass' => 'F4j4rhgl@30',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];


        $this->load->library('email',$config);  
        $this->email->initialize($config); 

        $this->email->from('fajarhdytt30@gmail.com','Fajar Hidayat');
        $this->email->to($this->input->post('email'));

        if($type == 'verify'){
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="'. base_url() . 'user/verify?email=' .$this->input->post('email') . '&token=' .urlencode($token). '">Active</a>');
        }

        if($this->email->send()){
            return true;
        }
        else{
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify(){
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user){
            $user_token = $this->db->get_where('user_token',['token' => $token])->row_array();

            if($user_token){
                if(time() - $user_token['date_created'] < (60*60*24)){
                    $this->db->set('is_active',1);
                    $this->db->where('email',$email);
                    $this->db->update('user');

                    $this->db->delete('user_token',['email' => $email]);

                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                    '. $email .' has been activated! Please login. </div>');
                    redirect('auth');
                }
                else{

                    $this->db->delete('user',['email' => $email]);
                    //where email sama dengan email
                    $this->db->delete('user_token',['email' => $email]);

                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Account activation failed! Token expired.</div>');
                    redirect('auth');
                }
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Account activation failed! Wrong token.</div>');
                redirect('auth');
            }
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			  Account activation failed! Wrong email.</div>');
			redirect('auth');
        }
    }
    
    public function hapus($id){
        $this->User_Model->hapusData($id);
		$this->session->set_flashdata('flash','Berhasil Dihapus');
		redirect('user');
    }

}