<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url('assets/admin/img/profile_small.jpg')?>" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo ucwords($this->session->userdata('nama')) ?></strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo site_url('admin/profil') ?>">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('login/logout')?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li <?php if ( $this->uri->uri_string() == 'admin' || $this->uri->uri_string() == '' || $this->uri->uri_string() == 'admin/detail') { echo "class='active'";} else { echo "";} ?>>
                        <a href="index.html"><i class="fa fa-dollar"></i> <span class="nav-label">Transaksi</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li <?php if ( $this->uri->uri_string() == 'admin' || $this->uri->uri_string() == '') { echo "class='active'";} else { echo "";} ?>><a href="<?php echo site_url('admin')?>">List</a></li>
                            <li <?php if ( $this->uri->uri_string() == 'admin/detail') { echo "class='active'";} else { echo "";} ?>><a href="<?php echo site_url('admin/detail') ?>">Detail</a></li>
                           </span></a></li>
                        </ul>
                    </li>
                    <li <?php if ( $this->uri->uri_string() == 'admin/produk') { echo "class='active'";} else { echo "";} ?>>
                        <a href="<?php echo site_url('admin/produk') ?>"><i class="fa fa-tags"></i> <span class="nav-label">Produk</span></a>
                    </li>
                    <li <?php if ( $this->uri->uri_string() == 'admin/user') { echo "class='active'";} else { echo "";} ?>>
                        <a href="<?php echo site_url('admin/user') ?>"><i class="fa fa-users"></i> <span class="nav-label">User</span></a>
                    </li>
                    <li <?php if ( $this->uri->uri_string() == 'admin/profil') { echo "class='active'";} else { echo "";} ?>>
                        <a href="<?php echo site_url('admin/profil') ?>"><i class="fa fa-user"></i> <span class="nav-label">Profil</span></a>
                    </li>
                </ul>

            </div>
        </nav>