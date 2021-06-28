<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>service">Service</a>
        </li>
        <li class="breadcrumb-item active">Tambah Data Service</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Tambah Data Service
                </div>
                <?php echo form_open('service/store') ?>
                <div class="card-body row px-0">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="text" id="tanggal_masuk" class="form-control datepicker" name="tanggal_masuk" required="" placeholder="Masukkan Tanggal Masuk">
                            </div>
                            <div class="col-lg-6">
                                <label for="tanggal_jadi">Estimasi Tanggal Jadi</label>
                                <input type="text" class="form-control datepicker" name="tanggal_jadi" id="tanggal_jadi" required="" placeholder="Masukkan Estimasi Jadi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_teknisi">Nama Teknisi</label>
                            <input type="text" class="form-control" id="nama_teknisi" placeholder="Masukkan Nama Teknisi" value="<?php echo $this->session->userdata('nama');?>" readonly="">
                            <input type="hidden" name="id_teknisi" value="<?php echo $this->session->userdata('id_user');?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_customer">Nama Customer</label>
                            <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="Masukkan Nama Customer" required="">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" cols="20" class="form-control" id="alamat" placeholder="Masukkan Alamat Customer" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_tlpn">Nomor Telepon</label>
                            <input type="text" name="no_tlpn" id="no_tlpn" class="form-control" maxlength="15" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Masukkan Nomor Customer" required="">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" required="" placeholder="Masukkan Nama Barang" autofocus>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="tipe">Tipe</label>
                                <input type="text" class="form-control" name="tipe" id="tipe" required="" placeholder="Masukkan Tipe Barang" autofocus>
                            </div>
                            <div class="col form-group">
                                <label for="imei">Imei/SN</label>
                                <input type="text" class="form-control" name="imei" id="imei" required="" placeholder="Masukkan Nomor IMEI">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelengkapan">Kelengkapan</label>
                            <textarea name="kelengkapan" id="kelengkapan" cols="30" class="form-control" placeholder="Batterai, Charger,SIM Card,.." required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keluhan">Keluhan</label>
                            <textarea name="keluhan" id="keluhan" cols="30" class="form-control" placeholder="Masukkan Keluhan" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" class="form-control" placeholder="Masukkan Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-success btn-block my-3" id="tambahHW" onclick="addHW()">Tambah Part Hardware</a>
                        <div id="hardware" style="height: 300px;overflow:auto; ">
                            <div id="hapusHW_1"  class="border border-bottom pt-3">
                                <div class="form-group">
                                    <label for="part_hw">Nama Part Hardware</label>
                                    <input type="text" class="form-control" name="part_hw[]" id="part_hw" placeholder="Masukkan Nama Hardware">
                                </div>
                                <div class="form-group">
                                    <label for="harga_part_hw">Harga Part Hardware</label>
                                    <input type="text" class="form-control uang" name="harga_part_hw[]" id="harga_part_hw" placeholder="Masukkan Harga">
                                </div>
                                <div>
                                    <button class="btn-danger btn-sm btn-block" type="button" onclick="deleteHW(1)">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-success btn-block my-3" id="tambahSW" onclick="addSW()">Tambah Part Software</a>
                        <div id="software" style="height: 300px;overflow:auto; ">
                            <div id="hapusSW_1"  class="border border-bottom pt-3">
                                <div class="form-group">
                                    <label for="part_sw">Nama Part Software</label>
                                    <input type="text" class="form-control" name="part_sw[]" id="part_sw" placeholder="Masukkan Nama Software">
                                </div>
                                <div class="form-group">
                                    <label for="harga_part_sw">Harga Part SoftWare</label>
                                    <input type="text" class="form-control uang" name="harga_part_sw[]" id="harga_part_sw" placeholder="Masukkan Harga">
                                </div>
                                <div>
                                    <button class="btn-danger btn-sm btn-block" type="button" onclick="deleteSW(1)">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent px-0">
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