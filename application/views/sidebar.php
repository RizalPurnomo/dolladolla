<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <script>
        function kursorActive(x) {
            x.classList.toggle("active");
        }
    </script>

    <?php
    $master = ($this->uri->segment(1) == 'user'  || $this->uri->segment(1) == 'inventaris' ? 'menu-open' : '');
    $master2 = ($this->uri->segment(1) == 'report' ? 'menu-open' : '');
    $user = ($this->uri->segment(1) == 'user' ? 'active' : '');
    $barang = ($this->uri->segment(1) == 'barang' ? 'active' : '');
    $inventaris = ($this->uri->segment(1) == 'inventaris' ? 'active' : '');
    $pembelian = ($this->uri->segment(1) == 'pembelian' ? 'active' : '');
    $penjualan = ($this->uri->segment(1) == 'penjualan' ? 'active' : '');
    $rptStock = ($this->uri->segment(2) == 'rptStock' ? 'active' : '');
    $rptPenjualan = ($this->uri->segment(2) == 'rptPenjualan' ? 'active' : '');
    ?>

    <?php
    $query = "SELECT * FROM profile WHERE id='1'";
    $appName = $this->db->query($query)->result_array()[0]['appname'];
    ?>

    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>dashboard" class="brand-link">
        <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $appName; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $this->session->userdata('realname'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if ($this->session->userdata('level') == "Super Administrator" || $this->session->userdata('level') == "Administrator") { ?>
                    <li class="nav-item has-treeview <?php echo $master; ?>">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url('user'); ?>" class="nav-link <?php echo $user; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ($this->session->userdata('level') == "Super Administrator" || $this->session->userdata('level') == "Administrator") { ?>
                    <li class="nav-item has-treeview">
                        <a href="<?php echo base_url('pembelian'); ?>" class="nav-link <?php echo $pembelian; ?>">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Pembelian
                                <!-- <i class="right fas fa-angle-left"></i> -->
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item has-treeview">
                    <a href="<?php echo base_url('penjualan'); ?>" class="nav-link <?php echo $penjualan; ?>">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Penjualan
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                <?php if ($this->session->userdata('level') == "Super Administrator" || $this->session->userdata('level') == "Administrator") { ?>
                    <li class="nav-item has-treeview <?php echo $master2; ?>">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Report
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url('report/rptStock'); ?>" class="nav-link <?php echo $rptStock; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Stock</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('report/rptPenjualan'); ?>" class="nav-link <?php echo $rptPenjualan; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penjualan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>