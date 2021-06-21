<?php
Class Model_gaji extends CI_Model{

    public function show_laporan()
    {	
      $this->db->select('*');
      $this->db->join('user', 'gaji.id_user = user.id_user','left');
      $data=$this->db->get('gaji');
      return $data;
    }
    
    public function get_user()
    {	
      $this->db->select('*');
      $data=$this->db->get('user');
      return $data;
    }

    public function add()
    {
      $data=[
        'id_user'     => $this->input->post('id_user',true),
        'gaji_pokok'  => str_replace(".","",$this->input->post('gaji_pokok',true)),
        'bonus'       => str_replace(".","",$this->input->post('bonus',true)),
        'bon'         => str_replace(".","",$this->input->post('bon',true)),
        'keterangan'  => $this->input->post('keterangan',true)
      ];
      $this->db->insert('gaji',$data);
    }

    public function edit($id)
    {
      $this->db->join('user', 'gaji.id_user = user.id_user','left');
      $data=$this->db->get_where('gaji',array('id_gaji'=>$id));
      return $data;
    }

    public function update()
    {
      $data=[
        'gaji_pokok'  => str_replace(".","",$this->input->post('gaji_pokok',true)),
        'bonus'       => str_replace(".","",$this->input->post('bonus',true)),
        'bon'         => str_replace(".","",$this->input->post('bon',true)),
        'status'      => $this->input->post('status',true),
        'keterangan'  => $this->input->post('keterangan',true)
      ];
      $id_gaji=$this->input->post('id_gaji',true);
      $this->db->where('id_gaji',$id_gaji);
      $this->db->update('gaji',$data);
    }

}
?>