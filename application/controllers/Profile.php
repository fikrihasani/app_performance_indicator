<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));

                if($this->session->userdata('username') != TRUE){
                    $url=base_url();
                    redirect($url);
                }
        }

    public function index(){
        $data['title'] = 'Profile';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('profile/index');
		$this->load->view('templates/layout_footer');
		$this->load->view('templates/footer');
    }

    public function edit(){
        $data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('nama','Full Name','required|trim');
        $this->form_validation->set_rules('nik','Nik','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim');
        $this->form_validation->set_rules('jabatan','Jabatan','required|trim');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('profile/edit',$data);
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/footer');
        }else{
            $email = $this->input->post('email');
            $name = $this->input->post('nama',TRUE);
            
            //  Cek jika ada gambar yang ingin di upload
            $upload_image = $_FILES['image']['name'];
          
             if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']    = 700;
                $config['upload_path'] = './assets/upload/profile/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')){
                    // Ngecek gambar lama
                    $old_image = $data['user']['image'];
                    if($old_image != 'default.png'){
                        unlink(FCPATH .  'assets/upload/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $data = [
                        "nama" => $name,
                        "nik" => $this->input->post('nik',TRUE),
                        "jabatan" => $this->input->post('jabatan',TRUE),
                        "image" => $new_image,
                     ];
                }
                else{
                    $this->session->set_flashdata('flash','Gagal Diupdate, photo tidak sesuai ketentuan');
                    redirect('profile');
                }
             }
             else{
                $data = [
                    "nama" => $name,
                    "nik" => $this->input->post('nik',TRUE),
                    "jabatan" => $this->input->post('jabatan',TRUE),
                 ];
             }

            $this->db->where('email',$email);
            $this->db->update('user',$data);

             $this->session->set_flashdata('flash','Berhasil Diupdate');
             redirect('profile');
         }
    }


    public function Change_Password(){
        $data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();


        $this->form_validation->set_rules('current_password','Current Password','required|trim');
        $this->form_validation->set_rules('new_password1',' New Password','required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2','Confirm New Password','required|trim|min_length[5]|matches[new_password1]');

        if($this->form_validation->run()== FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('profile/change_password');
            $this->load->view('templates/layout_footer');
            $this->load->view('templates/footer');
        }
        else{
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if(!password_verify($current_password,$data['user']['password'])){
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Wrong current wassword! </div>');
                redirect('profile/Change_Password');
            }
            else{
                if($current_password == $new_password){
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    New password cannot be the same as current password</div>');
                    redirect('profile/Change_Password');
                }
                else{
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password',$password_hash);
                    $this->db->where('username',$this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('flash','Berhasil Diupdate');
                redirect('profile');
                }
            }
        }
		
    }
		
}
