<?php 
class Laporan_penjualan extends CI_Controller{

   function __construct() 
   {
      parent::__construct();
      $this->load->Model('Model_laporanPenjualan','mod');
   }

   public function index()
   {
      $data['laporan']=$this->mod->show_laporan()->result();
      // print('<pre>');print_r($data);exit();
      $this->template->load('template','laporan_penjualan/index',$data);
   }

   public function show_detail()
   {
      $imei = $this->uri->segment(3);
      $data['detail'] = $this->mod->m_get_detail($imei);
      // print('<pre>');print_r($data);exit();
      $this->template->load('template','laporan_penjualan/detail', $data);
   }

   public function edit_detail()
   {
      $imei = $this->uri->segment(3);
      $data['user']     = $this->mod->m_get_user()->result_array();
      $data['detail']   = $this->mod->m_get_detail($imei);
      // print('<pre>');print_r($data);exit();
      $this->template->load('template','laporan_penjualan/edit', $data);
   }

   public function upgrade()
   {
      $harga_beli = str_replace(".","",$this->input->post('harga_beli', true));
      $harga_jual = str_replace(".","",$this->input->post('harga_jual', true));
      $data = [
         'imei'            => $this->input->post('imei', true),
         'nama_barang'     => $this->input->post('nama_barang', true),
         'harga_beli'      => $harga_beli,
         'harga_jual'      => $harga_jual,
         'keterangan'      => $this->input->post('keterangan', true),
         'nama_customer'   => $this->input->post('nama_customer', true),
         'id_user'         => $this->input->post('id_user', true),
         'metode_bayar'    => $this->input->post('metode_bayar', true)
      ];
      // print('<pre>');print_r($data_barang);exit();
      $this->mod->m_update_penjualan($data);
      $_SESSION['msg'] = 'edit laporan penjualan berhasil';
      redirect('Laporan_penjualan');
   }

    public function hapus()
    {
      $id = $this->input->post('id',true);
      $data = $this->mod->m_hapus_laporan_penjualan($id);
      echo json_encode($data);
    }

}



