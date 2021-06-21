<?php 
class Laporan_Pembelian extends CI_Controller{

	function __construct() {
        parent::__construct();
        $this->load->Model('Model_laporanPembelian','mod');
    }

    public function index()
    {
        $data['laporan']=$this->mod->show_laporan()->result();
        // print('<pre>');print_r($data);exit();
        $this->template->load('template','laporan_pembelian/index',$data);
    }

    public function hapus()
    {
      $kode_pembelian     = $this->input->post('kode_pembelian', TRUE);
      $data['pembelian']  = $this->mod->destroy($kode_pembelian);
      $data['barang']     = $this->mod->destroy_barang($kode_pembelian);
      echo json_encode($data);
    }

    public function show()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->show_detail($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'laporan_pembelian/detail', $data);
    }
    public function print()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->show_detail($id_customer);
       
        $data['item'] = $this->mod->show_detail($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->load->view('Laporan_pembelian/print', $data);
    }

    public function export()
    {
      // Load plugin PHPExcel nya
      include APPPATH.'third_party/PHPExcel/PHPExcel.php';
      
      // Panggil class PHPExcel nya
      $excel = new PHPExcel();
  
      // Settingan awal fil excel
      $excel->getProperties()->setCreator('iHardware-Yogyakarta')
                    ->setLastModifiedBy('iHardware-Yogyakarta')
                    ->setTitle("Laporan Penjualan")
                    ->setSubject("Penjualan")
                    ->setDescription("Laporan Semua Data Penjualan")
                    ->setKeywords("Laporan Penjualan");
  
      // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
      $style_col = array(
        'font' => array('bold' => true), // Set font nya jadi bold
        'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
          'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
          'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
          'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
          'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
          'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
        )
      );
  
      // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
      $style_row = array(
        'alignment' => array(
          'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
          'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
          'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
          'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
          'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
        )
      );
  
      $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PEMBELIAN BARANG - iHARDWARE"); // Set kolom A1 dengan tulisan "DATA SISWA"
      $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
      $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
      $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
      $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  
      // Buat header tabel nya pada baris ke 3
      $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
      $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL PENJUALAN"); // Set kolom B3 dengan tulisan "NIS"
      $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA KONSUMEN"); // Set kolom C3 dengan tulisan "NAMA"
      $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA BARANG"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
      $excel->setActiveSheetIndex(0)->setCellValue('E3', "IMEI"); // Set kolom E3 dengan tulisan "ALAMAT"
      $excel->setActiveSheetIndex(0)->setCellValue('F3', "HARGA BELI");
      $excel->setActiveSheetIndex(0)->setCellValue('G3', "PEMBAYARAN");
      $excel->setActiveSheetIndex(0)->setCellValue('H3', "NAMA PETUGAS");

      // Apply style header yang telah kita buat tadi ke masing-masing kolom header
      $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
  
      // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
      $data_laporan=$this->mod->show_laporan()->result();
      
  
      $no = 1; // Untuk penomoran tabel, di awal set dengan 1
      $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
      $total=0;
      $start_row = 4;
      foreach($data_laporan as $data)
      { // Lakukan looping pada variabel siswa
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
        $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->tanggal);
        $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_customer);
        $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama_barang);
        $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->imei);
        $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, "Rp ".number_format($data->harga_beli,2,'.','.'));

        $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->metode_bayar);
        $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->nama);
        
        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
        $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);

        
        $no++; // Tambah 1 setiap kali looping
        $numrow++; // Tambah 1 setiap kali looping
        $total+= $data->harga_beli;
      }
      $jumlah_baris = count($data_laporan) + $start_row;
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$jumlah_baris, "TOTAL PEMBELIAN : Rp ".number_format($total,0,'.','.'));
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getFont()->setBold(TRUE); // Set bold kolom A1
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      // Set width kolom
      $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
      $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
      $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
      $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
      $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
      $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
      $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);

      // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
      $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
  
      // Set orientasi kertas jadi LANDSCAPE
      $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
  
      // Set judul file excel nya
      $excel->getActiveSheet(0)->setTitle("LAPORAN PEMBELIAN");
      $excel->setActiveSheetIndex(0);
  
      // Proses file excel
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Laporan Pembelian.xlsx"'); // Set nama file excel nya
      header('Cache-Control: max-age=0');
  
      $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
      $write->save('php://output');
    }

    public function get_harga_keterangan_pembelian()
    {
      $id = $_POST['id'];
      $data = $this->mod->m_get_harga_keterangan_pembelian($id);
      echo json_encode($data);
    }

    public function update()
    {
      $kode_pembelian   = $this->input->post('kode_pembelian',TRUE);
      $harga_pembelian  = str_replace(".","",$this->input->post('harga_pembelian',TRUE));
      $keterangan       = $this->input->post('keterangan',TRUE);
      $post = [
        'kode_pembelian'  => $kode_pembelian,
        'harga_beli' => $harga_pembelian,
        'keterangan'      => $keterangan
      ];
      // print('<pre>');print_r($post);exit();
      $this->mod->m_update_laporan_pembelian($post);
      $cek = $this->mod->m_cek_kode_pembelian_penjualan($kode_pembelian);
      if($cek['kode_pembelian'] !=""){
        $this->mod->m_update_laporan_penjualan($post);
      }
      $_SESSION['msg'] = 'edit laporan pembelian berhasil';
      redirect(site_url('laporan_pembelian'));
    }

}

?>