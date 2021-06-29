<div class="alert alert-light-primary">
    <h4 class="alert-heading">Formulir Edit Pengeluaran Toko</h4>
    <hr>
</div>
<div class="card">
    <?php echo form_open('pemasukan/edit') ?>
    <?php echo form_hidden('id_pemasukan', $pemasukan['id_pemasukan']) ?>
    <div class="card-body px-0">
        <div class="form-group">
            <label for="nama_bencana">Tanggal</label>
            <input type="text" value="<?php echo $pemasukan['tanggal'] ?>" class="form-control datepicker" name="tanggal" required="">
        </div>
        <div class="form-group">
            <label for="nama_bencana">Jenis pemasukan</label>
            <input type="text" value="<?php echo $pemasukan['jenis_pemasukan'] ?>" class="form-control" name="jenis_pemasukan" required="">
        </div>
        <div class="form-group">
            <label for="foto">Nominal pemasukan</label>
            <input type="text" value="<?php echo $pemasukan['nominal'] ?>" name="nominal" class="form-control uang" requred="">
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control"><?php echo $pemasukan['keterangan'] ?></textarea>
        </div>
    </div>
    <div class="card-footer bg-transparent px-0">
        <button type="submit" name="submit" class="btn btn-success">
            Simpan
        </button>
        <a href="<?php echo site_url('pemasukan') ?>" class="btn btn-danger">Kembali</a>
    </div>
    <?php echo form_close() ?>
</div>