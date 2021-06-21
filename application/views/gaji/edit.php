<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>gaji">gaji</a>
        </li>
        <li class="breadcrumb-item active">Edit Data gaji</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Edit Data gaji
                </div>
                <?php echo form_open('gaji/edit') ?>
                    <?php echo form_hidden('id_gaji',$gaji['id_gaji']) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" value="<?php echo $gaji['tanggal'] ?>" class="form-control" name="tanggal" readOnly>
                        </div>
                        <div class="form-group">
                                <label>Karyawan</label>
                            <input type="text" value="<?php echo $gaji['nama'] ?>" class="form-control" name="tanggal" readOnly >
                        </div>
                        <div class="form-group">
                            <label for="nama_bencana">Gaji Pokok</label>
                            <input type="text" value="<?php echo $gaji['gaji_pokok'] ?>" class="form-control uang" name="gaji_pokok" required="">
                        </div>
                        <div class="form-group">
                            <label for="foto">Bonus </label>
                            <input type="text" value="<?php echo $gaji['bonus'] ?>"  name="bonus" class="form-control uang" requred="">
                        </div>
                        <div class="form-group">
                            <label for="foto">Kas Bon</label>
                            <input type="text" value="<?php echo $gaji['bon'] ?>"  name="bon" class="form-control uang" requred="">
                        </div>
                        <div class="form-group" >
                            <label for="status">Status Pembayaran</label>
                            <select name="status" id="status" class="form-control">
                                <option value="belum bayar" <?php if($gaji['status'] == "belum bayar"){ echo "selected"; }?>>Belum Bayar</option>
                                <option value="dibayar" <?php if($gaji['status'] == "dibayar"){ echo "selected"; }?>>Dibayar</option>
                                <option value="tertunda" <?php if($gaji['status'] == "tertunda"){ echo"selected"; }?>>Tertunda</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" cols="30" rows="10" class="form-control"><?php echo $gaji['keterangan'] ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button type="submit" name="submit" class="btn btn-success">
                            Simpan
                        </button>
                        <a href="<?php echo site_url('gaji') ?>" class="btn btn-primary">Kembali</a>
                    </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>