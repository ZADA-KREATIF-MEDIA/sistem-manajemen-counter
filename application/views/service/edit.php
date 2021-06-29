<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>service">Service</a>
        </li>
        <li class="breadcrumb-item active">Edit Data Service</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Edit Data Service
                </div>
                <?php echo form_open('service/update') ?>
                <div class="card-body row">
                    <div class="col-md-8">
                    <input type="hidden" name="id_service" value="<?php echo $detail->id_service?>">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <?php 
                                    $tanggal_masuk = explode(" ", $detail->tanggal_masuk);
                                    $tanggal_masuk_fix = $tanggal_masuk[0];
                                ?>
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="text" id="tanggal_masuk" class="form-control datepicker" name="tanggal_masuk" required="" placeholder="Masukkan Tanggal Masuk" value="<?php echo $tanggal_masuk_fix; ?>">
                            </div>
                            <div class="col-lg-4">
                                <label for="tanggal_jadi">Estimasi Tanggal Jadi</label>
                                <input type="text" class="form-control datepicker" name="tanggal_jadi" id="tanggal_jadi" required="" placeholder="Masukkan Estimasi Jadi" value="<?php echo $detail->tanggal_jadi; ?>" >
                            </div>
                            <div class="col-lg-4">
                                <label for="tanggal_diambil">Tanggal Diambil</label>
                                <input type="text" class="form-control datepicker" name="tanggal_diambil" id="tanggal_diambil" placeholder="Masukkan Tanggal Diambil" value="<?php echo $detail->tanggal_diambil;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="nama_teknisi">Nama Teknisi</label>
                                <input type="text" class="form-control" id="nama_teknisi" placeholder="Masukkan Nama Teknisi" value="<?php echo $this->session->userdata('nama');?>" readonly="">
                                <input type="hidden" name="id_teknisi" value="<?php echo $this->session->userdata('id_user');?>">
                            </div>
                            <div class="col form-group">
                                <label for="status">Status Pengerjaan</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="diterima" <?php if($detail->status == "diterima"){ echo "selected"; }?>>Baru Masuk</option>
                                    <option value="dikerjakan" <?php if($detail->status == "dikerjakan"){ echo "selected"; }?>>Sedang Dikerjakan</option>
                                    <option value="selesai" <?php if($detail->status == "selesai"){ echo"selected"; }?>>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_customer">Nama Customer</label>
                            <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="Masukkan Nama Customer" required="" value="<?php echo $detail->nama_customer;?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" cols="20" class="form-control" id="alamat" placeholder="Masukkan Alamat Customer" required=""><?php echo $detail->alamat; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_tlpn">Nomor Telepon</label>
                            <input type="text" name="no_tlpn" id="no_tlpn" class="form-control" maxlength="15" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Masukkan Nomor Customer" required="" value="<?php echo $detail->no_telpn;?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" required="" placeholder="Masukkan Nama Barang" value="<?php echo $detail->nama_barang; ?>">
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="tipe">Tipe</label>
                                <input type="text" class="form-control" name="tipe" id="tipe" required="" placeholder="Masukkan Tipe Barang" value="<?php echo $detail->tipe;?>">
                            </div>
                            <div class="col form-group">
                                <label for="imei">Imei/SN</label>
                                <input type="text" class="form-control" name="imei" id="imei" required="" placeholder="Masukkan Nomor IMEI" value="<?php echo $detail->imei;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelengkapan">Kelengkapan</label>
                            <textarea name="kelengkapan" id="kelengkapan" cols="30" class="form-control" placeholder="Batterai, Charger,SIM Card,.." required=""><?php echo $detail->kelengkapan; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keluhan">Keluhan</label>
                            <textarea name="keluhan" id="keluhan" cols="30" class="form-control" placeholder="Masukkan Keluhan" required=""><?php echo $detail->keluhan; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" class="form-control" placeholder="Masukkan Keterangan"><?php echo $detail->keterangan; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#addHW" data-toggle="modal" class="btn btn-success btn-block my-3" id="tambahHW">Tambah Part Hardware</a>
                        <div id="hardware" style="height: 300px;overflow:auto; ">
                            <?php foreach($part as $parts):?>
                                <div id="hapusHW_1"  class="border border-bottom pt-3">
                                    <input type="hidden" name="id_part[]" value="<?php echo $parts['id_part'];?>">
                                    <div class="form-group">
                                        <label for="part_hw">Nama Part Hardware</label>
                                        <input type="text" class="form-control" name="part_hw[]" id="part_hw" placeholder="Masukkan Nama Part" value="<?php echo $parts['nama_part'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_part_hw">Harga Part Hardware</label>
                                        <input type="text" class="form-control uang" name="harga_part_hw[]" id="harga_part_hw" placeholder="Masukkan Harga" value="<?php echo number_format($parts['biaya'],0,'.','.');?>">
                                    </div>
                                    <div>
                                        <button class="btn-danger btn-sm btn-block" type="button" onclick="deleteHW(<?php echo $parts['id_part']; ?>)">Hapus</button>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                        <a href="#addSW" class="btn btn-success btn-block my-3" id="tambahSW" data-toggle="modal">Tambah Part Software</a>
                        <div id="software" style="height:300px; overflow:auto; ">
                            <?php foreach($software as $sw):?>
                                <div id="hapusSW_1"  class="border border-bottom pt-3">
                                    <input type="hidden" name="id_software[]" value="<?php echo $sw['id_software'];?>">
                                    <div class="form-group">
                                        <label for="part_sw">Nama Part Software</label>
                                        <input type="text" class="form-control" name="part_sw[]" id="part_sw" placeholder="Masukkan Nama Software" value="<?php echo $sw['nama_software']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_part_sw">Harga Part SoftWare</label>
                                        <input type="text" class="form-control uang" name="harga_part_sw[]" id="harga_part_sw" placeholder="Masukkan Harga" value="<?php echo number_format($sw['biaya'],0,'.','.');?>">
                                    </div>
                                    <div>
                                        <button class="btn-danger btn-sm btn-block" type="button" onclick="deleteSW(<?php echo $sw['id_software']; ?>)">Hapus</button>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                </div>
                <div class="card-footer bg-transparent">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="<?php echo site_url('service') ?>" class="btn btn-danger">Kembali</a>
                </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal ADD HW -->
