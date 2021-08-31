<div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>service">Pembelian</a>
        </li>
        <li class="breadcrumb-item active">Detail Pembelian Barang</li>
    </ol>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    DETAIL PEMBELIAN BARANG
                </div>
                <table class="table">
                  <tbody>
                    <tr>
                      <th>IMEI/SN</th>
                      <td><?= $detail->imei ?></td>
                    </tr>
                    <tr>
                      <th>NAMA BARANG</th>
                      <td><?= $detail->nama_barang ?></td>
                    </tr>
                    <tr>
                      <th>NAMA CUSTOMER</th>
                      <td><?= $detail->nama ?></td>
                    </tr>
                    <tr>
                      <th>NOMOR TELEPHONE</th>
                      <td><?= $detail->no_telpn?></td>
                    </tr>
                    <tr>
                      <th>ALAMAT CUSTOMER</th>
                      <td><?= $detail->alamat ?></td>
                    </tr>
                    <tr>
                      <th>TANGGAL PEMBELIAN</th>
                      <td><?= date("d-m-Y", strtotime($detail->tanggal));?></td>
                    </tr>
                    <tr>
                      <th>HARGA</th>
                      <td>Rp. <?= number_format($detail->harga_beli,0,'.','.');?></td>
                    </tr>
                    <tr>
                      <th>KETERANGAN BARANG</th>
                      <td><?= $detail->keterangan?></td>
                    </tr>
                    <tr>
                      <th>PETUGAS</th>
                      <td><?= $detail->nama;?></td>
                    </tr>
                    </tr>
                  </tbody>
                </table>
                <div class="card-footer bg-transparent px-0">
                  <a href="<?php echo site_url('laporan_pembelian') ?>" class="btn btn-info">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>