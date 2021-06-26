<div class="card-body">
    <div class="alert alert-light-primary">
        <h4 class="alert-heading">Data Pemasukan Toko</h4>
        <p>Pada tabel di bawah merupakan data barang yang tersedia dalam toko.</p>
        <hr>
        <?php echo anchor('pemasukan/tambah', 'Tambah pemasukan', array('class' => 'btn btn-success pull-right')) ?>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis pemasukan</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach ($pemasukan as $item) : ?>
                    <?php $nominal = str_replace('.', '', $item->nominal) ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $item->tanggal ?></td>
                        <td><?php echo $item->jenis_pemasukan ?></td>
                        <td><?php echo "Rp." . number_format($nominal, 0, '.', '.') . ",-" ?></td>
                        <td><?php echo $item->keterangan ?></td>
                        <td class="d-inline-flex">
                            <a href="<?php echo site_url('pemasukan/edit/' . $item->id_pemasukan) ?>" class="btn btn-sm btn-primary"> <span>EDIT</span></a>&nbsp;
                            <!-- <?php echo form_open('pemasukan/hapus/' . $item->id_pemasukan) ?> -->
                            <button type="button" class="btn btn-sm btn-danger" onclick="hapusPemasukan(<?php echo $item->id_pemasukan; ?>)"><span>HAPUS</span></button>
                            <!-- <?php echo form_close() ?> -->
                        </td>
                    </tr>
                    <?php $no++ ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr></tr>
            </tfoot>
        </table>
    </div>
</div>