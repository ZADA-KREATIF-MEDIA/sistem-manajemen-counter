<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Saldo_awal extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->Model('Model_saldo_awal','mod');
    }

    public function index()
    {
        $data['saldo_awal'] = $this->mod->m_get_all();
        $this->template->load('template','saldo_awal/index',$data);
    }

    public function add()
    {
        $this->template->load('template','saldo_awal/add');
    }

    public function store()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal', TRUE)));
        $nominal = str_replace(".","",$this->input->post('nominal', TRUE));
        $post = [
            'tanggal'       => $tanggal,
            'nominal'       => $nominal,
            'keterangan'    => $this->input->post('keterangan',TRUE)
        ];
        $this->mod->m_store($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Simpan Saldo Awal Berhasil
            </div>');
        redirect('saldo_awal');
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        $data['detail'] = $this->mod->m_get_detail($id);
        $this->template->load('template','saldo_awal/edit',$data);
    }

    public function update()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal', TRUE)));
        $nominal = str_replace(".","",$this->input->post('nominal', TRUE));
        $post = [
            'id'        => $this->input->post('id',TRUE),
            'tanggal'   => $tanggal,
            'nominal'   => $nominal,
            'keterangan'=> $this->input->post('keterangan', TRUE)
        ];
        $this->mod->m_update($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit Saldo Awal Berhasil
        </div>');
        redirect('saldo_awal');
    }

    public function destroy()
    {
        $id = $this->uri->segment(3);
        $this->mod->m_destroy($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Saldo Awal Berhasil
        </div>');
        redirect('saldo_awal');
    }

}