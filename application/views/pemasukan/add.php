<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>pemasukan">Pemasukan</a>
        </li>
        <li class="breadcrumb-item active">Tambah Data pemasukan</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-danger">
                    Tambah Data pemasukan
                </div>
                <?php echo form_open('pemasukan/tambah') ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="foto">Tanggal</label>
                        <input type="text" name="tanggal" class="form-control datepicker" requred="">
                    </div>
                    <div class="form-group">
                        <label for="nama_bencana">Jenis pemasukan</label>
                        <input type="text" class="form-control" name="jenis_pemasukan" required="">
                    </div>
                    <div class="form-group">
                        <label for="foto">Nominal pemasukan</label>
                        <input type="text" name="nominal" class="form-control uang" requred="">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <button type="submit" name="submit" class="btn btn-success">
                        Simpan
                    </button>
                    <a href="<?php echo site_url('pemasukan') ?>" class="btn btn-primary">Kembali</a>
                </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>