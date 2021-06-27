<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Barang</a>
        </li>
        <li class="breadcrumb-item active">Edit Data Barang</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Edit Data Barang
                </div>
                <?php echo form_open('Barang/edit') ?>
                <?php echo form_hidden('imei',$barang['imei']) ?>
                <div div class="card-body">
                    <div class="form-group">
                        <label for="nama_bencana">IMEI/SN</label>
                    <input type="text" value="<?php echo $barang['imei'] ?>" class="form-control" name="nama_barang" disabled>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" value="<?php echo $barang['nama_barang'] ?>" class="form-control" name="nama_barang" required>
                </div>
                <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="text" id="harga_beli" value="<?php echo $barang['harga_beli'] ?>"  name="harga_beli" class="form-control uang" requred>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control"><?php echo $barang['keterangan'] ?></textarea>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <button type="submit" name="submit" class="btn btn-primary">
                    Submit
                </button>
                <a href="<?php echo site_url('Barang') ?>" class="btn btn-danger">Kembali</a>
            </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>