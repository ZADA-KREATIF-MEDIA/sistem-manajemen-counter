<?php 
class Pengeluaran extends CI_Controller{

	function __construct() {
        parent::__construct();
        $this->load->Model('Model_pengeluaran','mod');
    }

    public function index()
    {
        $data['pengeluaran']=$this->mod->show_laporan()->result();
        $this->template->load('template','pengeluaran/index',$data);
    }


    public function tambah()
    {
        if(isset($_POST['submit'])){
            $this->mod->add();
            $_SESSION['msg'] = 'tambah pengeluaran';
            redirect('pengeluaran');
        } else{
            $this->template->load('template','pengeluaran/add');
        }
    }

    public function edit()
    {
        if(isset($_POST['submit'])){
            $this->mod->update();
            $_SESSION['msg'] = 'edit pengeluaran';
            redirect('Pengeluaran');
        }else{
            $id             = $this->uri->segment(3);
            $data['pengeluaran'] = $this->mod->edit($id)->row_Array();
            $this->template->load('template','pengeluaran/edit',$data);
        }
    }

    public function hapus()
    {
        $id=$this->input->post('id',true);
        $this->db->where('id_pengeluaran',$id);
        $this->db->delete('pengeluaran');
    }
}
?>