<div class="modal fade" id="addHW" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Part Hardware</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url()?>service/store_hw" method="POST">
                <input type="hidden" name="id_service" value="<?php echo $detail->id_service; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="part_hw">Nama Part Hardware</label>
                        <input type="text" class="form-control" name="part_hw" id="part_hw" placeholder="Masukkan Nama Part">
                    </div>
                    <div class="form-group">
                        <label for="harga_part_hw">Harga Part Hardware</label>
                        <input type="text" class="form-control uang" name="harga_part_hw" id="harga_part_hw" placeholder="Masukkan Harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal ADD SW -->
<div class="modal fade" id="addSW" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Part Software</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url()?>service/store_sw" method="POST">
                <input type="hidden" name="id_service" value="<?php echo $detail->id_service; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="part_sw">Nama Part Software</label>
                        <input type="text" class="form-control" name="part_sw" id="part_sw" placeholder="Masukkan Nama Software">
                    </div>
                    <div class="form-group">
                        <label for="harga_part_sw">Harga Part Software</label>
                        <input type="text" class="form-control uang" name="harga_part_sw" id="harga_part_sw" placeholder="Masukkan Harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var id = 1;
	function addHW(){
		id += 1;
		var item = '<div id="hapusHW_'+id+'" class="border border-bottom pt-3">'+
			 		    '<div class="form-group">'+
			 			    '<label for="part_hw">Nama Part Hardware</label>'+
			 			    '<input type="text" class="form-control" name="part_hw[]" id="part_hw" placeholder="Masukkan Nama Software">'+
			 		    '</div>'+
                        '<div class="form-group">'+
                            '<label for="harga_part_hw">Harga Part SoftWare</label>'+
                            '<input type="text" class="form-control uang" name="harga_part_hw[]" id="harga_part_hw" placeholder="Masukkan Harga">'+
                        '</div>'+
                        '<div>'+
                            '<button class="btn-danger btn-sm btn-block" type="button" onclick="deleteHW('+id+')">Hapus'+
                            '</button>'+
                        '</div>'+
			 		'</div>';
		$('#hardware').append(item);
    }
   

    function addSW(){
		id += 1;
		var item = '<div id="hapusSW_'+id+'" class="border border-bottom pt-3">'+
			 		    '<div class="form-group">'+
			 			    '<label for="part_sw">Nama Part Software</label>'+
			 			    '<input type="text" class="form-control" name="part_sw[]" id="part_sw" placeholder="Masukkan Nama Part">'+
			 		    '</div>'+
                        '<div class="form-group">'+
                            '<label for="harga_part_sw">Harga Part</label>'+
                            '<input type="text" class="form-control uang" name="harga_part_sw[]" id="harga_part_sw" placeholder="Masukkan Harga">'+
                        '</div>'+
                        '<div>'+
                            '<button class="btn-danger btn-sm btn-block" type="button" onclick="deleteSW('+id+')">Hapus'+
                            '</button>'+
                        '</div>'+
			 		'</div>';
		$('#software').append(item);
    }
    
    
</script>