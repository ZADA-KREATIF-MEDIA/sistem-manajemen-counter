<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url(); ?>gaji">Gaji</a>
        </li>
        <li class="breadcrumb-item active">Data Gaji Karyawan </li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            Gaji
            <?php echo anchor('gaji/tambah','Tambah Gaji',array('class'=>'btn btn-success pull-right')) ?>
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
							<th>Nama </th>
                            <th>Gaji Pokok</th>
                            <th>Bonus</th>
                            <th>Kas Bon</th>
                            <th>Total Bayar</th>
                            <th>status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1 ?>
                    <?php foreach ($gaji as $item) : ?>
                    <?php $gaji_pokok=str_replace('.','',$item->gaji_pokok) ?>
                    <?php $bonus=str_replace('.','',$item->bonus) ?>
                    <?php $bon=str_replace('.','',$item->bon) ?>
                    <?php 
                    $total=($gaji_pokok+$bonus)-$bon;
                    $total=str_replace('.','',$total)
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $item->tanggal ?></td>
                            <td><?php echo $item->nama ?></td>
                            <td><?php echo "Rp.".number_format($gaji_pokok,0,'.','.').",-" ?></td>
                            <td><?php echo "Rp.".number_format($bonus,0,'.','.').",-" ?></td>
                            <td><?php echo "Rp.".number_format($bon,0,'.','.').",-" ?></td>
                            <td><?php echo "Rp.".number_format($total,0,'.','.').",-" ?></td>
                            <td><?php echo $item->status ?></td>
                            <td><?php echo $item->keterangan ?></td>
                            <td class="d-inline-flex">
                                <a href="<?php echo site_url('gaji/edit/'.$item->id_gaji) ?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <?php echo form_open('gaji/hapus/'.$item->id_gaji) ?>
                                <button type="button" class="btn btn-sm btn-danger" onclick="hapusGaji(<?php echo $item->id_gaji; ?>)">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <?php echo form_close() ?>
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
