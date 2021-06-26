<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user','mod');
    }

    public function index()
    {
        $data['user']=$this->mod->m_show()->result();
        $this->template->load('template','user/index', $data);
    }

    public function store()
    {
        $post = [
            "username"  => $this->input->post("username", TRUE),
            "password"  => password_hash($this->input->post("password", TRUE), PASSWORD_DEFAULT),
            "nama"      => $this->input->post("nama", TRUE),
            "no_telp"   => $this->input->post("no_telp", TRUE),
            "alamat"    => $this->input->post("alamat", TRUE),
            "level"     => $this->input->post("level", TRUE) 
        ];
        $this->mod->m_store($post);
        redirect('user');
    }

    public function update()
    {
        $post = [
            "id_user"   => $this->input->post("id_user", TRUE),
            "username"  => $this->input->post("username", TRUE),
            "nama"      => $this->input->post("nama", TRUE),
            "no_telp"   => $this->input->post("no_telp", TRUE),
            "alamat"    => $this->input->post("alamat", TRUE),
            "level"     => $this->input->post("level", TRUE) 
        ];
        $this->mod->m_update($post);
        redirect('user');
    }

    public function destroy()
    {
        $id_user = $this->input->post("id_user", TRUE);
        $data = $this->mod->m_destroy($id_user);
        echo json_encode($data);
    }
}