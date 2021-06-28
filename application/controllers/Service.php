<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Service extends CI_Controller
{

	function __construct() {
        parent::__construct();
        $this->load->model('Model_service','mod');
    }

    public function index()
    {
        $data['service']    = $this->mod->show_service();
        $data['biaya']      = $this->mod->biaya();
        $data['part']       = $this->mod->show_part();
        $this->template->load('template','service/index',$data);
    }

    public function create()
    {
        $this->template->load('template', 'service/add');
    }

    public function store()
    {
        $date_in_sql = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_masuk', TRUE)." ".date("H:i:s")));
        $date_out_sql = date('Y-m-d', strtotime($this->input->post('tanggal_jadi', TRUE)));
        $post = [
            "nama_customer"     => $this->input->post('nama_customer', TRUE),
            "alamat"            => $this->input->post('alamat', TRUE),
            "no_telpn"          => $this->input->post('no_tlpn', TRUE),
            "nama_barang"       => $this->input->post('nama_barang', TRUE),
            "tipe"              => $this->input->post('tipe', TRUE),
            "imei"              => $this->input->post('imei', TRUE),
            "kelengkapan"       => $this->input->post('kelengkapan', TRUE),
            "keluhan"           => $this->input->post('keluhan', TRUE),
            "keterangan"        => $this->input->post('keterangan', TRUE),
            "id_teknisi"        => $this->input->post('id_teknisi', TRUE),
            "tanggal_masuk"     => $date_in_sql,
            "tanggal_jadi"      => $date_out_sql
        ];
        $post_customer = [
            'nama'          => $this->input->post('nama_customer',true),
            'alamat'        => $this->input->post('alamat', true),
            'no_telpn'      => $this->input->post('no_tlpn', true),
            'tgl_daftar'    => date('Y-m-d'),
            'imei'          => $this->input->post('imei', true)      
        ];
        $this->mod->m_store_customer($post_customer);
        $last_id = $this->mod->m_store_part1($post);
        $part_hw    = $this->input->post('part_hw', TRUE);
        $new_hw     = str_replace(".","", $this->input->post('harga_part_hw', TRUE));
        $part_sw    = $this->input->post('part_sw', TRUE);
        $new_sw     = str_replace(".","", $this->input->post('harga_part_sw', TRUE));
        if($part_hw != ""){
            for ($i = 0; $i < count($this->input->post('part_hw', TRUE)); $i++) {
                $data_hw[$i] = array(
                    "id_service" 	=> $last_id,
                    "nama_part" 	=> $part_hw[$i],
                    "biaya"         => $new_hw[$i]
                );
            }
            $this->mod->m_store_hardware($data_hw);
        }
        if($part_sw != ""){
            for ($i = 0; $i < count($this->input->post('part_sw', TRUE)); $i++) {
                $data_sw[$i] = array(
                    "id_service" 	    => $last_id,
                    "nama_software"     => $part_sw[$i],
                    "biaya"             => $new_sw[$i]
                );
            }
            $this->mod->m_store_software($data_sw);
        }

		redirect(site_url('service'));
    }

    public function show()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->m_show($id_customer);
        $data['service'] = $this->mod->m_show_service($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'service/detail', $data);
    }

    public function edit()
    {
        $id_customer        = $this->uri->segment(3);
        $data['detail']     = $this->mod->m_show($id_customer);
        $data['part']       = $this->mod->m_show_service_part($id_customer);
        $data['software']   = $this->mod->m_show_service_software($id_customer);
        // print('<pre>');print_r($data);exit();
        $this->template->load('template', 'service/edit', $data);
    }

    public function update()
    {
        // $new_bs = str_replace(".","", $this->input->post('biaya_software', TRUE));
        // $new_bh = str_replace(".","", $this->input->post('biaya_hardware', TRUE));
        $date_in_sql    = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_masuk', TRUE)));
        $date_out_sql   = date('Y-m-d', strtotime($this->input->post('tanggal_jadi', TRUE)));
        $date_take_sql  = date('Y-m-d H:i:s', strtotime($this->input->post('tanggal_diambil', TRUE)." ".date("H:i:s")));
        $id_service     = $this->input->post('id_service', TRUE);
        $post = [
            "id_service"        => $this->input->post('id_service', TRUE),
            "nama_customer"     => $this->input->post('nama_customer', TRUE),
            "alamat"            => $this->input->post('alamat', TRUE),
            "no_telpn"          => $this->input->post('no_tlpn', TRUE),
            "nama_barang"       => $this->input->post('nama_barang', TRUE),
            "tipe"              => $this->input->post('tipe', TRUE),
            "imei"              => $this->input->post('imei', TRUE),
            "kelengkapan"       => $this->input->post('kelengkapan', TRUE),
            "keluhan"           => $this->input->post('keluhan', TRUE),
            "keterangan"        => $this->input->post('keterangan', TRUE),
            "id_teknisi"        => $this->input->post('id_teknisi', TRUE),
            "status"            => $this->input->post('status', TRUE),
            "tanggal_masuk"     => $date_in_sql,
            "tanggal_jadi"      => $date_out_sql,
            "tanggal_diambil"   => $date_take_sql
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_update_part1($post);

    
        $id_part        = $this->input->post('id_part', TRUE);
        $nama_part      = $this->input->post('part_hw', TRUE);
        $harga_part_hw  = str_replace(".","", $this->input->post('harga_part_hw', TRUE));
        for ($i = 0; $i < count($id_part); $i++) {
            $data_hw[$i] = array(
                "id_part"       => $id_part[$i],
                "id_service" 	=> $id_service,
                "biaya" 	    => $harga_part_hw[$i],
                "nama_part"     => $nama_part[$i],
            );
        }
        $this->mod->m_update_part($data_hw);
        $id_software    = $this->input->post('id_software', TRUE);
        $nama_software  = $this->input->post('part_sw', TRUE);
        $harga_part_sw  = str_replace(".","", $this->input->post('harga_part_sw', TRUE));
        for ($i = 0; $i < count($id_part); $i++) {
            $data_sw[$i] = array(
                "id_software"       => $id_software[$i],
                "id_service" 	    => $id_service,
                "biaya" 	        => $harga_part_sw[$i],
                "nama_software"     => $nama_software[$i],
            );
        }
        // print('<pre>');print_r($data_sw);exit();
        $this->mod->m_update_software($data_sw);
        redirect(site_url('service'));
    }

    public function delete()
    {
        $id_customer = $this->input->post('id_customer', TRUE);
        $data = $this->mod->m_destroy($id_customer);
        echo json_encode($data);
    }

    public function print()
    {
        $id_customer = $this->uri->segment(3);
        $data['detail'] = $this->mod->m_show($id_customer);
        $data['service'] = $this->mod->m_show_service($id_customer);
        $this->load->view('service/print', $data);
    }

    public function destroy_service_part()
    {
        $id = $this->input->post('id_service', TRUE);
        $data = $this->mod->m_destroy_service_part($id);
        echo json_encode($data);
    }

    public function destroy_service_software()
    {
        $id = $this->input->post('id_service', TRUE);
        $data = $this->mod->m_destroy_service_software($id);
        echo json_encode($data);
    }

    public function store_hw()
    {
        $id_service = $this->input->post('id_service', TRUE);
        $part_hw = $this->input->post('part_hw', TRUE);
        $biaya = str_replace(".","", $this->input->post('harga_part_hw', TRUE));
        $post = [
            'id_service'    => $id_service,
            'nama_part'     => $part_hw,
            'biaya'         => $biaya
        ];
        $this->mod->m_store_hw($post);
        redirect(site_url('service/edit/'.$id_service));
    }

    public function store_sw()
    {
        $id_service = $this->input->post('id_service', TRUE);
        $part_sw = $this->input->post('part_sw', TRUE);
        $biaya = str_replace(".","", $this->input->post('harga_part_sw', TRUE));
        $post = [
            'id_service'        => $id_service,
            'nama_software'     => $part_sw,
            'biaya'             => $biaya
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_store_sw($post);
        redirect(site_url('service/edit/'.$id_service));
    }

    public function ubah_status_pengerjaan()
    {
        $id = $this->input->post('id_customer',TRUE);
        $post =[
            'id_service'    => $id,
            'status'        => "sedang dikerjakan"
        ];
        $data = $this->mod->m_update_status_pengerjaan($post);
        echo json_encode($data);
    }

    public function export_service()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('iHardware-Yogyakarta')
                    ->setLastModifiedBy('iHardware-Yogyakarta')
                    ->setTitle("Laporan Service")
                    ->setSubject("Service")
                    ->setDescription("Laporan Semua Data Service")
                    ->setKeywords("Laporan Service");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN SERVICE - iHARDWARE"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA KONSUMEN"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "ALAMAT"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NO TELPON");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA BARANG"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TANGGAL MASUK"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "ESTIMASI JADI");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "STATUS");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "BIAYA SERVICE");

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
        if($this->session->userdata('level') == "admin"){
            $data_laporan = $this->mod->show_laporan_all();
        }else{
            $data_laporan = $this->mod->show_laporan_by_teknisi();
        }
        // print('<pre>');print_r($data_laporan);exit();
        $biaya        = $this->mod->biaya();

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        //   $total=0;
        $i = 0;
        $start_row = 4;
        foreach($data_laporan as $data)
        { // Lakukan looping pada variabel siswa
            $biaya_hw   = $biaya['biaya_part'][$i]->biaya_hardware;
            $biaya_sw   = $biaya['biaya_software'][$i]->biaya_software;
            $total      = $biaya_hw + $biaya_sw;
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nama_customer']);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['alamat']);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['no_telpn']);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['nama_barang']);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['tanggal_masuk']);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['tanggal_jadi']);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['status']);
            $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, number_format($total,2,',','.'));
            
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
            $numrow++; // Tambah 1 setiap kali looping
            $i++;
        }
        // Set width kolom
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
        $excel->getActiveSheet(0)->setTitle("LAPORAN SERVICE");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Service.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function export_part()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('iHardware-Yogyakarta')
                    ->setLastModifiedBy('iHardware-Yogyakarta')
                    ->setTitle("Laporan Part Service")
                    ->setSubject("Part Service")
                    ->setDescription("Laporan Semua Data Part Service")
                    ->setKeywords("Laporan Part Service");

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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN PART SERVICE - iHARDWARE"); 
        $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA PART"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "PENJUAL"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "HARGA");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL BELI"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TEKNISI"); // Set kolom E3 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $data_laporan = $this->mod->show_part();

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        $total=0;
        $i = 0;
        $start_row = 4;
        foreach($data_laporan as $data)
        { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nama_part']);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['penjual']);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, number_format($data['harga'],2,',','.'));
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['tanggal']);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['nama']);
            
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $total += $data['harga'];
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
            $i++;
        }
        $jumlah_baris = count($data_laporan) + $start_row;
        $jumlah_baris2 = count($data_laporan) + $start_row +1;
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$jumlah_baris, "TOTAL PENJUALAN : Rp ".number_format($total,0,'.','.'));
        $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A'.$jumlah_baris)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("LAPORAN PART");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Part.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    /*---------- PART ----------*/
    public function add_part()
    {
        $this->template->load('template', 'service/add_part');
    }

    public function store_part()
    {
        $post = [
            'nama_part'     => $this->input->post('nama_part',true),
            'penjual'       => $this->input->post('penjual',true),
            'harga'         => str_replace(".","",$this->input->post('harga',true)),
            'tanggal'       => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal',true)." ".date("H:i:s"))),
            'keterangan'    => $this->input->post('keterangan', true),
            'id_teknisi'    => $this->input->post('id_teknisi', true)
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_store_part($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Simpan Part Berhasil
        </div>');
        redirect('service');
    }

    public function edit_part()
    {
        $id = $this->uri->segment(3);
        $data['detail_part'] = $this->mod->m_get_detail_part($id);
        $this->template->load('template', 'service/edit_part',$data);
    }

    public function update_part()
    {
        $post = [
            'id'       => $this->input->post('id_part',true),
            'nama_part'     => $this->input->post('nama_part',true),
            'penjual'       => $this->input->post('penjual',true),
            'harga'         => str_replace(".","",$this->input->post('harga',true)),
            'tanggal'       => date('Y-m-d H:i:s', strtotime($this->input->post('tanggal',true)." ".date("H:i:s"))),
            'keterangan'    => $this->input->post('keterangan', true)
        ];
        // print('<pre>');print_r($post);exit();
        $this->mod->m_update_parts($post);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Update Part Berhasil
        </div>');
        redirect('service');
    }

    public function delete_part()
    {
        $id = $this->uri->segment(3);
        $this->mod->m_delete_part($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Part Berhasil
        </div>');
        redirect('service');
    }

}
