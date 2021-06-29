<?php
Class Barang extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->Model('Model_barang','mod');
    }

    public function index()
    {
      $data['barang']=$this->mod->show_barang()->result();
      $this->template->load('template','barang/index',$data);
    }

    public function tambah()
    {
        if(isset($_POST['submit'])){
          $this->mod->add();
          redirect('Barang');
        } else{
          $this->template->load('template','barang/add');
        }
    }

    public function edit()
    {
      if(isset($_POST['submit'])){
        $this->mod->update();
        redirect('Barang');
      }else{
        $id             = $this->uri->segment(3);
        $data['barang'] = $this->mod->edit($id)->row_Array();
        $this->template->load('template','barang/edit',$data);
      }
    }

    public function hapus()
    {
      $id=$this->input->post('id',true);
      $this->mod->m_hapus_barang($id);
      $cek = $this->mod->m_cek_tmp($id);
      if($cek){
        $this->mod->m_hapus_tmp($id);
      }
    }

    public function hapus_tmp()
    {
      $id = $this->input->post('id',true);
      $update = [
        'kode_pembelian' => $id,
        'status' => 'in_stock'
      ];
      $tmp = $this->mod->m_update_instock($update);
      $data = $this->mod->m_destroy_tmp_byid($id);
      echo json_encode($data);
    }
  
}

?>