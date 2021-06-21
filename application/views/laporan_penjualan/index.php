<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url()?>Laporan_penjualan">laporan</a>
        </li>
        <li class="breadcrumb-item active">Laporan Penjualan</li>
    </ol>
    <div class="card mb-3">
    <div class="card-header bg-primary text-white">
    LAPORAN PENJUALAN <a href="<?php echo base_url();?>laporan_penjualan/export" class="btn btn-success btn-sm float-right mr-3 mb-2"><i class="fa fa-file-excel-o"></i> Export Excel</a>
  </div>
        <div class="card-body table-responsive">
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Konsumen</th>
                            <th>Nama Barang</th>
                            <th>IMEI</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Nama Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;
                    $total=0;
                    $beli=0; ?>
                    <?php foreach ($laporan as $item) : ?>
                        <tr>
                            <td><?php echo $no ?></td>
							<td><?php echo $item->tanggal?></td>
                            <td><?php echo $item->nama_customer ?></td>
                            <td><?php echo $item->nama_barang; ?></td>
                            <td><?php echo $item->imei ?></td>
                            <td><?php echo number_format($item->harga_beli,0,'.','.') ?></td>                          
                            <td><?php echo number_format($item->harga_jual,0,'.','.') ?></td>
                            <td><?php echo $item->nama ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url() ?>laporan_penjualan/show_detail/<?php echo $item->imei; ?>" class="btn btn-dark btn-sm"><i class="fa fa-eye"></i></a>
                                <?php if($this->session->userdata('level') == "admin"):?>
                                    <a href="<?php echo base_url() ?>laporan_penjualan/edit_detail/<?php echo $item->imei; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm" onclick="hapusLaporanPenjualan('<?php echo $item->id_penjualan; ?>')"><i class="fa fa-trash"></i></button>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php $no++;
                        $total+= $item->harga_jual;
                        $beli+= $item->harga_beli;
                        ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                    <td colspan="3" class="bg-danger text-white">
                   <h6>Total Penjualan Rp. <?= number_format($total,0,'.','.') ?></h6>
                    </td>
                    <td colspan="3" class="bg-success text-white"><h6>Total Pembelian Rp. <?= number_format($beli,0,'.','.') ?></h6></td>
                    <td colspan="4" class="bg-dark text-white"><h6>(Penjualan - Pembelian) Rp. <?= number_format($total-$beli,0,'.','.') ?></h6></td>
                    </tr>
                    
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
