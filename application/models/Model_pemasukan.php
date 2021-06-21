<?php
Class Model_pemasukan extends CI_Model{

    public function show_laporan()
    {	
        $this->db->select('*');
        $data=$this->db->get('pemasukan');
        return $data;
    }
    
    public function add()
    {
        $data=[
            'jenis_pemasukan'   => $this->input->post('jenis_pemasukan'),
            'nominal'           => str_replace(".","",$this->input->post('nominal')),
            'tanggal'           => date('Y-m-d', strtotime($this->input->post('tanggal',TRUE))),
            'keterangan'        => $this->input->post('keterangan')
        ];
        $this->db->insert('pemasukan',$data);
    }

    public function edit($id)
    {
        $data=$this->db->get_where('pemasukan',array('id_pemasukan'=>$id));
        return $data;
    }

    public function update()
    {
        $data=[
            'jenis_pemasukan'   => $this->input->post('jenis_pemasukan'),
            'nominal'           => str_replace(".","",$this->input->post('nominal')),
            'tanggal'           => date('Y-m-d', strtotime($this->input->post('tanggal',TRUE))),
            'keterangan'        => $this->input->post('keterangan')
        ];
        $id_pemasukan=$this->input->post('id_pemasukan');
        $this->db->where('id_pemasukan',$id_pemasukan);
        $this->db->update('pemasukan',$data);

    }

}
?>