<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">laporan</a>
        </li>
        <li class="breadcrumb-item active">LAPORAN PENJUALAN</li>
    </ol>
    <div class="card mb-3">
       
     
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Pembayaran</th>
                            <th>Kosumen</th>
                            
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Pembayaran</th>
                            <th>Kosumen</th>
                            
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php $no=1 ?>
                    <?php foreach ($laporan as $item) : ?>
                        <tr>
                            <td><?php echo $no ?></td>
							<td><?php echo $item->tanggal?></td>
                            <td><?php echo $item->nama_barang ?></td>
                            <td><?php echo $item->qty ?></td> 
                            <td><?php 
									$total_harga=$item->price;
							echo "Rp.".number_format($total_harga).",-" ?></td>
                        <td><?php echo $item->user_id ?></td>
                            <!--<td>
                                <a href="<?php echo site_url('laporan/edit/'.$item->kd_laporan) ?>" class="btn btn-sm btn-outline-secondary"
                                    style="padding-bottom: 0px; padding-top: 0px;">
                                    Edit
                                    <span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span>
                                </a>
                                <?php echo form_open('laporan/hapus/'.$item->kd_laporan) ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" style="padding-bottom: 0px; padding-top: 0px;"
                                    onclick="return confirm('Anda Yakin Ingin Menghapus?');">
                                    Delete
                                    <span class="btn-label btn-label-right"><i class="fa fa-trash"></i></span>
                                </button>
                                <?php echo form_close() ?>
                            </td>-->
                        </tr>
                        <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
