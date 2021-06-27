<?php
Class Pembelian extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->Model('Model_barang','mod');
        $this->load->helper('tgl_indo');
    }
    function index(){

    	$this->template->load('template','pembelian/index');
    }

    function save_barang(){
        
        $harga = str_replace(".","",$this->input->post('harga',TRUE));
        $uang_muka = str_replace(".","",$this->input->post('uang_muka',TRUE));
        $imei = $this->input->post('imei',TRUE);
        $data_barang    = [
            'imei'          => $imei,
            'nama_barang'   => $this->input->post('nama_barang',TRUE),
            'harga_beli'    => $harga,
            'keterangan'    => $this->input->post('keterangan',TRUE)
        ];
        $id = $this->mod->save_tbl_barang($data_barang);

        $data_pembelian = [
            
            'imei'          => $imei,
            'nama_barang'   => $this->input->post('nama_barang',TRUE),
            'harga_beli'    => $harga,
            'tanggal'       => date('Y-m-d'),
            'metode_bayar'  => $this->input->post('pembayaran',TRUE),
            'id_user'       => $this->session->userdata('id_user',TRUE),
        ] ;
        $this->mod->save_pembelian($data_pembelian);
        $nama = $this->input->post('nama',true);
        //SIMPAN NAMA CUSTOMER//
        $data = [
            'nama'              => $nama,
            'no_telpn'          => $this->input->post('no_telpn',true),
            'alamat'            => $this->input->post('alamat',true),
            'tgl_daftar'        => date('Y-m-d'),
            'imei'              => $imei,
        ];
        $this->mod->save_cus($data);
        $_SESSION['msg'] = "pembelian sukses";
		redirect('pembelian');
    }
    function print($id){
        $where = array('id_customer' => $id);

        $data['bio'] = $this->mod->get_cus('customer',$where)->row();
        // print_r($data['bio']->tanggal);
        // exit();
        //$data['bio'] = $cuss->row();

        $data['item'] = $this->mod->get_cus('purchase',['user_id'=>$id])->result();

        
        $this->load->view('pembelian/print',$data);
    }

}
 ?>