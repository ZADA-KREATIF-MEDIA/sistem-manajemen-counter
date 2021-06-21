<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>Laporan_penjualan">laporan</a>
        </li>
        <li class="breadcrumb-item active">Detail Laporan Penjualan</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            Detail Transaksi
        </div>
        <div class="card-body table-responsive">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">IMEI                : <?php echo $detail['imei']; ?></li>
                    <li class="list-group-item">Nama Barang         : <?php echo $detail['nama_barang']; ?> </li>
                    <li class="list-group-item">Keterangan          : <?php echo $detail['keterangan']; ?></li>
                    <li class="list-group-item">Nama Customer       : <?php echo $detail['nama_customer']; ?></li>
                    <li class="list-group-item">Nama Petugas        : <?php echo $detail['nama']; ?></li>
                    <li class="list-group-item">Metode Pembayaran   : <?php echo $detail['metode_bayar']; ?></li>
                    <li class="list-group-item">Harga Beli          : <?php echo number_format($detail['harga_beli'],0,'.','.'); ?></li>
                    <li class="list-group-item">Harga Jual          : <?php echo number_format($detail['harga_jual'],0,'.','.'); ?></li>
                    <li class="list-group-item">Tanggal Transaksi   : <?php echo $detail['tanggal']; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
