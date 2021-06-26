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

    public function customer()
    {
        $data['customer']=$this->mod->m_get_customer()->result();
        $this->template->load('template','user/customer', $data);
    }

    public function store_customer()
    {
        $post = [
            "nama"          => $this->input->post("nama", TRUE),
            "no_telpn"      => $this->input->post("no_telp", TRUE),
            "alamat"        => $this->input->post("alamat", TRUE),
            "tgl_daftar"    => date('Y-m-d') 
        ];
        $this->mod->m_store_customer($post);
        redirect('user/customer');
    }

    public function update_customer()
    {
        $post = [
            "id_customer"   => $this->input->post('id_customer', TRUE),       
            "nama"          => $this->input->post("nama", TRUE),
            "no_telpn"      => $this->input->post("no_telp", TRUE),
            "alamat"        => $this->input->post("alamat", TRUE),
        ];
        $this->mod->m_update_customer($post);
        redirect('user/customer');
    }

    public function destroy_customer()
    {
        $id_customer = $this->input->post("id_customer", TRUE);
        $data = $this->mod->m_destroy_customer($id_customer);
        echo json_encode($data);
    }
}