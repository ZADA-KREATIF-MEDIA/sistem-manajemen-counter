<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>saldo awal">Saldo Awal</a>
        </li>
        <li class="breadcrumb-item active">Edit Data Saldo Awal</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-info">
                    Edit Data Saldo Awal
                </div>
                <?php echo form_open('saldo_awal/update') ?>
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" name="tanggal" class="form-control datepicker" id="tanggal" required="" placeholder="Masukkan Tanggal" value="<?php echo $detail['tanggal']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal pemasukan</label>
                        <input type="text" name="nominal" class="form-control uang" id="nominal" required="" placeholder="Masukkan nominal saldo awal" value="<?php echo number_format($detail['nominal'],0,'.','.');?>">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" required="" placeholder="Masukkan keterangan saldo awal" value="<?php echo $detail['keterangan'];?>">
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