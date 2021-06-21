<?php
Class Model_laporanPenjualan extends CI_Model{

    public function show_laporan()
    {	
      $this->db->select('*')
          ->join('user', 'user.id_user = penjualan.id_user','left');
      $data=$this->db->get('penjualan');
      return $data;
    }

    public function m_get_detail($imei)
    {
      $this->db->select()
          ->from('penjualan')
          ->join('user', 'user.id_user = penjualan.id_user','left')
          ->where('penjualan.imei',$imei);
      $query = $this->db->get_compiled_select();
      $data  = $this->db->query($query)->row_array();
      return $data;
    }

    public function m_get_user()
    {
      $query = $this->db->get('user');
      return $query; 
    }

    public function m_update_penjualan($data)
    {
      $this->db->select()
          ->from('penjualan')
          ->where("imei" , $data['imei']);
      $query = $this->db->set($data)->get_compiled_update();
      $this->db->query($query);
      return true;	
    }

    public function m_hapus_laporan_penjualan($id)
    {
      $this->db->select()
        ->from('penjualan')
        ->where("id_penjualan", $id);
      $query = $this->db->get_compiled_delete();
      $this->db->query($query);
      return true;
    }

  }