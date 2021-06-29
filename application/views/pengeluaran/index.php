<div class="card-body py-0 px-0">
    <div class="alert alert-light-primary">
        <h4 class="alert-heading">Data Pengeluaran Toko</h4>
        <p>Pada tabel di bawah merupakan data barang yang tersedia dalam toko.</p>
        <hr>
        <?php echo anchor('pengeluaran/tambah','Tambah Pengeluaran',array('class'=>'btn btn-success pull-right')) ?>
    </div>
</div>
<div class="card-body table-responsive px-0">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis pengeluaran</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1 ?>
            <?php foreach ($pengeluaran as $item) : ?>
            <?php $nominal=str_replace('.','',$item->nominal) ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $item->tanggal ?></td>
                    <td><?php echo $item->jenis_pengeluaran ?></td>
                    <td><?php echo "Rp.".number_format($nominal,0,'.','.').",-" ?></td>
                    <td><?php echo $item->keterangan ?></td>
                    <td>
                        <a href="<?php echo site_url('Pengeluaran/edit/'.$item->id_pengeluaran) ?>" class="btn btn-sm btn-primary"><span>EDIT</span>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="hapusPengeluaran(<?php echo $item->id_pengeluaran; ?>)"><span>HAPUS</i></button>
                    </td>
                </tr>
                <?php $no++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
 
