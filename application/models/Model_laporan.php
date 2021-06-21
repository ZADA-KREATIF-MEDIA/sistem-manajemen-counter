<?php
Class Model_laporan extends CI_Model{

    public function show_laporan()
    {	
		$this->db->select('*');
		$this->db->group_by("user_id"); 
        $data=$this->db->get('purchase');
		
        return $data;
    }

  }
 ?>