<?php
Class Transaksi extends CI_Controller{

    function __construct() 
    {
        parent::__construct();
        $this->load->Model('Model_transaksi','mod');
    }

    public function index()
    {
        // $this->db->select('*');
        // $this->db->from('penjualan');
        // $this->db->join('barang', 'barang.kd_barang = penjualan.kode_barang');
        // $this->db->where('status',0);
        // $data['penjualan']  =$this->db->get()->result();
        $id_user = $this->session->userdata('id_user');
        $data['barang']     = $this->mod->m_show_barang()->result();
        $data['transaksi']  = $this->mod->m_show_transaksi($id_user);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template','penjualan/index',$data);

    }
    
    public function add()
    {   
        $imei       = $this->input->post('imei',TRUE);
        $nama       = $this->input->post('nama_pembeli',true);
        $harga      = str_replace(".","",$this->input->post('harga_beli',true));
        $data=[
            'nama_customer' => $nama,
            'imei'          => $imei,
            'nama_barang'   => $this->input->post('nama_barang',true),
            'keterangan'    => $this->input->post('keterangan',true),
            'metode_bayar'  => $this->input->post('pembayaran',true),
            'id_user'       => $this->input->post('id_user',true),
            'harga_beli'    => $harga,
            'harga_jual'    => str_replace(".","",$this->input->post('harga_barang',true)),
            'tanggal'       => date('Y-m-d H:i:s'),
            'no_telpn'      => $this->input->post('no_telpn',true),
            'alamat'        => $this->input->post('alamat',true)
        ];
        $update_tmp = [
            'imei'     => $imei,
            'status'   => 'tmp'
        ];
        // print('<pre>');print_r($data);exit();
        $this->mod->m_update_status_to_tmp($update_tmp);
        $this->mod->m_store($data);
        $_SESSION['msg'] = "berhasil simpan temp";
        redirect('Transaksi');
}

    public function cancel()
    {
        $id=$this->uri->segment(3);
        $this->db->where('imei',$id);
        $this->db->delete('penjualan_tmp');
        $update_barang = [
            'imei' => $id,
            'status' => "instock"
        ];
        $this->mod->m_update_status_barang_to_instok($update_barang);
        redirect('Transaksi');
    }

    public function selesai()
    {
        $id_user = $this->uri->segment(3);
        $data_temp = $this->mod->m_show_transaksi_all($id_user);
        if(count($data_temp) < 1){
            $_SESSION['msg'] = "belum_memilih_barang";
            redirect('Transaksi');
        }
        if($data_temp !=""){
            foreach($data_temp as $values){
                $data[] = [
                    'imei'          =>  $values['imei'],
                    'harga_jual'    =>  $values['harga_jual'],
                    'status'        =>  'terjual'
                ];
            }
            $this->mod->m_destroy_barang_terjual($data);
            foreach($data_temp as $item){
                $penjualan[] = [
                    'imei'          => $item['imei'],
                    'nama_barang'   => $item['nama_barang'],
                    'harga_beli'    => $item['harga_beli'],
                    'harga_jual'    => $item['harga_jual'],
                    'keterangan'    => $item['keterangan'],
                    'nama_customer' => $item['nama_customer'],
                    'id_user'       => $item['id_user'],
                    'metode_bayar'  => $item['metode_bayar'],
                    'tanggal'       => $item['tanggal'],
                ];
                $customer[] = [
                    'imei'          => $item['imei'],
                    'nama' => $item['nama_customer'],
                    'no_telpn'      => $item['no_telpn'],
                    'alamat'        => $item['alamat'],
                    'tgl_daftar'    => date('Y-m-d')
                ];
            }
            $this->mod->m_save_customer($customer);
            $this->mod->m_send_to_penjualan($penjualan);
            $this->mod->m_destroy_tmp($penjualan);
            $_SESSION['msg'] = "transaksi success";
            redirect('Transaksi');
        }else{
            $_SESSION['msg'] = "tmp_kosong";
            redirect('Transaksi');
        }
    }

    public function get_harga_jual()
    {
        $id_barang = $_POST['id_barang'];
        $cek = $this->mod->m_get_harga_barang($id_barang);
        echo json_encode($cek);
    }

    public function update_harga_jual()
    {
        $harga = str_replace(".","",$this->input->post('harga_jual_baru', TRUE));
        $data = [
            'imei' => $this->input->post('imei', TRUE),
            'harga_jual' => $harga
        ];
        $this->mod->m_update_harga_jual($data);
        redirect('Transaksi');
    }

    
}
?>