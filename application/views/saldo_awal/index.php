<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url(); ?>saldo_awal">Saldo Awal</a>
        </li>
    </ol>
    <?= $this->session->flashdata('message'); ?>
    <div class="card mb-3">
        <div class="card-header">
            Saldo Awal
            <?php echo anchor('saldo_awal/add','Tambah Saldo Awal',array('class'=>'btn btn-success pull-right')) ?>
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
							<th>Nominal </th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach($saldo_awal as $sa):
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $sa['tanggal'];?></td>
                                <td><?php echo number_format($sa['nominal'],0,'.','.');?></td>
                                <td><?php echo $sa['keterangan'];?></td>
                                <td class="text-center">
                                    <a href="<?php echo base_url();?>saldo_awal/edit/<?php echo $sa['id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>&nbsp;
                                    <button class="btn btn-sm btn-danger" onclick="hapusSaldoAwal(<?php echo $sa['id']; ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php 
                            $i++;
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
