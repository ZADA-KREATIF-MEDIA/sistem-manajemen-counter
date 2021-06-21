<?php
Class Model_pengeluaran extends CI_Model{

    public function show_laporan()
    {	
        $this->db->select('*');
        $data=$this->db->get('pengeluaran');
        return $data;
    }
    
    public function add()
    {
        $data=[
            'jenis_pengeluaran' => $this->input->post('jenis_pengeluaran',true),
            'nominal'           => str_replace(".","",$this->input->post('nominal',true)),
            'tanggal'           => date('Y-m-d', strtotime($this->input->post('tanggal',TRUE))),
            'keterangan'        => $this->input->post('keterangan',true)
        ];
        $this->db->insert('pengeluaran',$data);
    }

    public function edit($id)
    {
        $data=$this->db->get_where('pengeluaran',array('id_pengeluaran'=>$id));
        return $data;
    }

    public function update()
    {
        $data=[
            'jenis_pengeluaran' => $this->input->post('jenis_pengeluaran',true),
            'nominal'           => str_replace(".","",$this->input->post('nominal',true)),
            'tanggal'           => date('Y-m-d', strtotime($this->input->post('tanggal',TRUE))),
            'keterangan'        => $this->input->post('keterangan',true)
        ];
        $id_pengeluaran=$this->input->post('id_pengeluaran');
        $this->db->where('id_pengeluaran',$id_pengeluaran);
        $this->db->update('pengeluaran',$data);

    }

}
?>