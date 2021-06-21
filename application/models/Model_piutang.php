<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Model_piutang extends CI_Model
{
    public function m_get_piutang()
    {
        $this->db->select()
            ->from('piutang')
            ->where('status !=','in_tmp');    
        $query  = $this->db->get()->result_array();
        return $query;
    }

    public function m_get_piutang_transaksi()
    {
        $this->db->select('piutang.nota_piutang,piutang_pembayaran.nominal,piutang_pembayaran.tanggal_bayar,piutang_pembayaran.keterangan')
            ->from('piutang_pembayaran')
            ->join('piutang','piutang.id=piutang_pembayaran.id_piutang');
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_get_piutang_bl()
    {
        $this->db->select()
            ->from('piutang')
            ->where('status =','belum');    
        $query  = $this->db->get()->result_array();
        return $query;
    }

    public function m_get_harga_piutang($id)
    {
        $this->db->select('nominal_piutang,nominal_terbayar')
            ->from('piutang')
            ->where('id',$id);    
            $query = $this->db->get_compiled_select();
            $data	= $this->db->query($query)->row();
        return $data;
    }

    public function m_save_piutang_transaksi($post)
    {
        $this->db->insert('piutang_pembayaran', $post);
        return true;
    }

    public function m_update_nominal_piutang($update)
    {
        $this->db->select()
            ->from('piutang')
            ->where("id" , $update['id']);
        $query = $this->db->set($update)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_update_status_piutang($update_status)
    {
        $this->db->select()
            ->from('piutang')
            ->where("id" , $update_status['id']);
        $query = $this->db->set($update_status)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_get_detail_penjualan($id)
    {
        $this->db->select()
            ->from('penjualan')
            ->where('kode_pembelian',$id);    
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row_array();
        return $data;
    }

    public function m_get_detail_piutang($id)
    {
        $this->db->select('id')
            ->from('piutang')
            ->where('id_pembelian',$id);    
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row_array();
        return $data;
    }

    public function m_reset_pembelian($post)
    {
        $this->db->select()
            ->from('piutang')
            ->where("id_pembelian" , $post['id_pembelian']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_destroy_piutang_pembayaran($id_pembelian)
    {
        $this->db->select()
            ->from('piutang_pembayaran')
            ->where("id_piutang", $id_pembelian);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }



}