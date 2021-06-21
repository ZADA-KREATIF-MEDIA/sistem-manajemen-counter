<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url(); ?>gaji">Gaji</a>
        </li>
        <li class="breadcrumb-item active">Tambah Data Gaji</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Tambah Data Gaji Pegawai</strong> 
                </div>
                <?php echo form_open('gaji/tambah') ?>
                    <div class="card-body ">
                        <div class="form-group" >
                            <label for="kode_barang">Pilih Pegawai/Karyawan (Wajib)</label>
                            <select name="id_user" id="id_user" class="form-control" required="">
                                <option> --Pilih Pegawai/Karyawan-- </option>
                                <?php foreach($user as $users): ?>
                                    <option value="<?php echo $users->id_user; ?>"><?php echo $users->nama; ?>-<strong><?php echo $users->level; ?></strong></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gaji_pokok">Gaji Pokok</label>
                            <input type="text" class="form-control uang" name="gaji_pokok" Placeholder="Masukan gaji pokok" required>
                        </div>
                        <div class="form-group">
                            <label for="bon">Kas Bon</label>
                            <input type="text" class="form-control uang" name="bon" Placeholder="Masukan kas bon jika ada">
                        </div>
                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="text" class="form-control uang" name="bonus" Placeholder="Masukan bonus karyawan jika ada" >
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" cols="30" rows="10" class="form-control" Placeholder="Keterangan Tambahan"></textarea>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button type="submit" name="submit" class="btn btn-success">
                            Simpan
                        </button>
                        <a href="<?php echo site_url('pemasukan') ?>" class="btn btn-danger">Kembali</a>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>