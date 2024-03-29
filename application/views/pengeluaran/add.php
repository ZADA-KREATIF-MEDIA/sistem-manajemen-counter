<div class="card-body">
    <div class="alert alert-light-primary">
        <h4 class="alert-heading">Formulir Data Pengeluaran Toko</h4>
        <hr>
    </div>
    <div class="card-body px-0">
        <?php echo form_open('Pengeluaran/tambah') ?>
        <div class="card-body px-0">
            <div class="form-group">
                <label for="foto">Tanggal</label>
                <input type="text" name="tanggal" class="form-control datepicker" requred="">
            </div>
            <div class="form-group">
                <label for="nama_bencana">Jenis Pengeluaran</label>
                <input type="text" class="form-control" name="jenis_pengeluaran" required="">
            </div>
            <div class="form-group">
                <label for="foto">Nominal Pengeluaran</label>
                <input type="text" name="nominal" class="form-control uang" requred="">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <div class="card-footer bg-transparent px-0">
            <button type="submit" name="submit" class="btn btn-success">
                Simpan
            </button>
            <a href="<?php echo site_url('Pengeluaran') ?>" class="btn btn-danger">Kembali</a>
        </div>
        <?php echo form_close() ?>
    </div>
</div>