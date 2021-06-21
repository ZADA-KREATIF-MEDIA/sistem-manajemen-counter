<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>pengeluaran">Pengeluaran</a>
        </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            Pengeluaran
            <?php echo anchor('pengeluaran/tambah','Tambah Pengeluaran',array('class'=>'btn btn-success pull-right')) ?>
        </div>
        <div class="card-body table-responsive">
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
                                <a href="<?php echo site_url('Pengeluaran/edit/'.$item->id_pengeluaran) ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="hapusPengeluaran(<?php echo $item->id_pengeluaran; ?>)"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
