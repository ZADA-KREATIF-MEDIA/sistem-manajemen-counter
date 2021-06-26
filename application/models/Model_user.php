<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Model_user extends CI_Model
{
    public function m_show()
    {
        $data=$this->db->get('user');
        return $data;
    }

    public function m_store($post)
    {
        $this->db->insert('user', $post);
        return true;
    }

    public function m_update($post)
    {
        $this->db->select()
			->from('user')
			->where("id_user" , $post['id_user']);
		$query = $this->db->set($post)->get_compiled_update();
		$this->db->query($query);
		return true;	
    }

    public function m_destroy($id_user)
    {
        $this->db->select()
			->from('user')
			->where("id_user", $id_user);
		$query = $this->db->get_compiled_delete();
		$this->db->query($query);
		return true;
    }

    public function m_get_customer()
    {
        $data=$this->db->get('customer');
        return $data;
    }

    public function m_store_customer($post)
    {
        $this->db->insert('customer', $post);
        return true;
    }

    public function m_update_customer($post)
    {
        $this->db->select()
            ->from('customer')
            ->where("id_customer" , $post['id_customer']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;
    }

    public function m_destroy_customer($id_customer)
    {
        $this->db->select()
            ->from('customer')
            ->where("id_customer", $id_customer);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }
}