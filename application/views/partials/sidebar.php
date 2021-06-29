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
            <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "teknisi"):?>
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Service') ?>">Service Smartphone</a>
                </li>
            <?php endif;?>
            <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "penjual"):?>
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Transaksi') ?>">Penjualan Smartphone</a>
                </li>
                <li class="submenu-item ">
                    <a href=<?php echo site_url('Pembelian') ?>>Pembelian Smartphone</a>
                </li>
                <?php endif;?>  
            </ul>
        </li>
        <?php if($this->session->userdata('level') == "admin"):?>
        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-stack text-primary"></i>
                <span>Operasional</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Pengeluaran') ?>">Pengeluaran</a>
                </li>
                <li class="submenu-item ">
                    <a href="<?php echo site_url('pemasukan') ?>">Pemasukan</a>
                </li>
            </ul>
        </li>
        <?php endif;?>
        <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "penjual"):?>
        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-book text-warning"></i>
                <span>Laporan</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Laporan_pembelian') ?>">Data Pembelian</a>
                </li>
                <li class="submenu-item ">
                    <a href="<?php echo site_url('Laporan_penjualan') ?>">Data Penjualan</a>
                </li>
               
            </ul>
        </li>
        <?php endif;?>
        <?php if($this->session->userdata('level') == "admin"):?>
        <li class="sidebar-item  has-sub">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-server text-danger"></i>
                <span>Master Data</span>
            </a>
            <ul class="submenu ">
                <li class="submenu-item ">
                    <a href=<?php echo site_url('Barang') ?>>Data Barang</a>
                    <a href=<?php echo site_url('user') ?>>Data Pengguna</a>
                    
                </li>
            </ul>
        </li>
        <?php endif;?>
        <a href="<?= base_url('login/logout') ?>" class="btn btn-danger btn-sm btn-block mt-3">Logout</a>
    </ul>
</div>