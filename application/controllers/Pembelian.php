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
            'kode_pembelian'=> $id,
            'imei'          => $imei,
            'nama_barang'   => $this->input->post('nama_barang',TRUE),
            'harga_beli'    => $harga,
            'nama_customer' => $this->input->post('nama',TRUE),
            'metode_bayar'  => $this->input->post('pembayaran',TRUE),
            'id_user'       => $this->session->userdata('id_user',TRUE),
            'uang_muka'     => $uang_muka
        ] ;
        $this->mod->save_pembelian($data_pembelian);
        $nama = $this->input->post('nama',true);
        $hari_ini = date("Y-m-d");
        if($uang_muka !=""){
            $nota           = str_replace(" ","",$nama)."/".$imei."/".$hari_ini;
            $nominal_utang  = $harga - $uang_muka; 
            $tanggal        = date("Y-m-d H:i:s");
            $tanggal_tempo  = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_jatuh_tempo', TRUE)." ".date("H:i:s")));
            $hutang = [
                'nota_hutang' => $nota,
                'nominal_hutang' => $nominal_utang,
                'nominal_terbayar' => $uang_muka,
                'tanggal_hutang' => $tanggal,
                'tanggal_jatuh_tempo' => $tanggal_tempo,
                'id_pembelian' => $id
            ];
            $this->mod->m_store_hutang($hutang);
        }
        //SIMPAN NAMA CUSTOMER//
        $data = [
            'nama'              => $nama,
            'no_telpn'          => $this->input->post('no_telpn',true),
            'alamat'            => $this->input->post('alamat',true),
            'kode_pembelian'    => $id
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