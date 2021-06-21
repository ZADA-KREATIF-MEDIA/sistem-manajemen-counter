<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Model_service extends CI_Model{

    public function show_service()
    {
        $data=$this->db->get('service')->result_array();
        return $data;
        
    }

    public function biaya()
    {
        $this->db->select('service.id_service,service.nama_customer,service.alamat,service.no_telpn,service.tanggal_masuk,service.tanggal_jadi,service.status')
            ->from('service');
        $query = $this->db->get()->result_array();
        $i=0;
        foreach($query as $values){
            $this->db->select('sum(service_part.biaya) AS biaya_hardware')
                    ->from('service_part')
                    ->where('id_service=',$values['id_service']);
            $hasil['biaya_part'][$i] = $this->db->get_compiled_select();
            $data['biaya_part'][$i]	= $this->db->query($hasil['biaya_part'][$i])->row();
            $this->db->select('sum(service_software.biaya) AS biaya_software')
                    ->from('service_software')
                    ->where('id_service=',$values['id_service']);
            $hasil['biaya_software'][$i] = $this->db->get_compiled_select();
            $data['biaya_software'][$i]	= $this->db->query($hasil['biaya_software'][$i])->row();
            $i++;
        }
        return $data;
    }

    public function show_jenis()
    {
        $this->db->select()
            ->from('service_detail')
            ->join('service', 'service.id_service=service_detail.idservice_detail');
        $query  = $this->db->get();
        // $data=$this->db->get('service_detail');
        return $query;
    }

    public function m_store_part1($post)
    {
        $this->db->insert('service', $post);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function m_store_hardware($data_hw)
    {
        $this->db->insert_batch('service_part', $data_hw);
		return true;
    }

    public function m_store_software($data_sw)
    {
        $this->db->insert_batch('service_software', $data_sw);
		return true;
    }

    public function m_show($id_customer)
    {
        $this->db->select()
			->from('service')
			->where("id_service", $id_customer);
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row();
		return $data;
    }

    public function m_show_service_part($id_customer)
    {
        $this->db->select()
            ->from('service_part')
            ->where("id_service", $id_customer);
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->result_array();
        return $data;
    }

    public function m_show_service_software($id_customer)
    {
        $this->db->select()
            ->from('service_software')
            ->where("id_service", $id_customer);
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->result_array();
        return $data;
    }

    public function m_destroy($id_customer)
    {
        // $this->db->select()
		// 	->from('service')
		// 	->where("id_service", $id_service);
		// $query = $this->db->get_compiled_delete();
		// $this->db->query($query);
        // return true;
        $this->db->trans_start();
            $this->db->delete('service', array('id_service' => $id_customer));
            $this->db->delete('service_part', array('id_service' => $id_customer));
            $this->db->delete('service_software', array('id_service' => $id_customer));
        $this->db->trans_complete();
    }

    public function m_update_part1($post)
    {
        $this->db->select()
			->from('service')
			->where("id_service" , $post['id_service']);
		$query = $this->db->set($post)->get_compiled_update();
		$this->db->query($query);
		return true;	
    }

    public function m_update_part($data_hw)
    {
        $this->db->update_batch('service_part', $data_hw, 'id_part'); 
		return true;	
    }

    public function m_update_software($data_sw)
    {
        $this->db->update_batch('service_software', $data_sw, 'id_software'); 
		return true;	
    }

    public function m_store_hw($post)
    {
        
        $this->db->insert('service_part', $post);
        return true;
    }

    public function m_store_sw($post)
    {
        
        $this->db->insert('service_software', $post);
        return true;
    }

    public function m_destroy_service_part($id)
    {
        $this->db->select()
			->from('service_part')
			->where("id_part", $id);
		$query = $this->db->get_compiled_delete();
		$this->db->query($query);
		return true;
    }

    public function m_destroy_service_software($id)
    {
        $this->db->select()
			->from('service_software')
			->where("id_software", $id);
		$query = $this->db->get_compiled_delete();
		$this->db->query($query);
		return true;
    }

    public function m_update_status_pengerjaan($post)
    {
        $this->db->select()
			->from('service')
			->where("id_service" , $post['id_service']);
		$query = $this->db->set($post)->get_compiled_update();
		$this->db->query($query);
		return true;	
    }

    /*----------- PART -----------*/
    public function show_part()
    {
        $this->db->select('part.id,part.nama_part,part.penjual,part.harga,part.tanggal,user.nama')
            ->from('part')
            ->join('user', 'user.id_user = part.id_teknisi');
            $query = $this->db->get_compiled_select();
            $data  = $this->db->query($query)->result_array();
            return $data;
        
    }

    public function m_store_part($post)
    {
        $this->db->insert('part', $post);
        return true;
    }

    public function m_get_detail_part($id)
    {
        $this->db->select()
            ->from('part')
            ->where("id", $id);
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row_array();
        return $data;
    }

    public function m_update_parts($post)
    {
        $this->db->select()
            ->from('part')
            ->where("id" , $post['id']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;	
    }

    public function m_delete_part($id)
    {
        $this->db->select()
            ->from('part')
            ->where("id", $id);
        $query = $this->db->get_compiled_delete();
        $this->db->query($query);
        return true;
    }

    public function show_laporan_all()
    {
        $data=$this->db->get('service')->result_array();
        return $data;
    }

    public function show_laporan_by_teknisi()
    {
        $id_teknisi = $this->session->userdata('id_user');
        $this->db->select()
            ->from('service')
            ->where("id_teknisi", $id_teknisi);
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->result_array();
        return $data;
    }

}
