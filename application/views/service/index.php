<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-service-tab" data-toggle="tab" href="#nav-service" role="tab" aria-controls="nav-service" aria-selected="true">Data Service</a>
            <a class="nav-item nav-link" id="nav-part-tab" data-toggle="tab" href="#nav-part" role="tab" aria-controls="nav-part" aria-selected="false">Data Sparepart</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab">
            <div class="card mb-3">
                <div class="card-body table-responsive px-0">
                    <div class="card-body px-0">
                        <div class="alert alert-light-primary">
                            <?php echo anchor('service/create', 'Tambah Service', array('class' => 'btn btn-primary btn-sm')) ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Konsumen</th>
                                    <th>Alamat</th>
                                    <th>Nomor Tlpn</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Estimasi Jadi</th>
                                    <th>Status</th>
                                    <th>Keluhan</th>
                                    <th>Biaya Service</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $i = 0; ?>
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
                                        <td><?php echo date('d-m-Y',strtotime($item['tanggal_masuk'])) ?></td>
                                        <td><?php echo date('d-m-Y',strtotime($item['tanggal_jadi'])) ?></td>
                                        <td><?php echo $item['status'] ?></td>
                                        <td><?php echo $item['keluhan'] ?></td>
                                        <td><?php echo number_format($total, 0, '.', '.') ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Aksi</span>
                                                </button>
                                                <div class="dropdown-menu bg-light-primary text-dark">
                                                    <a class="dropdown-item" href="<?php echo base_url(); ?>service/edit/<?php echo $item['id_service']; ?>" title="edit"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                                    <?php if ($this->session->userdata('level') == "admin") : ?>
                                                        <a class="dropdown-item" href="#" onclick="hapusService(<?php echo $item['id_service']; ?>)" title="hapus"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                    $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-part" role="tabpanel" aria-labelledby="nav-part-tab">
            <div class="card mb-3">
                <div class="card-body table-responsive px-0">
                    <div class="alert alert-light-primary">
                        <?php echo anchor('service/add_part', 'Tambah Part', array('class' => 'btn btn-primary  btn-sm')) ?>
                    </div>
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
                                $i = 1;
                                foreach ($part as $parts) :
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $parts['nama_part']; ?></td>
                                        <td><?php echo $parts['penjual']; ?></td>
                                        <td><?php echo number_format($parts['harga'], 0, '.', '.'); ?></td>
                                        <td><?php echo $parts['tanggal']; ?></td>
                                        <td><?php echo $parts['nama']; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url(); ?>service/edit_part/<?php echo $parts['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger" onclick="hapusPart(<?php echo $parts['id']; ?>)">Hapus</button>
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