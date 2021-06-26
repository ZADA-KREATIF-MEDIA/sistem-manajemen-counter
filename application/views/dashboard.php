<div class="row">
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon purple">
                            <i class="iconly-boldShow"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Profile Views</h6>
                        <h6 class="font-extrabold mb-0">112.000</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon blue">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Followers</h6>
                        <h6 class="font-extrabold mb-0">183.000</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon green">
                            <i class="iconly-boldAdd-User"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Following</h6>
                        <h6 class="font-extrabold mb-0">80.000</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon red">
                            <i class="iconly-boldBookmark"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Saved Post</h6>
                        <h6 class="font-extrabold mb-0">112</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Icon Cards-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success">
                    Welcome : <?php echo $this->session->userdata('nama') ?>
                </div>
                <div class="card">
                    <div class="card-header">
                        <?= DATE("d-m-Y") ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Penjualan Barang - <?php echo $this->session->userdata('nama') ?></h5>
                        <p class="card-text">
                        <ul class="list-group">
                            <?php
                            $total = 0;
                            foreach ($grafik as $trans) : {
                                    echo "<li class='list-group-item'>" . $trans->nama_barang . "-" . $trans->harga_jual . "</li>";
                                }
                                $total += $trans->harga_jual;
                            endforeach;
                            ?>
                        </ul>
                        <hr>
                        <h5>Jumlah Penjualan = <?= count($grafik); ?> Barang</h5>
                        <h5>Total Pendapatan = Rp. <?= number_format($total, 0, '.', '.') ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>