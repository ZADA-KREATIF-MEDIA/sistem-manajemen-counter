<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login','mod');
    }

    public function index()
    {

        $this->load->view('login/index');
    }

    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
		if($user ) {
            if(password_verify($password, $user['password'])) {
                //echo "sini";
                $data = [

                    'id_user'   => $user['id_user'],
                    'username'  => $user['username'],
                    'level'     => $user['level'],
                    'nama'      => $user['nama']
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
                
            } else {
                redirect('login');
            }
        }else{
            redirect('login');
        }
    }

    public function logout()
	{
		session_destroy();
		redirect('login');
	}

    
}