<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
Class Model_laporan_laba_rugi extends CI_Model
{
    public function m_get_saldo_awal()
    {
        $this->db->select('nominal')
            ->from('saldo_awal')
            ->where('id', 3);    
        $query = $this->db->get_compiled_select();
        $data	= $this->db->query($query)->row_array();
        return $data;
    }
    /* Harian */
    public function m_get_pembelian()
    {
        $query = $this->db->query("SELECT SUM(harga_beli) AS total_pembelian FROM pembelian WHERE tanggal  = DATE(NOW()) GROUP BY tanggal");
        return $query->row_array();
    }

    public function m_get_penjualan()
    {
        $query = $this->db->query("SELECT SUM(harga_jual) AS total_penjualan FROM penjualan WHERE tanggal = DATE(NOW()) GROUP BY tanggal");
        return $query->row_array();
    }

    public function m_get_penggajian()
    {
        $query = $this->db->query("SELECT SUM(gaji_pokok+bon+bonus) AS total_penggajian FROM gaji WHERE tanggal = DATE(now()) GROUP BY tanggal");
        return $query->row_array();
    }

    public function m_get_pengeluaran()
    {
        $query = $this->db->query("SELECT SUM(nominal) AS total_pengeluaran FROM pengeluaran WHERE tanggal = DATE(now()) GROUP BY tanggal");
        return $query->row_array();
    }

    public function m_get_piutang()
    {
        $query = $this->db->query("SELECT SUM(nominal_piutang) AS total_piutang FROM piutang WHERE tanggal_piutang = DATE(now()) AND status = 'belum' GROUP BY tanggal_piutang ");
        return $query->row_array();
    }

    public function m_get_hutang()
    {
        $query = $this->db->query("SELECT SUM(nominal_hutang) AS total_hutang FROM hutang WHERE tanggal_hutang = DATE(now()) AND status = 'belum' ");
        return $query->row_array();
    }

    /* Harian By */
    public function m_get_pembelian_by_hari($hari)
    {
        $this->db->select('SUM(harga_beli) AS total_pembelian')->from('pembelian')->like('tanggal', $hari);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_penjualan_by_hari($hari)
    {
        $this->db->select('SUM(harga_jual) AS total_penjualan')->from('penjualan')->like('tanggal', $hari);
        $data= $this->db->get()->row_array();
        return $data;
    }

    public function m_get_penggajian_by_hari($hari)
    {
        $this->db->select('SUM(gaji_pokok+bon+bonus) AS total_penggajian')->from('gaji')->like('tanggal', $hari);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_pengeluaran_by_hari($hari)
    {
        $this->db->select('SUM(nominal) AS total_pengeluaran')->from('pengeluaran')->like('tanggal', $hari);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_piutang_by_hari($hari)
    {
        $this->db->select('SUM(nominal_piutang) AS total_piutang')->from('piutang')->like('tanggal_piutang', $hari);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_hutang_by_hari($hari)
    {
        $this->db->select('SUM(nominal_hutang) AS total_hutang')->from('hutang')->like('tanggal_hutang', $hari);
        $data= $this->db->get()->row_array();
        return $data;
    }
    /* Bulanan */
    public function m_get_pembelian_bulanan()
    {
        $query = $this->db->query("SELECT SUM(harga_beli) AS total_pembelian FROM pembelian WHERE MONTHNAME(tanggal) = MONTHNAME(now())");
        return $query->row_array();
    }

    public function m_get_penjualan_bulanan()
    {
        $query = $this->db->query("SELECT SUM(harga_jual) AS total_penjualan FROM penjualan WHERE MONTHNAME(tanggal) = MONTHNAME(now())");
        return $query->row_array();
    }

    public function m_get_penggajian_bulanan()
    {
        $query = $this->db->query("SELECT SUM(gaji_pokok+bon+bonus) AS total_penggajian FROM gaji WHERE MONTHNAME(tanggal) = MONTHNAME(now())");
        return $query->row_array();
    }

    public function m_get_pengeluaran_bulanan()
    {
        $query = $this->db->query("SELECT SUM(nominal) AS total_pengeluaran FROM pengeluaran WHERE MONTHNAME(tanggal) = MONTHNAME(now())");
        return $query->row_array();
    }

    public function m_get_piutang_bulanan()
    {
        $query = $this->db->query("SELECT SUM(nominal_piutang) AS total_piutang FROM piutang WHERE MONTHNAME(tanggal_piutang) = MONTHNAME(now()) AND status = 'belum' ");
        return $query->row_array();
    }

    public function m_get_hutang_bulanan()
    {
        $query = $this->db->query("SELECT SUM(nominal_hutang) AS total_hutang FROM hutang WHERE MONTHNAME(tanggal_hutang) = MONTHNAME(now()) AND status = 'belum' ");
        return $query->row_array();
    }

    /* Bulanan BY */
    public function m_get_pembelian_bulanan_by($format)
    {
        $this->db->select('SUM(harga_beli) AS total_pembelian')->from('pembelian')->like('tanggal', $format);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_penjualan_bulanan_by($format)
    {
        $this->db->select('SUM(harga_jual) AS total_penjualan')->from('penjualan')->like('tanggal', $format);
        $data= $this->db->get()->row_array();
        return $data;
    }

    public function m_get_penggajian_bulanan_by($format)
    {
        $this->db->select('SUM(gaji_pokok+bon+bonus) AS total_penggajian')->from('gaji')->like('tanggal', $format);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_pengeluaran_bulanan_by($format)
    {
        $this->db->select('SUM(nominal) AS total_pengeluaran')->from('pengeluaran')->like('tanggal', $format);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_piutang_bulanan_by($format)
    {
        $this->db->select('SUM(nominal_piutang) AS total_piutang')->from('piutang')->like('tanggal_piutang', $format);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function m_get_hutang_bulanan_by($format)
    {
        $this->db->select('SUM(nominal_hutang) AS total_hutang')->from('hutang')->like('tanggal_hutang', $format);
        $data= $this->db->get()->row_array();
        return $data;

    }

}