<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Laporan_laba_rugi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan_laba_rugi','mod');
    }

    public function harian()
    {
        $hari = date('Y-m-d', strtotime($this->input->post('hari',TRUE)));
        $data['saldo_awal']     = $this->mod->m_get_saldo_awal();
        if(isset($hari) && $hari !='1970-01-01'){
            // print('<pre>');print_r($hari);exit();
            $_SESSION['hari']       = $hari;
            $data['hari']        = $hari;
            $data['pembelian']      = $this->mod->m_get_pembelian_by_hari($hari);
            $data['penjualan']      = $this->mod->m_get_penjualan_by_hari($hari);
            $data['penggajian']     = $this->mod->m_get_penggajian_by_hari($hari);
            $data['pengeluaran']    = $this->mod->m_get_pengeluaran_by_hari($hari);
            $data['piutang']        = $this->mod->m_get_piutang_by_hari($hari);
            $data['hutang']         = $this->mod->m_get_hutang_by_hari($hari);
        }else{
            $_SESSION['hari']       = 0;
            $data['hari']           = date("Y-m-d");
            $data['pembelian']      = $this->mod->m_get_pembelian();
            $data['penjualan']      = $this->mod->m_get_penjualan();
            $data['penggajian']     = $this->mod->m_get_penggajian();
            $data['pengeluaran']    = $this->mod->m_get_pengeluaran();
            $data['piutang']        = $this->mod->m_get_piutang();
            $data['hutang']         = $this->mod->m_get_hutang();
        }
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'laporan_laba_rugi/detail_harian',$data);
    }

    public function bulanan()
    {
        $bulan = $this->input->post('bulan',TRUE);
        $data['saldo_awal']     = $this->mod->m_get_saldo_awal();
        if($bulan !=""){
            $tahun = date('Y');
            $format = $tahun."-".$bulan;
            $new_bulan = explode("-",date('Y-M', strtotime($format)));
            $bulan_kirim = $new_bulan[1];
            $data['bulan'] = $bulan_kirim;
            // $_SESSION['format'] = $format;
            $_SESSION['bulan'] = $format;
            // $data['total'] = $this->mod->m_get_laporan_by($format);
            $data['pembelian']      = $this->mod->m_get_pembelian_bulanan_by($format);
            $data['penjualan']      = $this->mod->m_get_penjualan_bulanan_by($format);
            $data['penggajian']     = $this->mod->m_get_penggajian_bulanan_by($format);
            $data['pengeluaran']    = $this->mod->m_get_pengeluaran_bulanan_by($format);
            $data['piutang']        = $this->mod->m_get_piutang_bulanan_by($format);
            $data['hutang']         = $this->mod->m_get_hutang_bulanan_by($format);
            // print('<pre>');print_r($data);exit();
        }else{
            $_SESSION['bulan'] = 0;
            $data['bulan']          = date("M"); 
            $data['pembelian']      = $this->mod->m_get_pembelian_bulanan();
            $data['penjualan']      = $this->mod->m_get_penjualan_bulanan();
            $data['penggajian']     = $this->mod->m_get_penggajian_bulanan();
            $data['pengeluaran']    = $this->mod->m_get_pengeluaran_bulanan();
            $data['piutang']        = $this->mod->m_get_piutang_bulanan();
            $data['hutang']         = $this->mod->m_get_hutang_bulanan();
        }
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'laporan_laba_rugi/detail_bulanan',$data);
    }

    public function export_harian()
    {
        $hari_session = $this->uri->segment(3);
        // print('<pre>');print_r($format);exit();
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('iHardware-Yogyakarta')
                    ->setLastModifiedBy('iHardware-Yogyakarta')
                    ->setTitle("Laporan Harian")
                    ->setSubject("Laporan Harian")
                    ->setDescription("Laporan Harian")
                    ->setKeywords("Laporan Harian");

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

        $style_row_2 = array(
            'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
    
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN HARIAN - iHARDWARE"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:B1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "KETERANGAN"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "NOMINAL"); // Set kolom B3 dengan tulisan "NIS"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        
        $saldo_awal     = $this->mod->m_get_saldo_awal();
        // $bulan_sekarang = date("M");
        // $bulan_session = $_SESSION['bulan'];
        // print('<pre>');print_r($bulan_session);exit();
        if($hari_session == "") {
            $hari = date("Y-m-d");
            // print($bulan);exit();
            $pembelian      = $this->mod->m_get_pembelian();
            $penjualan      = $this->mod->m_get_penjualan();
            $penggajian     = $this->mod->m_get_penggajian();
            $pengeluaran    = $this->mod->m_get_pengeluaran();
            $piutang        = $this->mod->m_get_piutang();
            $hutang         = $this->mod->m_get_hutang();
        }else{
            $hari           = $hari_session;
            $pembelian      = $this->mod->m_get_pembelian_by_hari($hari);
            $penjualan      = $this->mod->m_get_penjualan_by_hari($hari);
            $penggajian     = $this->mod->m_get_penggajian_by_hari($hari);
            $pengeluaran    = $this->mod->m_get_pengeluaran_by_hari($hari);
            $piutang        = $this->mod->m_get_piutang_by_hari($hari);
            $hutang         = $this->mod->m_get_hutang_by_hari($hari);
        }

        $excel->setActiveSheetIndex(0)->setCellValue('A3', 'Tanggal :'. $hari);
        $excel->setActiveSheetIndex(0)->setCellValue('B5', number_format($saldo_awal['nominal'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A6', 'Penjualan');
        $excel->setActiveSheetIndex(0)->setCellValue('B6', number_format($penjualan['total_penjualan'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A7');
        $excel->setActiveSheetIndex(0)->setCellValue('B7','------------------------------------------------------+');
        $excel->setActiveSheetIndex(0)->setCellValue('A8');
        $excel->setActiveSheetIndex(0)->setCellValue('B8', number_format($saldo_awal['nominal'] + $penjualan['total_penjualan'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A9','Piutang');
        $excel->setActiveSheetIndex(0)->setCellValue('B9', number_format($piutang['total_piutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A10');
        $excel->setActiveSheetIndex(0)->setCellValue('B10','----------------------------------------------------- -');
        $excel->setActiveSheetIndex(0)->setCellValue('A11', 'Total Pendapatan');
        $excel->setActiveSheetIndex(0)->setCellValue('B11', number_format($saldo_awal['nominal'] + $penjualan['total_penjualan']-$piutang['total_piutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A12');
        $excel->setActiveSheetIndex(0)->setCellValue('B12');
        $excel->setActiveSheetIndex(0)->setCellValue('A13', 'Pembelian');
        $excel->setActiveSheetIndex(0)->setCellValue('B13', number_format($pembelian['total_pembelian'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A14', 'Hutang');
        $excel->setActiveSheetIndex(0)->setCellValue('B14', number_format($hutang['total_hutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A15');
        $excel->setActiveSheetIndex(0)->setCellValue('B15', '----------------------------------------------------- -');
        $excel->setActiveSheetIndex(0)->setCellValue('A16');
        $excel->setActiveSheetIndex(0)->setCellValue('B16', number_format($pembelian['total_pembelian']-$hutang['total_hutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A17','Penggajian');
        $excel->setActiveSheetIndex(0)->setCellValue('B17', number_format($penggajian['total_penggajian'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A18','Penggeluaran');
        $excel->setActiveSheetIndex(0)->setCellValue('B18', number_format($pengeluaran['total_pengeluaran'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A19');
        $excel->setActiveSheetIndex(0)->setCellValue('B19','----------------------------------------------------- +');
        $excel->setActiveSheetIndex(0)->setCellValue('A20', 'Total Pengeluaran');
        $excel->setActiveSheetIndex(0)->setCellValue('B20', number_format($pembelian['total_pembelian']-$hutang['total_hutang']+$penggajian['total_penggajian']+$pengeluaran['total_pengeluaran'],2,'.','.'));
        $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A7')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A8')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A10')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A11')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A12')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A13')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A14')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A15')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A16')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A17')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A18')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A19')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A20')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B8')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B10')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B11')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B12')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B13')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B14')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B15')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B16')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B17')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B18')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B19')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B20')->applyFromArray($style_row_2);
       
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
  
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("LAPORAN HARIAN");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Harian.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');  
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function export_bulanan()
    {
        $format = $this->uri->segment(3);
        // print('<pre>');print_r($format);exit();
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('iHardware-Yogyakarta')
                    ->setLastModifiedBy('iHardware-Yogyakarta')
                    ->setTitle("Laporan Bulanan")
                    ->setSubject("Laporan Bulanan")
                    ->setDescription("Laporan Bulanan")
                    ->setKeywords("Laporan Bulanan");

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

        $style_row_2 = array(
            'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
    
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN BULANAN - iHARDWARE"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:B1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "KETERANGAN"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "NOMINAL"); // Set kolom B3 dengan tulisan "NIS"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        
        $saldo_awal     = $this->mod->m_get_saldo_awal();
        // $bulan_sekarang = date("M");
        // $bulan_session = $_SESSION['bulan'];
        // print('<pre>');print_r($bulan_session);exit();
        if($format == "") {
            $bulan = date("M");
            // print($bulan);exit();
            $pembelian      = $this->mod->m_get_pembelian_bulanan();
            $penjualan      = $this->mod->m_get_penjualan_bulanan();
            $penggajian     = $this->mod->m_get_penggajian_bulanan();
            $pengeluaran    = $this->mod->m_get_pengeluaran_bulanan();
            $piutang        = $this->mod->m_get_piutang_bulanan();
            $hutang         = $this->mod->m_get_hutang_bulanan();
        }else{
            $bulan_old      = explode("-",date("Y-M", strtotime($format)));
            $bulan          = $bulan_old[1];
            $pembelian      = $this->mod->m_get_pembelian_bulanan_by($format);
            $penjualan      = $this->mod->m_get_penjualan_bulanan_by($format);
            $penggajian     = $this->mod->m_get_penggajian_bulanan_by($format);
            $pengeluaran    = $this->mod->m_get_pengeluaran_bulanan_by($format);
            $piutang        = $this->mod->m_get_piutang_bulanan_by($format);
            $hutang         = $this->mod->m_get_hutang_bulanan_by($format);
        }

        $excel->setActiveSheetIndex(0)->setCellValue('A3', 'Bulan :'. $bulan);
        $excel->setActiveSheetIndex(0)->setCellValue('B5', number_format($saldo_awal['nominal'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A6', 'Penjualan');
        $excel->setActiveSheetIndex(0)->setCellValue('B6', number_format($penjualan['total_penjualan'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A7');
        $excel->setActiveSheetIndex(0)->setCellValue('B7','------------------------------------------------------+');
        $excel->setActiveSheetIndex(0)->setCellValue('A8');
        $excel->setActiveSheetIndex(0)->setCellValue('B8', number_format($saldo_awal['nominal'] + $penjualan['total_penjualan'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A9','Piutang');
        $excel->setActiveSheetIndex(0)->setCellValue('B9', number_format($piutang['total_piutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A10');
        $excel->setActiveSheetIndex(0)->setCellValue('B10','----------------------------------------------------- -');
        $excel->setActiveSheetIndex(0)->setCellValue('A11', 'Total Pendapatan');
        $excel->setActiveSheetIndex(0)->setCellValue('B11', number_format($saldo_awal['nominal'] + $penjualan['total_penjualan']-$piutang['total_piutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A12');
        $excel->setActiveSheetIndex(0)->setCellValue('B12');
        $excel->setActiveSheetIndex(0)->setCellValue('A13', 'Pembelian');
        $excel->setActiveSheetIndex(0)->setCellValue('B13', number_format($pembelian['total_pembelian'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A14', 'Hutang');
        $excel->setActiveSheetIndex(0)->setCellValue('B14', number_format($hutang['total_hutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A15');
        $excel->setActiveSheetIndex(0)->setCellValue('B15', '----------------------------------------------------- -');
        $excel->setActiveSheetIndex(0)->setCellValue('A16');
        $excel->setActiveSheetIndex(0)->setCellValue('B16', number_format($pembelian['total_pembelian']-$hutang['total_hutang'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A17','Penggajian');
        $excel->setActiveSheetIndex(0)->setCellValue('B17', number_format($penggajian['total_penggajian'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A18','Penggeluaran');
        $excel->setActiveSheetIndex(0)->setCellValue('B18', number_format($pengeluaran['total_pengeluaran'],2,'.','.'));
        $excel->setActiveSheetIndex(0)->setCellValue('A19');
        $excel->setActiveSheetIndex(0)->setCellValue('B19','----------------------------------------------------- +');
        $excel->setActiveSheetIndex(0)->setCellValue('A20', 'Total Pengeluaran');
        $excel->setActiveSheetIndex(0)->setCellValue('B20', number_format($pembelian['total_pembelian']-$hutang['total_hutang']+$penggajian['total_penggajian']+$pengeluaran['total_pengeluaran'],2,'.','.'));
        $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A7')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A8')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A10')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A11')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A12')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A13')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A14')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A15')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A16')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A17')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A18')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A19')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('A20')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B8')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B10')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B11')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B12')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B13')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B14')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B15')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B16')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B17')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B18')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B19')->applyFromArray($style_row_2);
        $excel->getActiveSheet()->getStyle('B20')->applyFromArray($style_row_2);
       
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(30); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
  
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("LAPORAN BULANAN");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Bulanan.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');  
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }


}