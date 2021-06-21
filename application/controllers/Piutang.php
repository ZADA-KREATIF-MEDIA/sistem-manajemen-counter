<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Piutang extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->Model('Model_piutang','mod');
    }

    public function index()
    {
        $data['piutang'] = $this->mod->m_get_piutang();
        $data['piutang_bl'] = $this->mod->m_get_piutang_bl();
        $data['piutang_transaksi'] = $this->mod->m_get_piutang_transaksi();
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'piutang/index', $data);
    }

    public function edit_piutang()
    {
        $this->template->load('template','piutang/edit');
    }

    public function get_harga_piutang()
    {
        $id = $this->input->post('id',true);
        $data = $this->mod->m_get_harga_piutang($id);
        echo json_encode($data);
    }

    public function update()
    {   
        $id         = $this->input->post('piutang',true);
        $tanggal    = date("Y-m-d H:i:s",strtotime($this->input->post('tanggal',true)." ".date("H:i:s")));
        $nominal    = str_replace(".","",$this->input->post('nominal_bayar'));
        $post =[
            'id_piutang'     => $id,
            'nominal'       => $nominal,
            'tanggal_bayar' => $tanggal,
            'keterangan'    => $this->input->post('keterangan',true)
        ];
        $nominal_terbayar = $this->mod->m_get_harga_piutang($id);
        $nominal_terbayar_new = $nominal_terbayar->nominal_terbayar + $nominal;
        $jumlah_utang = $nominal_terbayar->nominal_piutang - $nominal;
        $this->mod->m_save_piutang_transaksi($post);
        $update = [
            'id'                => $id,
            'nominal_piutang'   => $jumlah_utang,
            'nominal_terbayar'  => $nominal_terbayar_new
        ];
        $this->mod->m_update_nominal_piutang($update);
        $cek = $this->mod->m_get_harga_piutang($id);
        if($cek->nominal_piutang == 0){
            $status = 'lunas';
        }else{
            $status = 'belum';
        }
        $update_status = [
            'id'        => $id,
            'status'    => $status        
        ];
        $this->mod->m_update_status_piutang($update_status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Pembayaran Piutang Berhasil
            </div>');
        redirect('piutang');

    }

    public function reset_data_piutang()
    {
        $id = $this->input->post('id',TRUE);
        $penjualan = $this->mod->m_get_detail_penjualan($id);
        $detail_piutang = $this->mod->m_get_detail_piutang($id);
        $id_pembelian = $detail_piutang['id'];
        $total_piutang = $penjualan['harga_beli'] - $penjualan['uang_muka'];
        $post = [
            'nominal_piutang'   => $total_piutang,
            'nominal_terbayar'  => $penjualan['uang_muka'],
            'status'            => 'belum',
            'id_pembelian'      => $id
        ];
        $this->mod->m_reset_pembelian($post);
        $this->mod->m_destroy_piutang_pembayaran($id_pembelian);
        // print_r($detail_piutang);
    }
}