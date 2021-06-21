<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>Laporan_penjualan">laporan</a>
        </li>
        <li class="breadcrumb-item active">Edit Laporan Penjualan</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            Edit Detail Transaksi
        </div>
        <?php echo form_open('Laporan_penjualan/upgrade') ?>
        <div class="card-body table-responsive">
            <input type="hidden" name="imei" value="<?php echo $detail['imei']; ?>">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?php echo $detail['nama_barang']; ?>" required="">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="10" class="form-control"><?php echo $detail['keterangan']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="nama_customer">Nama Customer</label>
                <input type="text" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $detail['nama_customer']; ?>" required="">
            </div>
            <div class="form-group">
                <label for="id_user">Nama Petugas</label>
                <select name="id_user" id="id_user" class="form-control">
                    <?php foreach( $user as $users):?>

                        <option value="<?php echo $users['id_user']; ?>" <?php if($users['id_user']==$detail['id_user']){ echo "selected"; }?>><?php echo $users['nama']; ?></option>

                        <option value="<?php echo $users['id_user']; ?>"><?php echo $users['nama']; ?></option>

                    <?php endforeach;?>
                </select>
                <!-- <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" value="<?php echo $detail['nama_petugas']; ?>" required=""> -->
            </div>
            <div class="form-group">
                <label for="metode_bayar">Metode Pembayaran</label>
                <select name="metode_bayar" id="metode_bayar" class="form-control" required>
                    <option value="cash" <?php if($detail['metode_bayar'] == "cash"){ echo "selected"; }?>>Cash</option>
                    <option value="transfer" <?php if($detail['metode_bayar'] == "transfer"){ echo "selected"; }?>>Transfer</option>
                </select>
            </div>
            <div class="row">
                <div class="col-6 form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="text" class="form-control uang" name="harga_beli" id="harga_beli" value="<?php echo number_format( $detail['harga_beli'],0,'.','.'); ?>" required="">
                </div>
                <div class="col-6 form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" class="form-control uang" name="harga_jual" id="harga_jual" value="<?php echo number_format($detail['harga_jual'],0,'.','.'); ?>" required="">
                </div>
            </div>
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Tanggal Transaksi   : <?php echo $detail['tanggal']; ?></li>
                </ul>
            </div>
            <div class="form-group pt-3">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="<?php echo base_url() ?>laporan_penjualan" class="btn btn-dark">Kembali</a>
            </div>
        </div>
        <?php echo form_close()?>
    </div>
</div>
