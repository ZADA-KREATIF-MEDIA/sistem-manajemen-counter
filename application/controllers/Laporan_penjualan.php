<?php 
class Laporan_penjualan extends CI_Controller{

   function __construct() 
   {
      parent::__construct();
      $this->load->Model('Model_laporanPenjualan','mod');
   }

   public function index()
   {
      $data['laporan']=$this->mod->show_laporan()->result();
      // print('<pre>');print_r($data);exit();
      $this->template->load('template','laporan_penjualan/index',$data);
   }

   public function show_detail()
   {
      $imei = $this->uri->segment(3);
      $data['detail'] = $this->mod->m_get_detail($imei);
      // print('<pre>');print_r($data);exit();
      $this->template->load('template','laporan_penjualan/detail', $data);
   }

   public function edit_detail()
   {
      $imei = $this->uri->segment(3);
      $data['user']     = $this->mod->m_get_user()->result_array();
      $data['detail']   = $this->mod->m_get_detail($imei);
      // print('<pre>');print_r($data);exit();
      $this->template->load('template','laporan_penjualan/edit', $data);
   }

   public function upgrade()
   {
      $harga_beli = str_replace(".","",$this->input->post('harga_beli', true));
      $harga_jual = str_replace(".","",$this->input->post('harga_jual', true));
      $data = [
         'imei'            => $this->input->post('imei', true),
         'nama_barang'     => $this->input->post('nama_barang', true),
         'harga_beli'      => $harga_beli,
         'harga_jual'      => $harga_jual,
         'keterangan'      => $this->input->post('keterangan', true),
         'nama_customer'   => $this->input->post('nama_customer', true),
         'id_user'         => $this->input->post('id_user', true),
         'metode_bayar'    => $this->input->post('metode_bayar', true)
      ];
      // print('<pre>');print_r($data_barang);exit();
      $this->mod->m_update_penjualan($data);
      $_SESSION['msg'] = 'edit laporan penjualan berhasil';
      redirect('Laporan_penjualan');
   }

   public function export(){
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
  
      $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PENJUALAN BARANG - iHARDWARE"); // Set kolom A1 dengan tulisan "DATA SISWA"
      $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
      $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
      $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
      $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
  
      $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
      $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL PENJUALAN"); 
      $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA KONSUMEN"); 
      $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA BARANG");
      $excel->setActiveSheetIndex(0)->setCellValue('E3', "IMEI"); 
      $excel->setActiveSheetIndex(0)->setCellValue('F3', "HARGA BELI");
      $excel->setActiveSheetIndex(0)->setCellValue('G3', "HARGA JUAL");
      $excel->setActiveSheetIndex(0)->setCellValue('H3', "PEMBAYARAN");
      $excel->setActiveSheetIndex(0)->setCellValue('I3', "NAMA PETUGAS");

      // Apply style header yang telah kita buat tadi ke masing-masing kolom header
      $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
      $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
  
      // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
      $data_laporan=$this->mod->show_laporan()->result();
  
      $no = 1; // Untuk penomoran tabel, di awal set dengan 1
      $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
      $total =0;
      $beli =0;
      $start_row = 4;
      foreach($data_laporan as $data){ // Lakukan looping pada variabel siswa
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
        $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->tanggal);
        $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_customer);
        $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama_barang);
        $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->imei);
        $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, "Rp ".number_format($data->harga_beli,2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "Rp ".number_format($data->harga_jual,2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->metode_bayar);
        $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->nama);
        
        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
        $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
        
        $no++; // Tambah 1 setiap kali looping
        $total += $data->harga_jual;
        $beli+= $data->harga_beli;
        $numrow++; // Tambah 1 setiap kali looping
      }
      $jumlah_baris = count($data_laporan) + $start_row;
      $jumlah_baris2 = count($data_laporan) + $start_row +1;
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$jumlah_baris, "TOTAL PENJUALAN : Rp ".number_format($total,0,'.','.'));
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getFont()->setBold(TRUE);
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getFont()->setSize(12);
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$jumlah_baris2, "TOTAL LABA RUGI : Rp ".number_format($total-$beli,0,'.','.'));
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris2)->getFont()->setBold(TRUE);
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris2)->getFont()->setSize(12);
      $excel->getActiveSheet()->getStyle('A'.$jumlah_baris2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

      $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
      $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
      $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
      $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
      $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
      $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
      $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
      $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
      $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
      // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
      $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
  
      // Set orientasi kertas jadi LANDSCAPE
      $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
  
      // Set judul file excel nya
      $excel->getActiveSheet(0)->setTitle("Laporan Penjualan");
      $excel->setActiveSheetIndex(0);
  
      // Proses file excel
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Laporan Penjualan.xlsx"'); // Set nama file excel nya
      header('Cache-Control: max-age=0');
  
      $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
      $write->save('php://output');
    }

    public function hapus()
    {
      $id = $this->input->post('id',true);
      $data = $this->mod->m_hapus_laporan_penjualan($id);
      echo json_encode($data);
    }

}



