<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>service">Service</a>
        </li>
        <li class="breadcrumb-item active">Tambah Data Part</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Tambah Data Part
                </div>
                <?php echo form_open('service/store_part') ?>
                <div class="p-3 row">
                    <div class="form-group col-12 col-lg-6">
                        <label for="nama_part">Nama Part</label>
                        <input type="text" class="form-control" id="nama_part" name="nama_part" required="" placeholder="Masukkan nama part">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="penjual">Nama Penjual</label>
                        <input type="text" class="form-control" id="penjual" name="penjual" required="" placeholder="Masukkan nama penjual">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="harga">Harga Part</label>
                        <input type="text" class="form-control uang" id="harga" name="harga" required="" placeholder="Masukkan harga">
                    </div>
                    <div class="form-group col-12 col-lg-3">
                        <label for="tanggal">Tanggal Beli</label>
                        <input type="text" class="form-control datepicker" id="tanggal" name="tanggal" required="" placeholder="Masukkan tanggal">
                    </div>
                    <div class="form-group col-12 col-lg-3">
                        <label for="teknisi">Teknisi</label>
                        <input type="text" class="form-control datepicker" id="teknisi" value="<?php echo $this->session->userdata('nama'); ?>" readonly="">
                    </div>
                    <div class="form-group col-12">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" class="form-control" placeholder="Masukkan Keterangan"></textarea>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <input type="hidden" name="id_teknisi" value="<?php echo $this->session->userdata('id_user');?>">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="<?php echo site_url('service') ?>" class="btn btn-danger">Kembali</a>
                </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>