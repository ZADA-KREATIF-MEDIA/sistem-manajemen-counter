<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Model_hutang extends CI_Model
{
    public function m_get_hutang()
    {
        $data=$this->db->get('hutang')->result_array();
        return $data;
    }

    public function m_get_hutang_transaksi()
    {
        $this->db->select('hutang.nota_hutang,hutang_pembayaran.nominal,hutang_pembayaran.tanggal_bayar,hutang_pembayaran.keterangan')
            ->from('hutang_pembayaran')
            ->join('hutang','hutang.id=hutang_pembayaran.id_hutang');
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_get_hutang_bl()
    {
        $this->db->select()
            ->from('hutang')
            ->where('status =','belum');    
        $query  = $this->db->get()->result_array();
        return $query;
    }

    public function m_get_harga_hutang($id)
    {
        $this->db->select('nominal_hutang,nominal_terbayar')
            ->from('hutang')
            ->where('id',$id);    
            $query = $this->db->get_compiled_select();
            $data	= $this->db->query($query)->row();
        return $data;
    }

    public function m_save_hutang_transaksi($post)
    {
        $this->db->insert('hutang_pembayaran', $post);
        return true;
    }

    public function m_update_nominal_hutang($update)
    {
        $this->db->select()
            ->from('hutang')
            ->where("id" , $update['id']);
        $query = $this->db->set($update)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_update_status_hutang($update_status)
    {
        $this->db->select()
            ->from('hutang')
            ->where("id" , $update_status['id']);
        $query = $this->db->set($update_status)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_get_detail_pembelian($id)
    {
        $this->db->select()
            ->from('pembelian')
            ->where('kode_pembelian',$id);    
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row_array();
        return $data;
    }

    public function m_get_detail_hutang($id)
    {
        $this->db->select('id')
            ->from('hutang')
            ->where('id_pembelian',$id);    
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row_array();
        return $data;
    }

    public function m_reset_pembelian($post)
    {
        $this->db->select()
            ->from('hutang')
            ->where("id_pembelian" , $post['id_pembelian']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_destroy_hutang_pembayaran($id_pembelian)
    {
        $this->db->select()
            ->from('hutang_pembayaran')
            ->where("id_hutang", $id_pembelian);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }

}