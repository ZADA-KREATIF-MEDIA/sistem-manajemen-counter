<?php
Class Transaksi extends CI_Controller{

    function __construct() 
    {
        parent::__construct();
        $this->load->Model('Model_transaksi','mod');
    }

    public function index()
    {
        // $this->db->select('*');
        // $this->db->from('penjualan');
        // $this->db->join('barang', 'barang.kd_barang = penjualan.kode_barang');
        // $this->db->where('status',0);
        // $data['penjualan']  =$this->db->get()->result();
        $id_user = $this->session->userdata('id_user');
        $data['barang']     = $this->mod->m_show_barang()->result();
        $data['transaksi']  = $this->mod->m_show_transaksi($id_user);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template','penjualan/index',$data);

    }
    
    public function add()
    {   
        $kd_barang  = $this->input->post('kode_barang',true);
        $imei       = $this->input->post('imei',TRUE);
        $uang_muka  = str_replace(".","",$this->input->post('uang_muka',TRUE));
        $nama       = $this->input->post('nama_pembeli',true);
        $hari_ini   = date("Y-m-d");
        $harga      = str_replace(".","",$this->input->post('harga_beli',true));
        $id         = $this->input->post('kode_pembelian',true);
        $nota       = str_replace(" ","",$nama)."/".$imei."/".$hari_ini;
        $tanggal_tempo  = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_jatuh_tempo', TRUE)." ".date("H:i:s")));
        $data=[
            'nama_customer' => $nama,
            'imei'          => $imei,
            'nama_barang'   => $this->input->post('nama_barang',true),
            'keterangan'    => $this->input->post('keterangan',true),
            'metode_bayar'  => $this->input->post('pembayaran',true),
            'id_user'       => $this->input->post('id_user',true),
            'harga_beli'    => $harga,
            'harga_jual'    => $this->input->post('harga_barang',true),
            'tanggal'       => date('Y-m-d H:i:s'),
            'kode_pembelian'=> $id,
            'uang_muka'     => $uang_muka
        ];
        $update_tmp = [
            'imei'     => $imei,
            'status'   => 'tmp'
        ];
        $this->mod->m_update_status_to_tmp($update_tmp);
        $this->mod->m_store($data);
        if($uang_muka !=""){
            $nota           = str_replace(" ","",$nama)."/".$imei."/".$hari_ini;
            $nominal_utang  = $harga - $uang_muka; 
            $tanggal        = date("Y-m-d H:i:s");
            $tanggal_tempo  = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_jatuh_tempo', TRUE)." ".date("H:i:s")));
            $piutang = [
                'nota_piutang' => $nota,
                'nominal_piutang' => $nominal_utang,
                'nominal_terbayar' => $uang_muka,
                'tanggal_piutang' => $tanggal,
                'tanggal_jatuh_tempo' => $tanggal_tempo,
                'id_pembelian' => $id,
                'status' => 'in_tmp'
            ];
            $this->mod->m_store_piutang($piutang);
        }
        $_SESSION['msg'] = "berhasil simpan temp";
        redirect('Transaksi');
}

    public function cancel()
    {
        $id=$this->uri->segment(3);
        $kode_pembelian = $this->uri->segment(4);
        // print('<pre>');print_r($kode_pembelian);exit();
        $this->db->where('imei',$id);
        $this->db->delete('penjualan_tmp');
        $update_barang = [
            'imei' => $id,
            'status' => "in_stock"
        ];
        $this->mod->m_update_status_barang_to_instok($update_barang);
        $this->mod->m_delete_piutang($kode_pembelian);
        redirect('Transaksi');
    }

    public function selesai()
    {
        $id_user = $this->uri->segment(3);
        $data_temp = $this->mod->m_show_transaksi_all($id_user);
        if($data_temp !=""){
            foreach($data_temp as $values){
                $data[] = [
                    'imei'          =>  $values['imei'],
                    'harga_jual'    =>  $values['harga_jual'],
                    'status'        =>  'terjual'
                ];
            }
            $this->mod->m_destroy_barang_terjual($data);
            foreach($data_temp as $item){
                $penjualan[] = [
                    'imei'          => $item['imei'],
                    'nama_barang'   => $item['nama_barang'],
                    'harga_beli'    => $item['harga_beli'],
                    'harga_jual'    => $item['harga_jual'],
                    'keterangan'    => $item['keterangan'],
                    'nama_customer' => $item['nama_customer'],
                    'id_user'       => $item['id_user'],
                    'metode_bayar'  => $item['metode_bayar'],
                    'tanggal'       => $item['tanggal'],
                    'kode_pembelian'=> $item['kode_pembelian'],
                    'uang_muka'     => $item['uang_muka']
                ];
                $piutang[] = [
                    'id_pembelian'  => $item['kode_pembelian'],
                    'status'        => 'belum'
                ];
            }
            // print('<pre>');print_r($penjualan);exit();
            $this->mod->m_update_status_piutang_belum($piutang);
            $this->mod->m_send_to_penjualan($penjualan);
            $this->mod->m_destroy_tmp($penjualan);
            $_SESSION['msg'] = "transaksi success";
            redirect('Transaksi');
        }else{
            $_SESSION['msg'] = "tmp_kosong";
            redirect('Transaksi');
        }
    }

    public function get_harga_jual()
    {
        $id_barang = $_POST['id_barang'];
        $cek = $this->mod->m_get_harga_barang($id_barang);
        echo json_encode($cek);
    }

    public function update_harga_jual()
    {
        $harga = str_replace(".","",$this->input->post('harga_jual_baru', TRUE));
        $kode_pembelian = $this->input->post('kode_pembelian',TRUE);
        $data = [
            'imei' => $this->input->post('imei', TRUE),
            'harga_jual' => $harga
        ];
        $get_piutang = $this->mod->m_get_piutang($kode_pembelian);
        $total_hutang = $harga -  $get_piutang['nominal_terbayar'];
        // print('<pre>');print_r($total_hutang);exit();
        $update = [
            'id_pembelian' => $kode_pembelian,
            'nominal_piutang' => $total_hutang
        ];
        $this->mod->m_update_total_hutang($update);
        $this->mod->m_update_harga_jual($data);
        redirect('Transaksi');
    }

    /*public function laporan()
    {
        $pdf = new FPDF();
        $pdf = new FPDF("L","cm","A4");
        $pdf->SetMargins(2,1,1);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',11);
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'KIOS andihoerudin',0,'L');
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'Telpon : 0038XXXXXXX',0,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,'JL. KIOS andihoerudin',0,'L');
        $pdf->SetX(4);
        $pdf->MultiCell(19.5,0.5,' email : andihoerudin24@gmail.com',0,'L');
        $pdf->Line(1,3.1,28.5,3.1);
        $pdf->SetLineWidth(0.1);
        $pdf->Line(1,3.2,28.5,3.2);
        $pdf->SetLineWidth(0);
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(25.5,0.7,"Laporan Data Barang",0,10,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(1, 0.8,   'NO', 1, 0, 'C');
        $pdf->Cell(7, 0.8,   'Nama Barang', 1, 0, 'C');
        $pdf->Cell(3, 0.8,   'Nama Pelanggan', 1, 0, 'C');
        $pdf->Cell(4, 0.8,   'Jumlah', 1, 0, 'C');
        $pdf->Cell(3.5, 0.8, 'Harga Jual', 1, 0, 'C');
        $pdf->Cell(4.5, 0.8, 'Diskon', 1, 0, 'C');
        $pdf->Cell(4.5, 0.8, 'subtotal', 1, 1, 'C');
        $pdf->SetFont('Arial','',10);
    $no=1;
    $this->db->select('*');
    $this->db->from('penjualan');
    $this->db->join('barang', 'barang.kd_barang = penjualan.kode_barang');
    $this->db->join('pelanggan', 'pelanggan.kode_pelanggan = penjualan.kode_pelanggan');
    $this->db->where('status',1);
    $data=$this->db->get()->result();
    foreach($data as $row){
     $harga=str_replace('.','',$row->harga_jual);
     $diskon=str_replace('%','',$row->diskon);
     $count=$harga*$diskon/100;
     $subtotal=$harga-$count;

	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8, $row->nama_barang,1, 0, 'C');
	$pdf->Cell(3, 0.8, $row->nama_pelanggan, 1, 0,'C');
	$pdf->Cell(4, 0.8, $row->jumlah,1, 0, 'C');
	$pdf->Cell(3.5, 0.8, "Rp.".number_format($harga).",-",1, 0, 'C');
	$pdf->Cell(4.5, 0.8,$row->diskon, 1, 0,'C');
	$pdf->Cell(4.5, 0.8,"Rp.".number_format($subtotal*$row->jumlah).",-",1, 1, 'C');
	$no++;
 }
    $pdf->Output("laporan_barang.pdf","I");
  }*/
}
?>