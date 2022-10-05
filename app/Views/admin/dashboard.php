<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Admin Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url(); ?>/login/images/logos-02.png" alt="AdminLTELogo" height="260" width="260">
        </div>

        <?php include(APPPATH . "Views/layout/aside.php"); ?>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <?php if (session()->getFlashdata('login_successful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Welcome Back <?php echo $_SESSION['name']; ?>!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-lg-6 col-6">

                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                        <li class="pt-2 px-3">
                                            <h3 class="card-title">Orders <i class="ion ion-bag"></i></h3>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Total</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Cancel Request</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-two-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                            <!-- small box -->
                                            <div class="small-box bg-white">
                                                <div class="inner">
                                                    <h3><?php echo $total_order; ?></h3>
                                                    <p>Total Orders</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon fa-solid fa-layer-group"></i>
                                                </div>
                                                <a href="<?php echo base_url('admin/order'); ?>" class="small-box-footer">See All Orders <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                                            <!-- small box -->
                                            <div class="small-box bg-white">
                                                <div class="inner">
                                                    <h3><?php echo $total_request; ?></h3>
                                                    <p>Orders Need Feedback</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="icon fas fa-list-check"></i>
                                                </div>
                                                <a href="<?php echo base_url('admin/order/request_cancel'); ?>" class="small-box-footer">See All Cancel Requests <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info" style="padding: 5.15rem 1rem 1.5rem 1rem">
                                <div class="inner">
                                    <h3><?php echo $total_customer ?></h3>
                                    <p>Total Customers</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-user-group"></i>
                                </div>
                                <a href="<?php echo base_url('admin/customer'); ?>" class="small-box-footer">See All Customers <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success" style="padding: 6.1rem 1rem 1.5rem 1rem">
                                <div class="inner">
                                    <h4 style="font-weight: 600;"><?php echo $gross_sales ?></h4>
                                    <p>This Month's Gross Sales</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <?php if ($_SESSION['role'] == 'owner') : ?>
                                    <a href="<?php echo base_url('admin/finance/profit_loss'); ?>" class="small-box-footer">See Profit and Loss <i class="fas fa-arrow-circle-right"></i></a>
                                <?php else : ?>
                                    <a href="<?php echo base_url('admin/finance/cash'); ?>" class="small-box-footer">See Cash Report <i class="fas fa-arrow-circle-right"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <section class="col-lg-8 connectedSortable">

                            <div class="card">
                                <div class="card-header" style="background-color:#1C2D49">
                                    <h3 class="card-title" style="color:white"><i class="fas fa-chart-line"></i> This Week's New Customers</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus" style="color:white"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="customerChart" width="798" height="375" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Chart End -->
                        </section>
                        <section class="col-lg-4 connectedSortable">
                            <div class="card">
                                <div class=" card-header" style="background-color:#1C2D49">
                                    <h3 class="card-title" style="color:white"><i class="fas fa-box"></i> Low-stock Product</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus" style="color:white"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="height: 405px; overflow: auto;">
                                    <?php if (count($low_product) == 0) : ?>
                                        <div class="alert alert-success">
                                            <h5><i class="fa-solid fa-face-smile-wink"></i> Horray!</h5>
                                            No low stock products available
                                        </div>
                                    <?php else : ?>
                                        <table id="product-table" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 0; $i < count($low_product); $i++) : ?>
                                                    <tr>
                                                        <th><?php echo $i + 1; ?></th>
                                                        <th><?php echo $low_product[$i]['name']; ?></th>
                                                        <th><?php echo $low_product[$i]['quantity']; ?></th>
                                                    </tr>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </section>

                    </div>

                </div>
            </section>

        </div>

        <footer class="main-footer">
            <strong>Sinar Terang.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>


    <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/chart.js/Chart.min.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/sparklines/sparkline.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="<?php echo base_url(); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="<?php echo base_url(); ?>/dist/js/adminlte.js?v=3.2.0"></script>

    <script src="<?php echo base_url(); ?>/dist/js/pages/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('customerChart').getContext('2d');
        var orderChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday',
                ],
                datasets: [{
                    label: 'New Customers',
                    backgroundColor: '#1C6DD0',
                    borderColor: '#1C6DD0',
                    data: [<?php echo $count_customer[0] ?>, <?php echo $count_customer[1] ?>, <?php echo $count_customer[2] ?>, <?php echo $count_customer[3] ?>, <?php echo $count_customer[4] ?>, <?php echo $count_customer[5] ?>, <?php echo $count_customer[6] ?>],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'nearest',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Days'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Customers'
                        },
                        min: 0,
                        ticks: {
                            stepSize: 5
                        }
                    }
                },
            }
        });
    </script>
</body>

</html>