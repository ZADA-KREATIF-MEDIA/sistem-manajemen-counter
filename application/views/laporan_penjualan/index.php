<div class="card-body">
    <div class="alert alert-light-primary">
        <h4 class="alert-heading">Data Penjualan Barang/Smartphone</h4>
        <p>Pada tabel di bawah merupakan data barang yang tersedia dalam toko.</p>
        <hr>
        <a href="<?php echo base_url(); ?>laporan_penjualan/export" class="btn btn-success btn-sm float-right mr-3 mb-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>
    </div>
</div>



<div class="card-body">

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Konsumen</th>
                    <th>Nama Barang</th>
                    <th>IMEI</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Nama Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                $total = 0;
                $beli = 0; ?>
                <?php foreach ($laporan as $item) : ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $item->tanggal ?></td>
                        <td><?php echo $item->nama_customer ?></td>
                        <td><?php echo $item->nama_barang; ?></td>
                        <td><?php echo $item->imei ?></td>
                        <td><?php echo number_format($item->harga_beli, 0, '.', '.') ?></td>
                        <td><?php echo number_format($item->harga_jual, 0, '.', '.') ?></td>
                        <td><?php echo $item->nama ?></td>
                        <td class="text-center">
                            <a href="<?php echo base_url() ?>laporan_penjualan/show_detail/<?php echo $item->imei; ?>" class="btn btn-dark btn-sm"><span>DETAIL</span></a><br>
                            <?php if ($this->session->userdata('level') == "admin") : ?>
                                <a href="<?php echo base_url() ?>laporan_penjualan/edit_detail/<?php echo $item->imei; ?>" class="btn btn-info btn-sm"><span>EDIT</span></a><br>
                                <button class="btn btn-danger btn-sm" onclick="hapusLaporanPenjualan('<?php echo $item->id_penjualan; ?>')"><span>HAPUS</span></button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $no++;
                    $total += $item->harga_jual;
                    $beli += $item->harga_beli;
                    ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <h6>Total Penjualan Rp. <?= number_format($total, 0, '.', '.') ?></h6>
                    </td>
                    <td colspan="3">
                        <h6>Total Pembelian Rp. <?= number_format($beli, 0, '.', '.') ?></h6>
                    </td>
                    <td colspan="4">
                        <h6>(Penjualan - Pembelian) Rp. <?= number_format($total - $beli, 0, '.', '.') ?></h6>
                    </td>
                </tr>

            </tfoot>
        </table>
    </div>
</div>