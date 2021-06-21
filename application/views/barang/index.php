<div class="card-header">
                                        <h4>Data Barang </h4>
										<hr>
                                    </div>
<div class="container-fluid">
  
    <div class="card mb-3">
        <div class="card-header">
            
            <?php //echo anchor('Barang/tambah','Tambah Barang',array('class'=>'btn btn-primary')) ?>
            <a href="<?php echo base_url()?>barang/export" class="btn btn-success btn-sm float-right mr-3 mb-2"><i class="fa fa-file-excel-o"></i>&nbsp;Export Excel</a>
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
							<th>IMEI/SN</th>
                            <th>Harga Beli</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1 ?>
                    <?php foreach ($barang as $item) : ?>
                    <?php $harga_beli=str_replace('.','',$item->harga_beli) ?>
                    <?php $harga_jual=str_replace('.','',$item->harga_jual) ?>
                        <tr>
                            <td><?php echo $no ?></td>
							<td><?php echo $item->nama_barang ?></td>
                            <td><?php echo $item->imei ?></td>
                            <td><?php echo "Rp ".number_format($harga_beli,0,'.','.').",-" ?></td>
                            <?php if($item->status == "tmp"):?>
                                <td>Keranjang Transaksi</td>
                            <?php else:?>
                                <td>Stock</td>
                            <?php endif;?>
                            <td class="d-flex text-center">
                                <a href="<?php echo site_url('Barang/edit/'.$item->imei) ?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>&nbsp;
                                <!-- <?php echo form_open('Barang/hapus/'.$item->imei) ?> -->
                                <button type="submit" class="btn btn-sm btn-danger" onclick="hapusBarang(<?php echo $item->kode_pembelian; ?>)">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <!-- <?php echo form_close() ?> -->
                                &nbsp;
                                <?php if(($item->status == "tmp")&&($this->session->userdata('level')=="admin")):?>
                                    <button type="button" class="btn btn-sm btn-success" onclick="ubahInStock(<?php echo $item->kode_pembelian; ?>)">
                                        <i class="fa fa-recycle"></i>
                                    </button>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
