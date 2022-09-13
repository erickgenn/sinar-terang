<script src="https://kit.fontawesome.com/6938e8f442.js" crossorigin="anonymous"></script>
<?php if ($_SESSION['role'] == 'owner') : ?>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" href="<?php echo base_url('/logout'); ?>" alt="Log Out">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-light elevation-4" style="background-color: #1C2D49;">

        <a href="<?php echo base_url('admin/dashboard'); ?>" class="brand-link">
            <img src="<?php echo base_url(); ?>/login/images/logos-03.png" alt="Sinar Terang" class="brand-image" style="opacity: .8; max-height:33px;">
            <span class="brand-text">Sinar Terang</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo base_url(); ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo ucwords($_SESSION['name']); ?></a>
                </div>
            </div>

            <div class="form-inline">

            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="<?php echo base_url("/admin/dashboard"); ?>" id="dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url("/admin/customer"); ?>" id="customer" class="nav-link">
                            <i class="nav-icon fa-solid fa-people-group"></i>
                            <p>
                                Customers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url("/admin/outlet"); ?>" id="outlet" class="nav-link">
                            <i class="nav-icon fa-solid fa-store"></i>
                            <p>
                                Outlets
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url("/admin/product"); ?>" id="product" class="nav-link">
                            <i class="nav-icon fa-solid fa-chair"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url("/admin/order"); ?>" id="order" class="nav-link">
                            <i class="nav-icon fa-solid fa-cart-plus"></i>
                            <p>
                                Orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url("/admin/user"); ?>" id="user" class="nav-link">
                            <i class="nav-icon fa-solid fa-user-pen"></i>
                            <p>
                                Users Management
                            </p>
                        </a>
                    </li>
                    <li id="nav_customer_pages" class="nav-item">
                        <a href="#" id="customer_pages" class="nav-link">
                            <i class="nav-icon fa-regular fa-file-lines"></i>
                            <p>
                                Customer Pages
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="contact_us" href="<?php echo base_url("admin/customer_pages/contact_us"); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Contact Us Page</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="faq" href="<?php echo base_url("admin/customer_pages/faq"); ?>" href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>FAQ Page</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Level 1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Level 1
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Level 2
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Level 1</p>
                        </a>
                    </li>
                    <li class="nav-header">LABELS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Important</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p>Warning</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Informational</p>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

    </aside>

    <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let current = window.location.href;
            if (current.includes('/admin/dashboard')) {
                document.getElementById("dashboard").className = "nav-link active";
            } else if (current.includes('/admin/product')) {
                document.getElementById("product").className = "nav-link active";
            } else if (current.includes('/admin/add_product')) {
                document.getElementById("product").className = "nav-link active";
            } else if (current.includes('/admin/product/view')) {
                document.getElementById("product").className = "nav-link active";
            } else if (current.includes('/admin/outlet')) {
                document.getElementById("outlet").className = "nav-link active";
            } else if (current.includes('/admin/add_outlet')) {
                document.getElementById("outlet").className = "nav-link active";
            } else if (current.includes('/admin/edit_outlet')) {
                document.getElementById("outlet").className = "nav-link active";
            } else if (current.includes('/admin/order')) {
                document.getElementById("order").className = "nav-link active";
            } else if (current.includes('/admin/customer_pages/contact_us')) {
                document.getElementById("customer_pages").className = "nav-link active";
                document.getElementById("contact_us").className = "nav-link active";
                document.getElementById("nav_customer_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/customer_pages/faq')) {
                document.getElementById("customer_pages").className = "nav-link active";
                document.getElementById("faq").className = "nav-link active";
                document.getElementById("nav_customer_pages").className = "nav-item menu-open";
            } else if (current.includes('admin/customer_pages/add_faq')) {
                document.getElementById("customer_pages").className = "nav-link active";
                document.getElementById("faq").className = "nav-link active";
                document.getElementById("nav_customer_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/user')) {
                document.getElementById("user").className = "nav-link active";
            } else if (current.includes('/admin/add_user')) {
                document.getElementById("user").className = "nav-link active";
            } else if (current.includes('/admin/customer')) {
                document.getElementById("customer").className = "nav-link active";
            }
        });
    </script>
<?php endif; ?>