<?php 
class Gaji extends CI_Controller{

	function __construct() {
      parent::__construct();
      $this->load->Model('Model_gaji');
   }

   public function index()
   {
      $data['gaji']=$this->Model_gaji->show_laporan()->result();
      $this->template->load('template','gaji/index',$data);
   }


   public function tambah()
   {
      if(isset($_POST['submit'])){
         
         $this->Model_gaji->add();
         $_SESSION['msg'] = 'tambah gaji';
         redirect('gaji');
      }else{
         $data['user']=$this->Model_gaji->get_user()->result();
         $this->template->load('template','gaji/add',$data);
      }
   }

   public function edit()
   {
      if(isset($_POST['submit'])){
         $this->Model_gaji->update();
         $_SESSION['msg'] = 'edit gaji';
         redirect('gaji');
      }else{
         $id             = $this->uri->segment(3);
         $data['gaji'] = $this->Model_gaji->edit($id)->row_Array();
         $this->template->load('template','gaji/edit',$data);
      }
   }

   public function hapus()
   {
      $id=$this->input->post('id',true);
      $this->db->where('id_gaji',$id);
      $this->db->delete('gaji');
   }
}
?>
