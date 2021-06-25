  <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="<?php site_url('dashboard') ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
									<span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Layanan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?php echo site_url('Service') ?>">Service Smartphone</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="<?php echo site_url('Transaksi') ?>">Penjualan Smartphone</a>
                                </li>
                           
							<li class="submenu-item ">
                                    <a href=<?php echo site_url('Pembelian') ?>>Pembelian Smartphone &#10003;</a>
                                </li>
                           
                           
                            </ul>
                        </li>
						     <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-book"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?php echo site_url('Laporan_pembelian') ?>">Data Pembelian &#10003;</a>
                                </li>
								<li class="submenu-item ">
                                    <a href="<?php echo site_url('Laporan_penjualan') ?>">Data Penjualan &#10003;</a>
                                </li>
                           
								<li class="submenu-item ">
                                    <a href="<?php echo site_url('Laporan_laba_rugi/harian') ?>">Laporan Laba Rugi (harian)</a>
                                </li>
							<li class="submenu-item ">
                                    <a href="<?php echo site_url('laporan_laba_rugi/bulanan') ?>">Laporan Laba Rugi (bulanan)</a>
                                </li>
                           
                           
                           
                            </ul>
                        </li>
						<li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-book"></i>
                                <span>Master Data</span>
                            </a>
							<ul  class="submenu ">
							<li class="submenu-item ">
                                    <a href=<?php echo site_url('Barang') ?>>Data Barang &#10003;</a>
									<a href=<?php echo site_url('user') ?>>Data Pengguna &#10003;</a>
                                </li>
                           
                           
                            </ul>
                        </li>
						

           

                  

                 

             

                       
                      

                      

                        

                       

                       

                       

                     

                    </ul>
                </div>