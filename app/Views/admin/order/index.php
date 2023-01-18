<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Orders</title>

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

    <link href="<?php echo base_url(); ?>/plugins/select2/css/select2.css" rel="stylesheet" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url(); ?>/login/images/logos-02.png" alt="AdminLTELogo" height="260" width="260">
        </div>

        <?php include(APPPATH . "Views/layout/aside.php"); ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <?php if (session()->getFlashdata('insertSuccessful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Order Added Successfuly!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('activateOutlet')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $outlet['name']; ?> Is Now Open!',
                    showConfirmButton: false,
                    timer: 1700
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deactivateOutlet')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $outlet['name']; ?> Is Now Closed!',
                    showConfirmButton: false,
                    timer: 1700
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deleteOutlet')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $outlet['name']; ?> Is Successfuly Deleted!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('updateSuccessful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Outlet Updated Successfuly!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('cancelSuccessful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cancel Request Sent!',
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
                            <h1 class="m-0">Orders</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Orders</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-12">
                                <div class="float-right col-2">
                                    <a type="button" class="btn btn-block btn-success" href="<?php echo base_url('/admin/add_order/'); ?>"><i class="fa-solid fa-plus"></i> Non Member Order</a>
                                </div>
                                <div class="float-right col-2">
                                    <button type='button' class='btn btn-block btn-success' data-toggle="modal" data-target="#memberModal"><i class="fa-solid fa-plus"></i> Member Order</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="align-content:flex-end">
                            <table id="order-table" class="table table-striped table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Order ID</th>
                                        <th class="text-center">Total Price</th>
                                        <th>Order Date</th>
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

        <!-- Invoice Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="invoice" class="modal-body">
                        <div class="invoice p-3 mb-3">

                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <img src="<?php echo base_url(); ?>/assets/logos-02.png" alt="Sinar Terang" class="brand-image" style="max-height:40px;"> Sinar Terang
                                        <small id="invoice_date" class="float-right"></small>
                                    </h4>
                                </div>

                            </div>

                            <div class="row">
                                <div class="card-body table-responsive" style="align-content:flex-end">
                                    <table id="detail-table" class="table table-striped table-bordered table-sm" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Product Name</th>
                                                <th class="text-center">Price per Unit @ Rp</th>
                                                <th>Quantity</th>
                                                <th class="text-center">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <p class="lead">Payment Methods:</p>
                                    <img src="<?php echo base_url() ?>/dist/img/credit/visa.png" alt="Visa">
                                    <img src="<?php echo base_url() ?>/dist/img/credit/mastercard.png" alt="Mastercard">
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        No Refunds. Except as expressly provided herein, all payments under this Agreement will be non-refundable and non-exchangeable.
                                    </p>
                                </div>

                                <div class="col-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Discount:</th>
                                                    <td id="invoice_discount" class="text-right"></td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td id="invoice_total_price" class="text-right"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-print">
                                <div class="col-12">
                                    <a id="print_button" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-print"></i> Print
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Membership Modal -->
        <div id="memberModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form method="POST" action="<?php echo base_url('/admin/add_order/member'); ?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Membership Order</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm">
                                <label>Select Customer</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control" id="customer_id" name="cust_id" style="height:100%; width:70%;">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
    <script src="<?php echo base_url(); ?>/plugins/select2/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#order-table').DataTable({
                "language": {
                    "zeroRecords": "No Order Yet, Please Make an Order :)",
                },
                scrollX: true,
                "ajax": {
                    "url": "<?php echo base_url('admin/order/search'); ?>",
                    "dataSrc": ""
                },
                "columns": [{
                        searchable: false,
                        sortable: false,
                        data: null,
                        "width": "60",
                        name: null,
                        "className": "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "id",
                        "className": "dt-center",
                        "width": "190"
                    },
                    {
                        "data": "total_price",
                        "className": "dt-body-right",
                        "width": "200"
                    },
                    {
                        "data": "created_at",
                        "className": "dt-center",
                        "width": "200"
                    },
                    {
                        data: null,
                        "className": "dt-center",
                        "width": "12%",
                        name: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            var date = new Date(row.created_at);
                            var current_date = new Date();
                            var row_month = date.toLocaleString('default', {
                                month: 'long'
                            });;
                            var row_year = date.getFullYear();

                            var current_month = current_date.toLocaleString('default', {
                                month: 'long'
                            });;

                            var current_year = current_date.getFullYear();

                            var current = current_year + "-" + current_month;
                            var row_date = row_year + "-" + row_month;

                            if (row_date != current) {
                                return `<button type="button" onclick="detailTable('${row.created_at}', '${row.id}', '${row.total_price}')" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa-solid fa-eye"></i></button>`;
                            }
                            if (row_date == current) {
                                switch (row.request_cancel) {
                                    case "0":
                                        return `<button type="button" onclick="detailTable('${row.created_at}', '${row.id}', '${row.total_price}', '${row.discount}')" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa-solid fa-eye"></i></button>
                                    <button type='button' onclick="getOrderID('${row.id}')" class='btn btn-danger' data-toggle="modal" data-target="#cancelModal"><i class="fa-solid fa-trash"></i></button>
                                    
                                    <!-- Cancel Modal -->
                                    <form method="POST" action="<?php echo base_url('admin/order/request_cancel'); ?>">
                                        <div id="cancelModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Cancel Order</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body" style="width:100%">
                                                        <p>Why do you want to <b>cancel</b> this order?</p>
                                                        <textarea style="width:70%" name="cancel_reason"></textarea>
                                                        <input type="hidden" id="order_id_hidden" name="order_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    `;
                                        break;
                                    case "1":
                                        return `<button type="button" onclick="detailTable('${row.created_at}', '${row.id}', '${row.total_price}')" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa-solid fa-eye"></i></button>`;
                                        break;
                                    default:
                                        return `-`;
                                        break;
                                }
                            }
                        }
                    },
                ]
            });

            $('#customer_id').select2({
                placeholder: 'Choose Customer',
                width: 'resolve',
                ajax: {
                    dataType: 'json',
                    url: '<?php echo base_url("admin/order/search/customer"); ?>',
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data, page) {
                        return {
                            results: data
                        };
                    },
                }
            })
        });
    </script>

    <script>
        function detailTable(date, id, total_price, discount) {
            document.getElementById('invoice_date').innerText = "Date: " + date;
            document.getElementById('invoice_total_price').innerText = total_price;
            document.getElementById('invoice_discount').innerText = "- " + discount;
            document.getElementById('print_button').href = "<?php echo base_url('admin/order/print'); ?>/" + id;

            $('#detail-table').DataTable().clear();
            $('#detail-table').DataTable().destroy();
            $('#detail-table').DataTable({
                scrollX: true,
                "paging": false,
                "info": false,
                "searching": false,
                "ajax": {
                    "url": `<?php echo base_url('admin/order/search_detail'); ?>/${id}`,
                    "dataSrc": ""
                },
                "columns": [{
                        searchable: false,
                        sortable: false,
                        data: null,
                        "width": "60",
                        name: null,
                        "className": "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "product_name",
                        "className": "dt-center",
                        "width": "170"
                    },
                    {
                        "data": "product_price",
                        "className": "dt-body-right",
                        "width": "170"
                    },
                    {
                        "data": "quantity",
                        "className": "dt-center",
                        "width": "80"
                    },
                    {
                        "data": "amount",
                        "className": "dt-body-right",
                        "width": "100"
                    },

                ]
            });
        }

        function getOrderID(order_id) {
            document.getElementById('order_id_hidden').value = order_id;
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