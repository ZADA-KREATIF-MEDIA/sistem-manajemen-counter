<?php 
class Laporan_Pembelian extends CI_Controller{

	function __construct() {
        parent::__construct();
        $this->load->Model('Model_laporanPembelian','mod');
    }

    public function index()
    {
        $data['laporan']=$this->mod->show_laporan()->result();
        // print('<pre>');print_r($data);exit();
        $this->template->load('template','laporan_pembelian/index',$data);
    }

    public function hapus()
    {
      $kode_pembelian     = $this->input->post('kode_pembelian', TRUE);
      $data['pembelian']  = $this->mod->destroy($kode_pembelian);
      $data['barang']     = $this->mod->destroy_barang($kode_pembelian);
      echo json_encode($data);
    }

    public function show()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->show_detail($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'laporan_pembelian/detail', $data);
    }
    public function print()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->show_detail($id_customer);
       
        $data['item'] = $this->mod->show_detail($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->load->view('Laporan_pembelian/print', $data);
    }


    public function get_harga_keterangan_pembelian()
    {
      $id = $_POST['id'];
      $data = $this->mod->m_get_harga_keterangan_pembelian($id);
      echo json_encode($data);
    }

    public function update()
    {
      $kode_pembelian   = $this->input->post('kode_pembelian',TRUE);
      $harga_pembelian  = str_replace(".","",$this->input->post('harga_pembelian',TRUE));
      $keterangan       = $this->input->post('keterangan',TRUE);
      $post = [
        'kode_pembelian'  => $kode_pembelian,
        'harga_beli' => $harga_pembelian,
        'keterangan'      => $keterangan
      ];
      // print('<pre>');print_r($post);exit();
      $this->mod->m_update_laporan_pembelian($post);
      $cek = $this->mod->m_cek_kode_pembelian_penjualan($kode_pembelian);
      if($cek['kode_pembelian'] !=""){
        $this->mod->m_update_laporan_penjualan($post);
      }
      $_SESSION['msg'] = 'edit laporan pembelian berhasil';
      redirect(site_url('laporan_pembelian'));
    }

}

?>