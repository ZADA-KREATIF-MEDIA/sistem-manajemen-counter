<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">service</a>
        </li>
        <li class="breadcrumb-item active">Data service</li>
    </ol>
    <?= $this->session->flashdata('message'); ?>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-service-tab" data-toggle="tab" href="#nav-service" role="tab" aria-controls="nav-service" aria-selected="true">Service</a>
            <a class="nav-item nav-link" id="nav-part-tab" data-toggle="tab" href="#nav-part" role="tab" aria-controls="nav-part" aria-selected="false">Part</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab">
            <div class="card mb-3">
                <div class="card-header">
                DATA SERVICE
                    <?php echo anchor('service/create','Tambah service',array('class'=>'btn btn-primary pull-right')) ?>
                    <a href="<?php echo base_url();?>service/export_service" class="btn btn-success float-right mr-3 mb-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                </div>
                <div class="card-body table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Konsumen</th>
                                    <th>Alamat</th>
                                    <th>Nomor Tlpn</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Estimasi Jadi</th>
                                    <th>Status</th>
                                    <th>Biaya Service</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; $i=0; ?>
                            <?php foreach ($service as $item) : ?>
                                <?php 
                                    $biaya_hw = $biaya['biaya_part'][$i]->biaya_hardware;
                                    $biaya_sw = $biaya['biaya_software'][$i]->biaya_software;
                                    $total = $biaya_hw + $biaya_sw;
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $item['nama_customer'] ?></td>
                                    <td><?php echo $item['alamat'] ?></td>
                                    <td><?php echo $item['no_telpn'] ?></td>
                                    <td><?php echo $item['tanggal_masuk'] ?></td>
                                    <td><?php echo $item['tanggal_jadi'] ?></td>
                                    <td><?php echo $item['status'] ?></td>
                                    <td><?php echo number_format($total,0,'.','.') ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info"><i class="fa fa-cog"></i></button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>service/edit/<?php echo $item['id_service']; ?>" title="edit"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                                <a href="#" class="dropdown-item" onclick="ubahStatus(<?php echo $item['id_service']; ?>)" ><i class="fa fa-exchange"></i>&nbsp;Ubah Status</a>
                                                <?php if($this->session->userdata('level') == "admin"):?>
                                                    <a class="dropdown-item" href="#" onclick="hapusService(<?php echo $item['id_service']; ?>)" title="hapus"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <!-- <a href="<?php echo base_url(); ?>service/edit/<?php echo $item->id_service; ?>" class="btn btn-info" title="Edit"><i class="fa fa-edit"></i></a> -->
                                        <!-- <a href="<?php echo base_url(); ?>service/show/<?php echo $item->id_service; ?>" class="btn btn-dark" title="Detail"><i class="fa fa-eye"></i></a> -->
                                        <!-- <a href="#" class="btn btn-danger" onclick="alertHapus(<?php echo $item->id_service; ?>)" title="Hapus"><i class="fa fa-trash"></i></a> -->
                                    </td>
                                </tr>
                                <?php $no++; $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-part" role="tabpanel" aria-labelledby="nav-part-tab">
            <div class="card mb-3">
                <div class="card-header">
                DATA PART
                    <?php echo anchor('service/add_part','Tambah Part',array('class'=>'btn btn-primary pull-right')) ?>
                    <a href="<?php echo base_url();?>service/export_part" class="btn btn-success float-right mr-3 mb-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                </div>
                <div class="card-body table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Part</th>
                                    <th>Penjual</th>
                                    <th>Harga</th>
                                    <th>Tanggal Beli</th>
                                    <th>Teknisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>    
                                <?php 
                                    $i=1;
                                    foreach($part as $parts):
                                ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $parts['nama_part'];?></td>
                                        <td><?php echo $parts['penjual'];?></td>
                                        <td><?php echo number_format($parts['harga'],0,'.','.');?></td>
                                        <td><?php echo $parts['tanggal'];?></td>
                                        <td><?php echo $parts['nama'];?></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url();?>service/edit_part/<?php echo $parts['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" onclick="hapusPart(<?php echo $parts['id']; ?>)"><i class="fa fa-trash"></i></button>
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
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    function ubahStatus(id)
    {
        console.log(id);
        Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Akan menghapus status menjadi sedang dikerjakan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText : 'Tidak'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                url     : "<?php echo base_url('service/ubah_status_pengerjaan'); ?>",
                method  : "POST",
                data    : {id_customer : id},
                success:function(res){
                    // console.log(res)
                    Swal.fire(
                        'Success!',
                        'Status berhasil diubah.',
                        'success'
                    );
                    location.reload();
                }
            })
        }
        })
    }
</script>
