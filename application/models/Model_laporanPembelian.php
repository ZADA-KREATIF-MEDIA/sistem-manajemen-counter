<?php
Class Model_laporanPembelian extends CI_Model{

    public function show_laporan()
    {	
      $this->db->select('*');
      $this->db->join('user', 'pembelian.id_user = user.id_user','left');
      $data=$this->db->get('pembelian');
      return $data;
    }

    public function show_detail($id_customer)
    {	
    
      $this->db->select()
        ->from('pembelian')
        ->join('customer', 'pembelian.kode_pembelian = customer.kode_pembelian','left')
        ->where('customer.kode_pembelian',$id_customer);
      $query = $this->db->get_compiled_select();
      $data	= $this->db->query($query)->row();
  
      return $data;
    }

    public function destroy($kode_pembelian)
    {	
      $this->db->delete('pembelian',array('kode_pembelian'=>$kode_pembelian));
      return true;
    }

    public function destroy_barang($kode_pembelian)
    {	
      $this->db->delete('barang',array('kode_pembelian'=>$kode_pembelian));
      return true;
    }

    public function m_get_harga_keterangan_pembelian($id)
    {
      $this->db->select()
          ->from('pembelian')
          ->where('kode_pembelian',$id);
      $query = $this->db->get_compiled_select();
      $data  = $this->db->query($query)->row_array();
      return $data;
    }

    public function m_update_laporan_pembelian($post)
    {
      $this->db->select()
        ->from('pembelian')
        ->where("kode_pembelian" , $post['kode_pembelian']);
      $query = $this->db->set($post)->get_compiled_update();
      $this->db->query($query);
      return true;	
    }

    public function m_update_laporan_penjualan($post)
    {
      $this->db->select()
        ->from('penjualan')
        ->where("kode_pembelian" , $post['kode_pembelian']);
      $query = $this->db->set($post)->get_compiled_update();
      $this->db->query($query);
      return true;	
    }

    public function m_cek_kode_pembelian_penjualan($kode_pembelian)
    {
      $this->db->select('kode_pembelian')
          ->from('penjualan')
          ->where('kode_pembelian',$kode_pembelian);
      $query = $this->db->get_compiled_select();
      $data  = $this->db->query($query)->row_array();
      return $data;
    }

  }
?>