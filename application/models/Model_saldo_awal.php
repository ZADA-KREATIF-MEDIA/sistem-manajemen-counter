<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Model_saldo_awal extends CI_Model{

    public function m_get_all()
    {
        $data=$this->db->get('saldo_awal')->result_array();
        return $data;
    }
    
    public function m_store($post)
    {
        $this->db->insert('saldo_awal', $post);
        return true;
    }

    public function m_get_detail($id)
    {
        $this->db->select()
			->from('saldo_awal')
			->where("id", $id);
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row_array();
		return $data;
    }

    public function m_update($post)
    {
        $this->db->select()
            ->from('saldo_awal')
            ->where("id" , $post['id']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_destroy($id)
    {
        $this->db->select()
            ->from('saldo_awal')
            ->where("id", $id);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }
}