<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>service">Service</a>
        </li>
        <li class="breadcrumb-item active">Detail Data Service</li>
    </ol>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Detail Data Service
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nama">Nama</label>
                            <input id="nama" class="form-control" value="<?php echo $detail->nama_customer; ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_telp">Nomor Telephone</label>
                            <input id="no_telp" class="form-control" value="<?php echo $detail->no_tlpn; ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tgl_in">Tanggal Masuk</label>
                            <input id="tgl_in" class="form-control" value="<?php echo date("d-m-Y", strtotime($detail->tanggal_masuk)); ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tgl_finish">Tanggal Jadi</label>
                            <input id="tgl_finish" class="form-control" value="<?php echo date("d-m-Y", strtotime($detail->tanggal_jadi)); ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tgl_take">Tanggal Diambil</label>
                            <input id="tgl_take" class="form-control" readonly>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipe Barang</th>
                                <th>Imei SN</th>
                                <th>Kelengkapan</th>
                                <th>Biaya Software</th>
                                <th>Biaya Hardware</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($service as $val):?>
                            <tr>
                                <td><?php echo $val['tipe_barang']; ?></td>
                                <td><?php echo $val['imei_sn']; ?></td>
                                <td><?php echo $val['kelengkapan']; ?></td>
                                <td><?php echo number_format($val['biaya_software'],0,'.','.'); ?></td>
                                <td><?php echo number_format($val['biaya_hardware'],0,'.','.'); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-transparent">
                    <!-- <button type="submit" name="submit" class="btn btn-primary">
                        Submit
                    </button> -->
                    <a href="<?php echo base_url(''); ?>service/print/<?php echo $detail->id_service; ?>" class="btn btn-success" title="print"><i class="fa fa-print"></i>&nbsp;Print</a>
                    <a href="<?php echo site_url('Service') ?>" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var id = 1;
	
</script>