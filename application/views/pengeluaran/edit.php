<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url() ?>pengeluaran">Pengeluaran</a>
        </li>
        <li class="breadcrumb-item active">Edit Data Pengeluaran</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Edit Data Pengeluaran
                </div>
                <?php echo form_open('Pengeluaran/edit') ?>
                    <?php echo form_hidden('id_pengeluaran',$pengeluaran['id_pengeluaran']) ?>
			        <div class="card-body">
                        <div class="form-group">
                            <label for="nama_bencana">Tanggal</label>
                            <input type="text" value="<?php echo $pengeluaran['tanggal'] ?>" class="form-control datepicker" name="tanggal" required="" >
                        </div>
                        <div class="form-group">
                            <label for="nama_bencana">Jenis Pengeluaran</label>
                            <input type="text" value="<?php echo $pengeluaran['jenis_pengeluaran'] ?>" class="form-control" name="jenis_pengeluaran" required="">
                        </div>
                        <div class="form-group">
                            <label for="foto">Nominal Pengeluaran</label>
                            <input type="text" value="<?php echo $pengeluaran['nominal'] ?>"  name="nominal" class="form-control uang" requred="">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" cols="30" rows="10" class="form-control"><?php echo $pengeluaran['keterangan'] ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button type="submit" name="submit" class="btn btn-success">
                            Simpan
                        </button>
                        <a href="<?php echo site_url('Pengeluaran') ?>" class="btn btn-primary">Kembali</a>
                    </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>