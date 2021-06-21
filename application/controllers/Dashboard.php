<?php
class Dashboard extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->Model('Model_barang');
    }
	
	
     public function index()
     {
		$id_user=$this->session->userdata('id_user');
		
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.imei = penjualan.imei');
        $this->db->where('id_user',$id_user);
        $this->db->where('DATE(tanggal)','CURDATE()',FALSE);
        $data['grafik']=$this->db->get()->result();
        $this->template->load('template','dashboard',$data);
     }
}

?>