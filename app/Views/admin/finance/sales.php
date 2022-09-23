<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Sales Report</title>

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

        <?php if (session()->getFlashdata('updateSuccessful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Vendor Updated Successfuly!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('insertSuccessful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Vendor Added Successfuly!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('activatevendor')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Vendor <?php echo $vendor['name']; ?> Is Now Active!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deactivatevendor')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Vendor <?php echo $vendor['name']; ?> Is Now Not Active!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deleteVendor')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Vendor <?php echo $vendor['name']; ?> Deleted Successfuly!',
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
                            <h1 class="m-0">Sales Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Sales Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
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
                            <table id="sales-table" class="table table-striped table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align:right">Total:</th>
                                        <th id="th-total"></th>
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
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

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
                let tabel = $('#sales-table').DataTable();
                tabel.destroy();
                $('#sales-table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copyHtml5',
                            footer: true
                        },
                        {
                            extend: 'excelHtml5',
                            footer: true
                        },
                    ],
                    "ajax": {
                        "url": "<?php echo base_url('admin/finance/sales/search'); ?>",
                        "data": {
                            month: $('#month').val(),
                        },
                        "dataSrc": ""
                    },
                    "columns": [{
                            searchable: false,
                            sortable: false,
                            data: null,
                            "className": "dt-center",
                            name: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            "data": "created_at",
                            "className": "dt-center",
                        },
                        {
                            data: null,
                            name: null,
                            "className": "dt-center",
                            sortable: false,
                            render: function(data, type, row, meta) {
                                return `Order Number ` + row.id;
                            }
                        },
                        {
                            "data": "total_price",
                            "className": "dt-center",
                        },
                    ],
                });
            }
            getTotal();

        }
    </script>

    <script>
        function getTotal() {
            $.ajax({
                url: "<?php echo base_url('admin/finance/sales/search/total'); ?>",
                "data": {
                    month: $('#month').val(),
                },
                success: function(result) {
                    result = result.split('"').join('');
                    $("#th-total").html(result);
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