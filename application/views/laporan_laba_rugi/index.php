<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>Laporan_laba_rugi">Laporan Laba Rugi</a>
        </li>
    </ol>
    <div class="card mb-3">
    <div class="card-header bg-primary text-white">
    LAPORAN LABA RUGI <a href="<?php echo base_url();?>laporan_penjualan/export" class="btn btn-success btn-sm float-right mr-3 mb-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>
    </div>
        <div class="card-body table-responsive">
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pembelian</th>
                            <th>Penjualan</th>
                            <th>Pengeluaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
