<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand"  href="<?php echo base_url(); ?>/dashboard">PHONE SERVICE</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fa fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0 ">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout">Logout</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">MENU NAVIGASI</div>
                    <a class="nav-link" href="<?php echo site_url('Dashboard') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fa fa-home"></i>
                        </div>
                        Dashboard
                    </a>
                    <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "teknisi"):?>
                        <a class="nav-link" href="<?php echo site_url('Service') ?>">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-gear"></i>
                            </div>
                            Service
                        </a>
                    <?php endif;?>
                    <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "penjual"):?>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fa fa-columns"></i>
                            </div>
                            Transaksi
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo site_url('Transaksi') ?>">Penjualan</a>
                                <a class="nav-link" href="<?php echo site_url('Pembelian') ?>">Pembelian</a>
                                <?php if($this->session->userdata('level') == "admin"):?>
                                    <a class="nav-link" href="<?php echo site_url('Pengeluaran') ?>">Pengeluaran</a>
                                    <a class="nav-link" href="<?php echo site_url('Pemasukan') ?>">Pemasukan</a>
                                    <a class="nav-link" href="<?php echo site_url('gaji') ?>">Penggajian</a>
                                    <a class="nav-link" href="<?php echo site_url('saldo_awal') ?>">Saldo Awal</a>
                                    <a class="nav-link" href="<?php echo site_url('piutang') ?>">Piutang</a>
                                    <a class="nav-link" href="<?php echo site_url('hutang') ?>">Hutang</a>
                                <?php endif;?>
                            </nav>
                        </div>
                    <?php endif;?>
                    <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "penjual"):?>
                        <div class="sb-sidenav-menu-heading">LAPORAN DAN DATA</div>
                        <a class="nav-link" href="<?php echo site_url('Laporan_pembelian') ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-book text-primary"></i></div>
                            Data Pembelian
                        </a>
                        <a class="nav-link" href="<?php echo site_url('Laporan_penjualan') ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-book text-danger"></i></div>
                            Data Penjualan
                        </a>
                        <a class="nav-link" href="<?php echo site_url('Barang') ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-list text-warning"></i></div>
                            Data Barang
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#labarugi" aria-expanded="false" aria-controls="labarugi">
                            <div class="sb-nav-link-icon">
                            <i class="fa fa-book text-success"></i>
                            </div>
                            Laporan
                            <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="labarugi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo site_url('Laporan_laba_rugi/harian') ?>">Harian</a>
                                <a class="nav-link" href="<?php echo site_url('laporan_laba_rugi/bulanan') ?>">Bulanan</a>
                            </nav>
                        </div>
                    <?php endif;?>
                    <?php if($this->session->userdata('level') == "admin"):?>
                        <div class="sb-sidenav-menu-heading">PENGATURAN</div>
                        <a class="nav-link" href="<?php echo site_url('user') ?>">
                            <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
                            Data User
                        </a>
                    <?php endif;?>
        </nav>
</div>