<div class="container-fluid pt-5 pt-lg-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>transaksi">Transaksi</a>
        </li>
    </ol>
    <div class="card mb-12">
        <div class="card-header">
            <i class="fas fa-list"></i> Transaksi Penjualan
        </div>
        <?php echo form_open('Transaksi/add') ?>
        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_pembeli">Nama Pembeli</label>
                        <input type="text" class="form-control" name="nama_pembeli" id="nama_pembeli" placeholder="Nama Customer" required>
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_telpn">Nomor Telephone</label>
                        <input type="text" class="form-control" name="no_telpn" id="no_telpn" placeholder="Nomor telepon" required>
                    </div>
                </div>
                <div class="col-12">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat"></textarea>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_barang">Nama Barang</label>
                        <select name="kode_barang" id="kode_barang" class="form-control" required="">
                            <option> --Pilih Barang-- </option>
                            <?php foreach($barang as $barangs): ?>
                                <option value="<?php echo $barangs->imei; ?>"><?php echo $barangs->nama_barang; ?>-<strong><?php echo $barangs->imei; ?></strong></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row col-6 mx-0 px-0">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="imei">IMEI</label>
                            <input type="text" class="form-control" name="imei" id="imei" readonly>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="hargaBeli">Harga</label>
                            <input type="text" name="harga_beli" id="hargaBeli" class="form-control"  readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control" placeholder="Tambahkan keterangan tetang produk yang di jual"></textarea>
                    </div>
                </div>
                <div class="col-6 row mx-0 px-0">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="pembayaran">Pembayaran</label>
                            <select name="pembayaran" id="pembayaran" class="form-control" required="">
                                <option>-- Pilih Metode Pembayaran --</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nama_petugas">Nama Petugas</label>
                        <input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user') ?>">
                        <input type="text" class="form-control" name="nama_petugas" value="<?php echo $this->session->userdata('nama') ?>" readonly>
                    </div>
                </div>
                <input type="hidden" name="nama_barang" id="namaBarang" value="">
                <input type="hidden" name="harga_barang" id="hargaBarang" value="">
                <div class="col-md-6 pt-2 pt-lg-0">
                    <div class="form-group float-right">
                        <button type="submit" name="submit" class="btn btn-danger">Tambah</button>
                        <?php echo anchor('Transaksi/selesai/'.$this->session->userdata('id_user'),'Selesai',['class'=>'btn btn-info']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
    <table class="table table-bordered">
        <div class="card-header">
            <tr class="success">
                <th colspan="6"> Detail Transaksi</th>
            </tr>
        </div>
        <tr>
            <th>No</th>
            <th>Nama Customer</th>
            <th>No Telp</th>
            <th>Nama Barang</th>
            <th>IMEI</th>
            <th>Harga Barang</th>
            <th>Cancel</th>
        </tr>
            <?php $no=1; ?>
            <?php $total=0; ?>
            <?php foreach($transaksi as $item): ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $item['nama_customer']?></td>
            <td><?php echo $item['no_telpn'] ?></td>
            <td><?php echo $item['nama_barang'] ?></td>
            <td><?php echo $item['imei'] ?></td>
            <td><a href="#gantiHarga<?php echo $item['imei']; ?>"  data-toggle="modal"><?php echo number_format($item['harga_jual'],0,'.','.') ?></a></td>
            <td><?php echo anchor('Transaksi/cancel/'.$item['imei'],'Cancel',['class'=>'btn btn-danger']) ?></td>
        </tr>
        <?php $total += $item['harga_jual']; ?>
        <?php $no++ ?>
        <?php  endforeach; ?>
        <tr>
            <td colspan="6"><p align="right"><i class="fab fa-wolf-pack-battalion"> Total </i></p></td>
            <td><?php echo "Rp.".number_format($total).",-" ?></td>
        </tr>
    </table>
</div>
<!-- Modal Ubah Harga -->
<?php foreach($transaksi as $item): ?>
<div class="modal fade" id="gantiHarga<?php echo $item['imei']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ganti Harga Jual</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php echo form_open('Transaksi/update_harga_jual') ?>
        <div class="modal-body">
            <input type="hidden" name = "imei" value="<?php echo $item['imei']; ?>">
            <input type="text" name = "harga_jual_baru" value="<?php echo number_format($item['harga_jual'],0,'.','.'); ?>" class="form-control uang">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">SIMPAN</button>
        </div>
        <?php echo form_close()?>
        </div>
    </div>
</div>
<?php endforeach; ?>
