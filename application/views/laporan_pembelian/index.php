<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">laporan</a>
        </li>
        <li class="breadcrumb-item active">Laporan Pembelian</li>
    </ol>
    <div class="card mb-3">
    <div class="card-header bg-primary text-white">
        LAPORAN PEMBELIAN <a href="<?php echo base_url();?>laporan_pembelian/export" class="btn btn-success btn-sm float-right mr-3 mb-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>
    </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
							<th>IMEI/SN</th>
                            <th>Harga Beli</th>
                            <th>Customer</th>
							<th>Pembayaran</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;
                    $total=0;
                    ?>
                    <?php foreach ($laporan as $item) : ?>
                        <tr>
                            <td><?php echo $no ?></td>
							<td><?php echo $item->tanggal?></td>
							<td><?php echo $item->nama_barang ?></td>
                            <td><?php echo $item->imei ?></td>
                            <td>Rp. <?php echo number_format($item->harga_beli,0,'.','.') ?></td>
						    <td><?php echo $item->nama_customer ?></td>
							<td><?php echo $item->metode_bayar ?></td>
                            <td><?php echo $item->nama?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>laporan_pembelian/show/<?php echo $item->kode_pembelian; ?>" class="btn btn-dark btn-sm" title="Detail"><i class="fa fa-eye"></i></a>
                                <?php if($this->session->userdata('level')== "admin"):?>
                                    <button class="btn btn-primary btn-sm" onclick="editPembelian(<?php echo $item->kode_pembelian;?>)" data-toggle="modal"><i class="fa fa-edit"></i></button>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="alertHapus(<?php echo $item->kode_pembelian ?>)" title="Hapus"><i class="fa fa-trash"></i></a>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php $no++;
                        $total+= $item->harga_beli;
                        ?>
                        <?php endforeach; ?>
                        
                    </tbody>
                    <tfoot>
                    <tr >
                    <td colspan="9" class="bg-dark text-white">
                    <h6>Total Pembelian Rp. <?= number_format($total,0,'.','.') ?></h6>
                    </td></tr>
                        
                    </tfoot>
                    
                </table>
                
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="laporanPenjualanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <?php echo form_open('laporan_pembelian/update');?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="hargaPembelian">Harga Pembelian</label>
                    <input type="text" class="form-control" name="harga_pembelian" id="hargaPembelian" value="">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="10" class="form-control" value=""></textarea>
                </div>
            </div>
            <input type="hidden" name="kode_pembelian" id="kodePembelian">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary text-uppercase">perbaharui</button>
            </div>
        <?php echo form_close();?>    
        </div>
    </div>
</div>
