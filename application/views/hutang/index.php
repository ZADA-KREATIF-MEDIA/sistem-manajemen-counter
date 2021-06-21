<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url(); ?>hutang">Hutang</a>
        </li>
    </ol>
    <?= $this->session->flashdata('message'); ?>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Hutang</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Transaksi Hutang</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card mb-3">
                <div class="card-header">
                    Hutang
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalBayarHutang">Bayar Hutang</button>
                </div>
                <div class="card-body table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nota</th>
                                    <th>Nominal </th>
                                    <th>Terbayarkan</th>
                                    <th>Tanggal Hutang</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=1; 
                                foreach($hutang as $hutangs):
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $hutangs['nota_hutang']; ?></td>
                                    <td>Rp&nbsp;<?php echo number_format($hutangs['nominal_hutang'],0,'.','.');?></td>
                                    <td>Rp&nbsp;<?php echo number_format($hutangs['nominal_terbayar'],0,'.','.');?></td>
                                    <td><?php echo $hutangs['tanggal_hutang'];?></td>
                                    <td><?php echo $hutangs['tanggal_jatuh_tempo'];?></td>
                                    <?php if($hutangs['status']=="belum"):?>
                                        <td class="bg-danger text-white">Belum Lunas</td>
                                    <?php else:?>
                                        <td class="bg-success text-white">Lunas</td>
                                    <?php endif;?>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm" onclick="restartHutang(<?php echo $hutangs['id_pembelian']; ?>)"><i class="fa fa-trash"></i></button>
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
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="card mb-3">
                <div class="card-header">
                    Transaksi Hutang
                </div>
                <div class="card-body table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nota</th>
                                    <th>Nominal </th>
                                    <th>Tanggal Bayar</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $i=1;
                                foreach($hutang_transaksi as $item):
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $item['nota_hutang'];?></td>
                                    <td><?php echo number_format($item['nominal'],0,'.','.');?></td>
                                    <td>Rp&nbsp;<?php echo $item['tanggal_bayar'];?></td>
                                    <td><?php echo $item['keterangan'];?></td>
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
<!-- Modal Bayar Utang -->
<div class="modal fade" id="modalBayarHutang" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Hutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('hutang/update')?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="hutang">Hutang</label>
                    <select name="hutang" id="hutang" class="form-control">
                        <option>--Pilih Hutang--</option>
                        <?php foreach($hutang_bl as $hbl):?>
                            <option value="<?php echo $hbl['id'];?>"><?php echo $hbl['nota_hutang'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah_hutang">Jumlah Hutang</label>
                    <input type="text" class="form-control" id="jumlah_hutang" readonly>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal </label>
                    <input type="text" class="form-control datepicker" id="tanggal">
                </div>
                <div class="form-group">
                    <label for="nominal_bayar">Nominal</label>
                    <input type="text" class="form-control uang" name="nominal_bayar" id="nominal_bayar" placeholder="Masukkan Nominal Yang Akan Dibayarkan" required="">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Misal:Pembayaran Hutang">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
