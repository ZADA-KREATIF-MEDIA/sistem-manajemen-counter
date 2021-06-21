<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>Laporan_laba_rugi/bulanan">Laporan Bulanan</a>
        </li>
    </ol>
    Bulan&nbsp;:&nbsp;<?php echo $bulan;?>
    <?php echo form_open('laporan_laba_rugi/bulanan');?>
    <div class="col-lg-4 pr-0 input-group mb-3 float-right">
        <select name="bulan" id="bulan" class="form-control">
            <option>---Pilih Bulan---</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        <div class="input-group-append">
            <!-- <span class="input-group-text" id="basic-addon2">@example.com</span> -->
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </div>
    <?php echo form_close();?>
    <br><br><br>
    <div class="card mb-3">
        <div class="card-header">
            Laporan Bulanan
            <button class="btn btn-sm btn-success float-right" onclick="exportExcelBulanan('<?php echo $_SESSION['bulan'];?>')">Export Excel</button>
        </div>
        <div class="card-body table-responsive">
            <div class="row mb-2">
                <div class="col">
                    <span class="float-left">
                        Saldo Awal
                    </span>
                </div>
                <div class="col">
                    <span class="float-right">
                        <?php echo number_format($saldo_awal['nominal'],0,'.','.');?>
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <span class="float-left">
                        Penjualan
                    </span>
                </div>
                <div class="col">
                    <span class="float-right">
                        <?php echo number_format($penjualan['total_penjualan'],0,'.','.');?>
                    </span>
                </div>
            </div>
            <div class="col-12 pr-0 mb-2">
                <span class="float-right">
                    ----------------- +
                </span>
            </div><br>
            <div class="col-12 pr-0">
                <span class="float-right"><?php echo number_format($saldo_awal['nominal']+$penjualan['total_penjualan'],0,'.','.');?></span>
            </div><br>
            <div class="row mb-2">
                <div class="col">
                    <span class="float-left">
                        Piutang
                    </span>
                </div>
                <div class="col">
                    <span class="float-right">
                        <?php echo number_format($piutang['total_piutang'],0,'.','.');?>
                    </span>
                </div>
            </div>
            <div class="col-12 pr-0 mb-2">
                <span class="float-right">
                    ----------------- -
                </span>
            </div><br>
            <div class="row mb-2">
                <div class="col font-weight-bold">
                    <span>
                        Total Pendapatan
                    </span>
                </div>
                <div class="col">
                    <span class="float-right font-weight-bold">
                        <?php echo number_format($saldo_awal['nominal']+$penjualan['total_penjualan']-$piutang['total_piutang'],0,'.','.');?>
                    </span>
                </div>
            </div><br>
            <div class="row mb-2">
                <div class="col">
                    <span class="float-left">
                        Pembelian
                    </span>
                </div>
                <div class="col">
                    <span class="float-right">
                        <?php echo number_format($pembelian['total_pembelian'],0,'.','.');?>
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <span class="float-left">
                        Hutang
                    </span>
                </div>
                <div class="col">
                    <span class="float-right">
                        <?php echo number_format($hutang['total_hutang'],0,'.','.');?>
                    </span>
                </div>
            </div>
            <div class="col-12 pr-0 mb-2">
                <span class="float-right">
                    ----------------- -
                </span>
            </div><br>
            <div class="col-12 pr-0">
                <span class="float-right"><?php echo number_format($pembelian['total_pembelian']-$hutang['total_hutang'],0,'.','.');?></span>
            </div><br>
            <div class="row mb-2">
                <div class="col">
                    <span class="float-left">
                        Penggajian
                    </span>
                </div>
                <div class="col">
                    <span class="float-right">
                        <?php echo number_format($penggajian['total_penggajian'],0,'.','.');?>
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <span class="float-left">
                        Pengeluaran
                    </span>
                </div>
                <div class="col">
                    <span class="float-right">
                        <?php echo number_format($pengeluaran['total_pengeluaran'],0,'.','.');?>
                    </span>
                </div>
            </div>
           
            <div class="col-12 pr-0 mb-2">
                <span class="float-right">
                    ----------------- +
                </span>
            </div><br>
            <div class="row mb-2">
                <div class="col font-weight-bold">
                    <span>
                        Total Pengeluaran
                    </span>
                </div>
                <div class="col">
                    <span class="float-right font-weight-bold">
                        <?php echo number_format($pembelian['total_pembelian']-$hutang['total_hutang']+$penggajian['total_penggajian']+$pengeluaran['total_pengeluaran'],0,'.','.');?>
                    </span>
                </div>
            </div><br>
        </div>
    </div>
</div>