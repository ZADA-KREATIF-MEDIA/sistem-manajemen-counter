<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Service extends CI_Controller
{

	function __construct() {
        parent::__construct();
        $this->load->model('Model_service','mod');
    }

    public function index()
    {
        $data['service']    = $this->mod->show_service();
        $data['biaya']      = $this->mod->biaya();
        $data['part']       = $this->mod->show_part();
        $this->template->load('template','service/index',$data);
    }

    public function create()
    {
        $this->template->load('template', 'service/add');
    }

    public function store()
    {
        $date_in_sql = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_masuk', TRUE)." ".date("H:i:s")));
        $date_out_sql = date('Y-m-d', strtotime($this->input->post('tanggal_jadi', TRUE)));
        $post = [
            "nama_customer"     => $this->input->post('nama_customer', TRUE),
            "alamat"            => $this->input->post('alamat', TRUE),
            "no_telpn"          => $this->input->post('no_tlpn', TRUE),
            "nama_barang"       => $this->input->post('nama_barang', TRUE),
            "tipe"              => $this->input->post('tipe', TRUE),
            "imei"              => $this->input->post('imei', TRUE),
            "kelengkapan"       => $this->input->post('kelengkapan', TRUE),
            "keluhan"           => $this->input->post('keluhan', TRUE),
            "keterangan"        => $this->input->post('keterangan', TRUE),
            "id_teknisi"        => $this->input->post('id_teknisi', TRUE),
            "tanggal_masuk"     => $date_in_sql,
            "tanggal_jadi"      => $date_out_sql
        ];
        $post_customer = [
            'nama'          => $this->input->post('nama_customer',true),
            'alamat'        => $this->input->post('alamat', true),
            'no_telpn'      => $this->input->post('no_tlpn', true),
            'tgl_daftar'    => date('Y-m-d'),
            'imei'          => $this->input->post('imei', true)      
        ];
        $this->mod->m_store_customer($post_customer);
        $last_id = $this->mod->m_store_part1($post);
        $part_hw    = $this->input->post('part_hw', TRUE);
        $new_hw     = str_replace(".","", $this->input->post('harga_part_hw', TRUE));
        $part_sw    = $this->input->post('part_sw', TRUE);
        $new_sw     = str_replace(".","", $this->input->post('harga_part_sw', TRUE));
        if($part_hw != ""){
            for ($i = 0; $i < count($this->input->post('part_hw', TRUE)); $i++) {
                $data_hw[$i] = array(
                    "id_service" 	=> $last_id,
                    "nama_part" 	=> $part_hw[$i],
                    "biaya"         => $new_hw[$i]
                );
            }
            $this->mod->m_store_hardware($data_hw);
        }
        if($part_sw != ""){
            for ($i = 0; $i < count($this->input->post('part_sw', TRUE)); $i++) {
                $data_sw[$i] = array(
                    "id_service" 	    => $last_id,
                    "nama_software"     => $part_sw[$i],
                    "biaya"             => $new_sw[$i]
                );
            }
            $this->mod->m_store_software($data_sw);
        }

		redirect(site_url('service'));
    }

    public function show()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->m_show($id_customer);
        $data['service'] = $this->mod->m_show_service($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'service/detail', $data);
    }

    public function edit()
    {
        $id_customer        = $this->uri->segment(3);
        $data['detail']     = $this->mod->m_show($id_customer);
        $data['part']       = $this->mod->m_show_service_part($id_customer);
        $data['software']   = $this->mod->m_show_service_software($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'service/edit', $data);
    }

    public function update()
    {
        // $new_bs = str_replace(".","", $this->input->post('biaya_software', TRUE));
        // $new_bh = str_replace(".","", $this->input->post('biaya_hardware', TRUE));
        $date_in_sql    = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_masuk', TRUE)));
        $date_out_sql   = date('Y-m-d', strtotime($this->input->post('tanggal_jadi', TRUE)));
        $date_take_sql  = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_diambil', TRUE)." ".date("H:i:s")));
        $id_service     = $this->input->post('id_service', TRUE);
        $post = [
            "id_service"        => $this->input->post('id_service', TRUE),
            "nama_customer"     => $this->input->post('nama_customer', TRUE),
            "alamat"            => $this->input->post('alamat', TRUE),
            "no_telpn"          => $this->input->post('no_tlpn', TRUE),
            "nama_barang"       => $this->input->post('nama_barang', TRUE),
            "tipe"              => $this->input->post('tipe', TRUE),
            "imei"              => $this->input->post('imei', TRUE),
            "kelengkapan"       => $this->input->post('kelengkapan', TRUE),
            "keluhan"           => $this->input->post('keluhan', TRUE),
            "keterangan"        => $this->input->post('keterangan', TRUE),
            "id_teknisi"        => $this->input->post('id_teknisi', TRUE),
            "status"            => $this->input->post('status', TRUE),
            "tanggal_masuk"     => $date_in_sql,
            "tanggal_jadi"      => $date_out_sql,
            "tanggal_diambil"   => $date_take_sql
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_update_part1($post);

    
        $id_part        = $this->input->post('id_part', TRUE);
        $nama_part      = $this->input->post('part_hw', TRUE);
        $harga_part_hw  = str_replace(".","", $this->input->post('harga_part_hw', TRUE));
        for ($i = 0; $i < count($id_part); $i++) {
            $data_hw[$i] = array(
                "id_part"       => $id_part[$i],
                "id_service" 	=> $id_service,
                "biaya" 	    => $harga_part_hw[$i],
                "nama_part"     => $nama_part[$i],
            );
        }
        $this->mod->m_update_part($data_hw);
        $id_software    = $this->input->post('id_software', TRUE);
        $nama_software  = $this->input->post('part_sw', TRUE);
        $harga_part_sw  = str_replace(".","", $this->input->post('harga_part_sw', TRUE));
        for ($i = 0; $i < count($id_part); $i++) {
            $data_sw[$i] = array(
                "id_software"       => $id_software[$i],
                "id_service" 	    => $id_service,
                "biaya" 	        => $harga_part_sw[$i],
                "nama_software"     => $nama_software[$i],
            );
        }
        // print('<pre>');print_r($data_sw);exit();
        $this->mod->m_update_software($data_sw);
        redirect(site_url('service'));
    }

    public function delete()
    {
        $id_customer = $this->input->post('id_customer', TRUE);
        $data = $this->mod->m_destroy($id_customer);
        echo json_encode($data);
    }

    public function print()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->m_show($id_customer);
        $data['service'] = $this->mod->m_show_service($id_customer);
        $this->load->view('service/print', $data);
    }

    public function destroy_service_part()
    {
        $id = $this->input->post('id_service', TRUE);
        $data = $this->mod->m_destroy_service_part($id);
        echo json_encode($data);
    }

    public function destroy_service_software()
    {
        $id = $this->input->post('id_service', TRUE);
        $data = $this->mod->m_destroy_service_software($id);
        echo json_encode($data);
    }

    public function store_hw()
    {
        $id_service = $this->input->post('id_service', TRUE);
        $part_hw = $this->input->post('part_hw', TRUE);
        $biaya = str_replace(".","", $this->input->post('harga_part_hw', TRUE));
        $post = [
            'id_service'    => $id_service,
            'nama_part'     => $part_hw,
            'biaya'         => $biaya
        ];
        $this->mod->m_store_hw($post);
        redirect(site_url('service/edit/'.$id_service));
    }

    public function store_sw()
    {
        $id_service = $this->input->post('id_service', TRUE);
        $part_sw = $this->input->post('part_sw', TRUE);
        $biaya = str_replace(".","", $this->input->post('harga_part_sw', TRUE));
        $post = [
            'id_service'        => $id_service,
            'nama_software'     => $part_sw,
            'biaya'             => $biaya
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_store_sw($post);
        redirect(site_url('service/edit/'.$id_service));
    }

    public function ubah_status_pengerjaan()
    {
        $id = $this->input->post('id_customer',TRUE);
        $post =[
            'id_service'    => $id,
            'status'        => "dikerjakan"
        ];
        $data = $this->mod->m_update_status_pengerjaan($post);
        echo json_encode($data);
    }

    /*---------- PART ----------*/
    public function add_part()
    {
        $this->template->load('template', 'service/add_part');
    }

    public function store_part()
    {
        $post = [
            'nama_part'     => $this->input->post('nama_part',true),
            'penjual'       => $this->input->post('penjual',true),
            'harga'         => str_replace(".","",$this->input->post('harga',true)),
            'tanggal'       => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal',true)." ".date("H:i:s"))),
            'keterangan'    => $this->input->post('keterangan', true),
            'id_teknisi'    => $this->input->post('id_teknisi', true)
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_store_part($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Simpan Part Berhasil
        </div>');
        redirect('service');
    }

    public function edit_part()
    {
        $id = $this->uri->segment(3);
        $data['detail_part'] = $this->mod->m_get_detail_part($id);
        $this->template->load('template', 'service/edit_part',$data);
    }

    public function update_part()
    {
        $post = [
            'id'       => $this->input->post('id_part',true),
            'nama_part'     => $this->input->post('nama_part',true),
            'penjual'       => $this->input->post('penjual',true),
            'harga'         => str_replace(".","",$this->input->post('harga',true)),
            'tanggal'       => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal',true)." ".date("H:i:s"))),
            'keterangan'    => $this->input->post('keterangan', true)
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_update_parts($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Update Part Berhasil
        </div>');
        redirect('service');
    }

    public function delete_part()
    {
        $id = $this->uri->segment(3);
        $this->mod->m_delete_part($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Part Berhasil
        </div>');
        redirect('service');
    }

}
