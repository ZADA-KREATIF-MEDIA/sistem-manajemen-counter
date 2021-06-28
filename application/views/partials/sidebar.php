<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        <li class="sidebar-item active ">
            <a href="<?php echo site_url('dashboard') ?>" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-back text-success"></i>
                <span>Layanan</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Service') ?>">Service Smartphone</a>
                </li>
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Transaksi') ?>">Penjualan Smartphone &#10003;</a>
                </li>
                <li class="submenu-item ">
                    <a href=<?php echo site_url('Pembelian') ?>>Pembelian Smartphone &#10003;</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-stack text-primary"></i>
                <span>Operasional</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Pengeluaran') ?>">Pengeluaran &#10003;</a>
                </li>
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Pemasukan') ?>">Pemasukan &#10003;</a>
                </li>
               
            </ul>
        </li>
        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-book text-warning"></i>
                <span>Laporan</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Laporan_pembelian') ?>">Data Pembelian &#10003;</a>
                </li>
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Laporan_penjualan') ?>">Data Penjualan &#10003;</a>
                </li>
               
            </ul>
        </li>
        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-server text-danger"></i>
                <span>Master Data</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href=<?php echo site_url('Barang') ?>>Data Barang &#10003;</a>
                    <a href=<?php echo site_url('user') ?>>Data Pengguna &#10003;</a>
                    
                </li>
            </ul>
        </li>
        <a href="<?= base_url('login/logout') ?>" class="btn btn-danger btn-sm btn-block mt-3">Logout</a>
    </ul>
</div>