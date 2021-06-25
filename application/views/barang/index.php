<div class="card-body">
    <div class="alert alert-success">
        <h4 class="alert-heading">Data Barang/Smartphone</h4>
        <p>Pada tabel di bawah merupakan data barang yang tersedia dalam toko.</p>
    </div>
</div>

<div class="card mb-3">
  
    <div class="card-body table-responsive">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>IMEI/SN</th>
                        <th>Harga Beli</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($barang as $item) : ?>
                        <?php $harga_beli = str_replace('.', '', $item->harga_beli) ?>
                        <?php $harga_jual = str_replace('.', '', $item->harga_jual) ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $item->nama_barang ?></td>
                            <td><?php echo $item->imei ?></td>
                            <td><?php echo "Rp " . number_format($harga_beli, 0, '.', '.') . ",-" ?></td>
                            <?php if ($item->status == "tmp") : ?>
                                <td>Keranjang Transaksi</td>
                            <?php else : ?>
                                <td>Stock</td>
                            <?php endif; ?>
                            <td class="d-flex text-center">
                                <a href="<?php echo site_url('Barang/edit/' . $item->imei) ?>" class="btn btn-sm btn-primary">
                                    <span>EDIT</span>
                                </a>&nbsp;
                                <!-- <?php echo form_open('Barang/hapus/' . $item->imei) ?> -->
                                <button type="submit" class="btn btn-sm btn-danger" onclick="hapusBarang(<?php echo $item->imei; ?>)">
                                    <span>HAPUS</span>
                                </button>
                                <!-- <?php echo form_close() ?> -->
                                &nbsp;
                                <?php if (($item->status == "tmp") && ($this->session->userdata('level') == "admin")) : ?>
                                    <button type="button" class="btn btn-sm btn-success" onclick="ubahInStock(<?php echo $item->imei; ?>)">
                                        <span>UBAH STATUS</span> </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $no++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>