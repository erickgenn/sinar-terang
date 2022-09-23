<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Profit And Loss Report</title>

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

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url(); ?>/login/images/logos-02.png" alt="AdminLTELogo" height="260" width="260">
        </div>

        <?php include(APPPATH . "Views/layout/aside.php"); ?>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Profit And Loss Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profit And Loss Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h4> Filter </h4>
                            <div class="container col-4">
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="start_date">Month</label>
                                        <input type="month" class="form-control" name='month' id='month' required>
                                    </div>
                                    <div style="margin: 32px 0 0 10px">
                                        <button onclick="generateTable()" class="btn btn-success fa-pull-right">Find</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="align-content:flex-end">
                            <table id="pnl-table" class="table table-borderless" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Description</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right">Expenses Total:</th>
                                        <th></th>
                                        <th class="text-right" id="th-expenses"></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right">Net Profit:</th>
                                        <th></th>
                                        <th class="text-right" id="th-profit"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- /.card-body -->
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
    <link rel="stylesheet" href="<?php echo base_url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">

    <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url('/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>

    <script>
        function generateTable() {
            let month = Date.parse($('#month').val());

            if ($('#month').val() === "") {
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please Select Month Correctly!',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                let tabel = $('#pnl-table').DataTable();
                tabel.destroy();
                $('#pnl-table').DataTable({
                    paging: false,
                    info: false,
                    "searching": false,
                    ordering: false,
                    dom: 'Bfrtip',
                    "ajax": {
                        "url": "<?php echo base_url('admin/finance/profit_loss/search'); ?>",
                        "data": {
                            month: $('#month').val(),
                        },
                        "dataSrc": ""
                    },
                    "columns": [{
                            sortable: false,
                            width: "70px",
                            data: null,
                            "className": "dt-center",
                            name: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            orderable: false,
                            width: "150px",
                            "data": "description",
                            "className": "dt-center",
                        },
                        {
                            orderable: false,
                            width: "150px",
                            "data": "expenses_desc",
                            "className": "dt-left",
                        },
                        {
                            orderable: false,
                            width: "200px",
                            "data": "amount1",
                            "className": "dt-body-right",
                        },
                        {
                            orderable: false,
                            width: "200px",
                            "data": "amount2",
                            "className": "dt-body-right",
                        },
                    ],
                });
            }
            getTotalExpenses();
        }
    </script>

    <script>
        function getTotalExpenses() {
            $.ajax({
                url: "<?php echo base_url('admin/finance/profit_loss/search/total/expenses'); ?>",
                "data": {
                    month: $('#month').val(),
                },
                success: function(result) {
                    result = result.split('"').join('');
                    $("#th-expenses").html(result);
                }
            });
            getNetProfit();
        }

        function getNetProfit() {
            $.ajax({
                url: "<?php echo base_url('admin/finance/profit_loss/search/total/profit'); ?>",
                "data": {
                    month: $('#month').val(),
                },
                success: function(result) {
                    result = result.split('"').join('');
                    $("#th-profit").html(result);
                }
            });
        }
    </script>
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
</body>

</html>