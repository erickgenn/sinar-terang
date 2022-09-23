<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Points Configuration</title>

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

<body class=" hold-transition sidebar-mini layout-fixed">
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
                    title: 'Points Configuration Updated Successfuly!',
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
                            <h1 class="m-0">Points Configuration</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Points Configuration</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <div class="card" style="max-height: 750px; overflow: hidden;">
                        <!-- /.card-header -->
                        <div id="" class="card-body table-responsive" style="align-content:flex-end; ">
                            <table id="config-table" class="table table-striped table-bordered table-sm" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Point</th>
                                        <th>Value</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#config-table').DataTable({
                "scrollY": "29vh",
                scrollCollapse: true,
                paging: true,
                buttons: [
                    'copyHtml5', 'excelHtml5'
                ],
                "ajax": {
                    "url": "<?php echo base_url('admin/point/config/search'); ?>",
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
                        "data": "name",
                        "className": "dt-center",
                    },
                    {
                        "data": "description",
                        "className": "dt-center",
                    },
                    {
                        "data": "point",
                        "className": "dt-center",
                    },
                    {
                        "data": "value",
                        "className": "dt-center",
                    },
                    {
                        "data": "date",
                        "className": "dt-center",
                    },
                    {
                        data: null,
                        "className": "dt-center",
                        "width": "11%",
                        name: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return `<a href="<?php echo base_url('admin/point/config/view') ?>/${row.id}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                    `;
                        }
                    },
                ]
            });

        });
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