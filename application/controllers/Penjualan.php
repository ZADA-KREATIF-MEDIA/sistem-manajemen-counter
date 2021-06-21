<?php
Class Penjualan extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->Model('Model_barang');
        $this->load->helper('tgl_indo');
    }
    function index(){

        $this->template->load('template','jual/index');
    }
    function save_barang(){
    	$barang = $this->input->post('barang');
    	$jumlah = $this->input->post('jumlah');
    	$harga = $this->input->post('harga');
        $data['nama'] = $this->input->post('nama');
    	//$data['total'] = $this->input->post('total');
    	$data['no_tel'] = $this->input->post('no_tel');

    	$id = $this->Model_barang->save_cus($data);

    	if (!empty($id)) {
    		$index = 0;
	    	$data = array();
	    	foreach ($barang as $item) {
	    		$data[] = array(
	    			'nama_barang' => $item,
	    			'qty' => $jumlah[$index],
	    			'price' => $harga[$index],
	    			'user_id' => $id);
                $index++;
	    	}
	    	$this->Model_barang->savebarang($data);
            redirect('Penjualan/print/'.$id);
    	}
    }
    function print($id){
        $where = array('id_customer' => $id);

        $data['bio'] = $this->Model_barang->get_cus('customer',$where)->row();
        // print_r($data['bio']->tanggal);
        // exit();
        //$data['bio'] = $cuss->row();

        $data['item'] = $this->Model_barang->get_cus('purchase',['user_id'=>$id])->result();

        
        $this->load->view('jual/print',$data);
    }

}
 ?>