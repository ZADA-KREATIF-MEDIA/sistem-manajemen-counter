<?php
Class Barang extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->Model('Model_barang','mod');
    }

    public function index()
    {
      $data['barang']=$this->mod->show_barang()->result();
      $this->template->load('template','barang/index',$data);
    }

    public function tambah()
    {
        if(isset($_POST['submit'])){
          $this->mod->add();
          redirect('Barang');
        } else{
          $this->template->load('template','barang/add');
        }
    }

    public function edit()
    {
      if(isset($_POST['submit'])){
        $this->mod->update();
        redirect('Barang');
      }else{
        $id             = $this->uri->segment(3);
        $data['barang'] = $this->mod->edit($id)->row_Array();
        $this->template->load('template','barang/edit',$data);
      }
    }

    public function hapus()
    {
      $id=$this->input->post('id',true);
      $this->mod->m_hapus_barang($id);
      $cek = $this->mod->m_cek_tmp($id);
      if($cek){
        $this->mod->m_hapus_tmp($id);
      }
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
    
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN DATA BARANG - iHARDWARE"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA BARANG"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "IMEI/SN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "HARGA BELI"); 
        // $excel->setActiveSheetIndex(0)->setCellValue('E3', "HARGA JUAL"); 
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KETERANGAN");
  
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        // $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $data_barang=$this->mod->show_barang()->result();
    
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        $start_row = 4;
        $total = 0;
        foreach($data_barang as $data){ // Lakukan looping pada variabel siswa
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_barang);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->imei);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "Rp ".number_format($data->harga_beli,2,'.','.'));
          // $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, "Rp ".number_format($data->harga_jual,2,'.','.'));
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->keterangan);
          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
          // $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
          $no++; // Tambah 1 setiap kali looping
          $total+= $data->harga_beli;
          $numrow++; // Tambah 1 setiap kali looping
        }
        $range =  count($data_barang) + $start_row;
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$range, "Total Pembelian : Rp".number_format($total,0,'.','.'));
        $excel->getActiveSheet()->getStyle('A'.$range)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A'.$range)->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A'.$range)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        // $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Barang");
        $excel->setActiveSheetIndex(0);
    
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Barang.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
    
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
     }

    public function hapus_tmp()
    {
      $id = $this->input->post('id',true);
      $update = [
        'kode_pembelian' => $id,
        'status' => 'in_stock'
      ];
      $tmp = $this->mod->m_update_instock($update);
      $data = $this->mod->m_destroy_tmp_byid($id);
      echo json_encode($data);
    }
  
}

?>