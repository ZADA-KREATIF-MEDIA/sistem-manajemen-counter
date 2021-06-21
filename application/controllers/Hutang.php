<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Hutang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Model_hutang','mod');
    }

    public function index()
    {
        $data['hutang'] = $this->mod->m_get_hutang();
        $data['hutang_bl'] = $this->mod->m_get_hutang_bl();
        $data['hutang_transaksi'] = $this->mod->m_get_hutang_transaksi();
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'hutang/index', $data);
    }

    public function get_harga_hutang()
    {
        $id = $this->input->post('id',true);
        $data = $this->mod->m_get_harga_hutang($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id         = $this->input->post('hutang',true);
        $tanggal    = date("Y-m-d H:i:s",strtotime($this->input->post('tanggal',true)." ".date("H:i:s")));
        $nominal    = str_replace(".","",$this->input->post('nominal_bayar'));
        $post =[
            'id_hutang'     => $id,
            'nominal'       => $nominal,
            'tanggal_bayar' => $tanggal,
            'keterangan'    => $this->input->post('keterangan',true)
        ];
        $nominal_terbayar = $this->mod->m_get_harga_hutang($id);
        $nominal_terbayar_new = $nominal_terbayar->nominal_terbayar + $nominal;
        $jumlah_utang = $nominal_terbayar->nominal_hutang - $nominal;
        $this->mod->m_save_hutang_transaksi($post);
        $update = [
            'id'                => $id,
            'nominal_hutang'    => $jumlah_utang,
            'nominal_terbayar'  => $nominal_terbayar_new
        ];
        $this->mod->m_update_nominal_hutang($update);
        $cek = $this->mod->m_get_harga_hutang($id);
        if($cek->nominal_hutang == 0){
            $status = 'lunas';
        }else{
            $status = 'belum';
        }
        $update_status = [
            'id'        => $id,
            'status'    => $status        
        ];
        $this->mod->m_update_status_hutang($update_status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pembayaran Hutang Berhasil
            </div>');
        redirect('hutang');
    }

    public function reset_data_hutang()
    {
        $id = $this->input->post('id',TRUE);
        $pembelian = $this->mod->m_get_detail_pembelian($id);
        $detail_hutang = $this->mod->m_get_detail_hutang($id);
        $id_pembelian = $detail_hutang['id'];
        $post = [
            'nominal_hutang'   => $pembelian['harga_beli'],
            'nominal_terbayar'  => $pembelian['uang_muka'],
            'status'            => 'belum',
            'id_pembelian'      => $id
        ];
        $this->mod->m_reset_pembelian($post);
        $this->mod->m_destroy_hutang_pembayaran($id_pembelian);
    }
}