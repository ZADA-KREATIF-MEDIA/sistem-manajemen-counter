<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login', 'mod');
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
        if ($user) {
            if (password_verify($password, $user['password'])) {
                //echo "sini";
                $data = [

                    'id_user'   => $user['id_user'],
                    'username'  => $user['username'],
                    'level'     => $user['level'],
                    'nama'      => $user['nama']
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('sucess', "<div class='alert alert-success' role='alert'>
                &#x2639; Login berhasil :)
          </div>");
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', "<div class='alert alert-danger' role='alert'>
                &#x2639; Username atau Password Tidak Cocok
          </div>");
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', "<div class='alert alert-danger' role='alert'>
            &#x2639; Opss , User akun tidak terdaftar !!
          </div>");
            redirect('login');
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }
}
