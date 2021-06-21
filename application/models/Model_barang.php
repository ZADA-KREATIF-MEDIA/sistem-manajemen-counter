<?php
Class Model_Barang extends CI_Model
{

    public function show_barang()
    {
        $data=$this->db->get('barang');
        return $data;
    }

    public function add()
    {
        $data=[
            'nama_barang' => $this->input->post('nama_barang'),
            'stok'        => $this->input->post('stok'),
            'harga_beli'  => $this->input->post('harga_beli'),
            'harga_jual'  => $this->input->post('harga_jual'),
            'diskon'      => $this->input->post('diskon'),
            'keterangan'  => $this->input->post('keterangan')
        ];
        $this->db->insert('barang',$data);
    }

    public function edit($id)
    {
        $data=$this->db->get_where('barang',array('imei'=>$id));
        return $data;
    }

    public function update()
    {
        $data=[
            'nama_barang' => $this->input->post('nama_barang'),
            'harga_beli'  => str_replace(".","",$this->input->post('harga_beli')),
            'keterangan'  => $this->input->post('keterangan')
        ];
        $imei=$this->input->post('imei');
        $this->db->where('imei',$imei);
        $this->db->update('barang',$data);

    }

    public function save_pembelian($data_pembelian)
	{
        $this->db->insert('pembelian',$data_pembelian);
        return true;
    }

	public function save_tbl_barang($data_barang)
	{
        $this->db->insert('barang',$data_barang);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function save_cus($data)
    {
        $this->db->insert('customer',$data);
        return $this->db->insert_id('id_customer');
    }

    public function get_cus($table,$where)
    {
        $this->db->where($where);
        return  $this->db->get($table);
    }

    public function m_update_instock($update)
    {
        $this->db->select()
            ->from('barang')
            ->where("kode_pembelian" , $update['kode_pembelian']);
        $query = $this->db->set($update)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_destroy_tmp_byid($id)
    {
        $this->db->delete('penjualan_tmp',array('kode_pembelian'=>$id));
        return true;
    }

    public function m_hapus_barang($id)
    {
        $this->db->delete('barang',array('kode_pembelian'=>$id));
        return true;
    }

    public function m_cek_tmp($id)
    {
        $this->db->select('kode_pembelian')
            ->from('penjualan_tmp')
            ->where('kode_pembelian',$id);
        $query = $this->db->get_compiled_select();
        $data  = $this->db->query($query)->row_array();
        return $data;
    }

    public function m_hapus_tmp($id)
    {
        $this->db->delete('penjualan_tmp',array('kode_pembelian'=>$id));
        return true;
    }

    public function m_store_hutang($hutang)
    {
        $this->db->insert('hutang',$hutang);
        return true;
    }

}
?>