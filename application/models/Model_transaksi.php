<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Model_transaksi extends CI_Model
{
    public $table= "penjualan"; 

    public function m_show_barang()
    {
        $this->db->select()
                ->from('barang')
                ->where('status =','instock');    
        $query  = $this->db->get();
        return $query;
    }
    
    public function m_show_transaksi($id_user)
    {
        $this->db->select('penjualan_tmp.id_penjualan_tmp, penjualan_tmp.imei, penjualan_tmp.nama_customer, barang.nama_barang, penjualan_tmp.harga_jual,penjualan_tmp.kode_pembelian')
                ->from('penjualan_tmp')
                ->join('barang', 'barang.imei = penjualan_tmp.imei', 'left')
                ->join('user', 'user.id_user = penjualan_tmp.id_user','left')
                ->where('penjualan_tmp.id_user', $id_user);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_show_transaksi_all($id_user)
    {
        $this->db->select()
                ->from('penjualan_tmp')
                ->where('id_user', $id_user);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->result_array();
        return $data;
    }

    public function m_store($data)
    {
        $this->db->insert('penjualan_tmp', $data);
        return true;
    }

    public function m_update_status_to_tmp($update_tmp)
    {
        $this->db->select()
            ->from('barang')
            ->where("imei" , $update_tmp['imei']);
        $query = $this->db->set($update_tmp)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_show_stock_barang($kd_barang)
    {
        $this->db->select('stok')
            ->from('barang')
            ->where('kd_barang',$kd_barang);    
            $query = $this->db->get_compiled_select();
            $data	= $this->db->query($query)->row();
        return $data;
    }

    public function m_update_stock($update)
    {
        $this->db->select()
			->from('barang')
			->where("kd_barang" , $update['kd_barang']);
		$query = $this->db->set($update)->get_compiled_update();
		$this->db->query($query);
		return true;	
    }

    public function m_show_jumlah_pembelian($id)
    {
        $this->db->select('jumlah,kode_barang')
            ->from('penjualan')
            ->where('id_jual',$id);    
            $query = $this->db->get_compiled_select();
            $data	= $this->db->query($query)->row();
        return $data;
    }

    public function m_get_harga_barang($id_barang)
    {
        $this->db->select('harga_beli,nama_barang,kode_pembelian')
            ->from('barang')
            ->where('imei', $id_barang);
        $query  = $this->db->get_compiled_select();
        $data   = $this->db->query($query)->row();
        return $data;
    }

    public function m_update_harga_jual($data)
    {
        $this->db->select()
            ->from('penjualan_tmp')
            ->where("imei", $data['imei']);
        $query = $this->db->set($data)->get_compiled_update();
        $this->db->query($query);
        return true;
    }

    public function m_update_data_barang($data)
    {
        $this->db->update_batch('barang', $data, 'imei'); 
		return true;	
    }

    public function m_send_to_penjualan($penjualan)
    {
        $this->db->insert_batch('penjualan', $penjualan);
		return true;
    }

    public function m_destroy_tmp($penjualan)
    {   
        foreach($penjualan as $item){
            $this->db->where_in('imei', $item['imei']);    
            $this->db->delete('penjualan_tmp');
        }
        return true;
    }

    public function m_destroy_barang_terjual($data)
    {   
        foreach($data as $item){
            $this->db->where_in('imei', $item['imei']);    
            $this->db->delete('barang');
        }
        return true;
    }

    public function m_update_status_barang_to_instok($update_barang)
    {
        $this->db->select()
            ->from('barang')
            ->where("imei", $update_barang['imei']);
        $query = $this->db->set($update_barang)->get_compiled_update();
        $this->db->query($query);
        return true;
    }

    public function m_cek_data_tmp($imei)
    {
        $this->db->select('imei')
            ->from('penjualan_tmp')
            ->where('imei', $imei);
        $query  = $this->db->get_compiled_select();
        $data   = $this->db->query($query)->row();
        return $data;
    }

    public function m_store_piutang($piutang)
    {
        $this->db->insert('piutang',$piutang);
        return true;
    }

    public function m_delete_piutang($kode_pembelian)
    {
        $this->db->where_in('id_pembelian', $kode_pembelian);    
        $this->db->delete('piutang');
        return true;
    }

    public function m_get_piutang($kode_pembelian)
    {
        $this->db->select('nominal_terbayar')
            ->from('piutang')
            ->where('id_pembelian', $kode_pembelian);
        $query  = $this->db->get_compiled_select();
        $data   = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_update_total_hutang($update)
    {
        $this->db->select()
            ->from('piutang')
            ->where("id_pembelian", $update['id_pembelian']);
        $query = $this->db->set($update)->get_compiled_update();
        $this->db->query($query);
        return true;
    }

    public function m_update_status_piutang_belum($piutang)
    {
        $this->db->update_batch('piutang', $piutang, 'id_pembelian'); 
		return true;	
    }
}