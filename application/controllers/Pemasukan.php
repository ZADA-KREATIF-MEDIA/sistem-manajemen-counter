<?php 
class Pemasukan extends CI_Controller{

	function __construct() {
        parent::__construct();
        $this->load->Model('Model_pemasukan','mod');
    }

    public function index()
    {
        $data['pemasukan']=$this->mod->show_laporan()->result();
        $this->template->load('template','pemasukan/index',$data);
    }


    public function tambah()
    {
        if(isset($_POST['submit'])){
            $this->mod->add();
            $_SESSION['msg'] = "pemasukan success";
            redirect('pemasukan');
        } else{
            $this->template->load('template','pemasukan/add');
        }
    }

    public function edit()
    {
        if(isset($_POST['submit'])){
            $this->mod->update();
            $_SESSION['msg'] = "edit pemasukan success";
            redirect('pemasukan');
        }else{
            $id             = $this->uri->segment(3);
            $data['pemasukan'] = $this->mod->edit($id)->row_Array();
            $this->template->load('template','pemasukan/edit',$data);
        }
    }

    public function hapus()
    {
        $id =$this->input->post('id',true);
        $this->db->where('id_pemasukan',$id);
        $this->db->delete('pemasukan');
    }
}
?>
