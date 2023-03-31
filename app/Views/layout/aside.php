<script src="https://kit.fontawesome.com/6938e8f442.js" crossorigin="anonymous"></script>
<?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager' || $_SESSION['role'] == 'owner') : ?>
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
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-light elevation-4" style="background-color: #1C2D49;">

        <a href="#" class="brand-link">
            <img src="<?php echo base_url(); ?>/assets/logos-03.png" alt="Sinar Terang" class="brand-image" style="opacity: .8; max-height:33px;">
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
                    <?php if ($_SESSION['role'] == 'manager' || $_SESSION['role'] == 'owner') : ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url("/admin/dashboard"); ?>" id="dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url("/admin/product"); ?>" id="product" class="nav-link">
                            <i class="nav-icon fa-solid fa-chair"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>
                    <?php if ($_SESSION['role'] == 'owner') : ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url("/admin/user"); ?>" id="user" class="nav-link">
                                <i class="nav-icon fa-solid fa-user-pen"></i>
                                <p>
                                    Atur Daftar Karyawan
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['role'] == 'manager' || $_SESSION['role'] == 'owner') : ?>
                        <li id="nav_finance_pages" class="nav-item">
                            <a id="finance_pages" href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-money-bill-transfer"></i>
                                <p>
                                    Finance
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a id="cash" href="<?php echo base_url("/admin/finance/cash"); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cash Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="sales" href="<?php echo base_url("/admin/finance/sales"); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales Report</p>
                                    </a>
                                </li>
                                <li id="nav_expenses_pages" class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Expenses Report
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a id="salary" href="<?php echo base_url("/admin/finance/salary"); ?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Salary Expenses</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="electrical" href="<?php echo base_url("/admin/finance/electrical"); ?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Electrical Expenses</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="rent" href="<?php echo base_url("/admin/finance/rent"); ?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Rent Expenses</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="maintenance" href="<?php echo base_url("/admin/finance/maintenance"); ?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Maintenance Expenses</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="other" href="<?php echo base_url("/admin/finance/other"); ?>" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Other Expenses</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION['role'] == 'owner') : ?>
                                <li class="nav-item">
                                    <a id="profit_loss" href="<?php echo base_url("/admin/finance/profit_loss"); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profit and Loss Report</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            </ul>
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
            } else if (current.includes('/admin/order/request_cancel')) {
                document.getElementById("order_pages").className = "nav-link active";
                document.getElementById("order_request").className = "nav-link active";
                document.getElementById("nav_order").className = "nav-item menu-open";
            } else if (current.includes('/admin/order/request/')) {
                document.getElementById("order_pages").className = "nav-link active";
                document.getElementById("order_request").className = "nav-link active";
                document.getElementById("nav_order").className = "nav-item menu-open";
            } else if (current.includes('/admin/order')) {
                document.getElementById("order_pages").className = "nav-link active";
                document.getElementById("order").className = "nav-link active";
                document.getElementById("nav_order").className = "nav-item menu-open";
            } else if (current.includes('/admin/add_order')) {
                document.getElementById("order_pages").className = "nav-link active";
                document.getElementById("order").className = "nav-link active";
                document.getElementById("nav_order").className = "nav-item menu-open";
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
            } else if (current.includes('/admin/edit_user')) {
                document.getElementById("user").className = "nav-link active";
            } else if (current.includes('/admin/customer')) {
                document.getElementById("customer").className = "nav-link active";
            } else if (current.includes('/admin/finance/salary')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("salary").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
                document.getElementById("nav_expenses_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/electrical')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("electrical").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
                document.getElementById("nav_expenses_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/rent')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("rent").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
                document.getElementById("nav_expenses_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/maintenance')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("maintenance").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
                document.getElementById("nav_expenses_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/other')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("other").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
                document.getElementById("nav_expenses_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/cash')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("cash").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/cash')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("cash").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/profit_loss')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("profit_loss").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/finance/sales')) {
                document.getElementById("finance_pages").className = "nav-link active";
                document.getElementById("sales").className = "nav-link active";
                document.getElementById("nav_finance_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/point/config')) {
                document.getElementById("point_pages").className = "nav-link active";
                document.getElementById("point_config").className = "nav-link active";
                document.getElementById("nav_point_pages").className = "nav-item menu-open";
            } else if (current.includes('/admin/point')) {
                document.getElementById("point_pages").className = "nav-link active";
                document.getElementById("point").className = "nav-link active";
                document.getElementById("nav_point_pages").className = "nav-item menu-open";
            }
        });
    </script>
<?php endif; ?>