<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

        <div class="card ">

            <!-- Modal content-->
            <div class="card-content">
                <div id="invoice" class="card-body">
                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <img src="<?php echo base_url(); ?>/assets/logos-02.png" alt="Sinar Terang" class="brand-image" style="max-height:40px;"> Sinar Terang
                                    <small id="invoice_date" class="float-right">Date: <?php echo $order['created_at']; ?></small>
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
                                <img src="<?php echo base_url() ?>/dist/img/credit/visa.png" alt="Visa">
                                <img src="<?php echo base_url() ?>/dist/img/credit/mastercard.png" alt="Mastercard">
                                <img src="<?php echo base_url() ?>/dist/img/credit/qris.png" alt="QRIS" style="max-height: 39px;">
                                <p class="lead">Scan the QR Code to Get Points!</p>
                                <img id='barcode' alt="" title="" width="150" height="150" />
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    No Refunds. Except as expressly provided herein, all payments under this Agreement will be non-refundable and non-exchangeable.
                                </p>
                            </div>

                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Total:</th>
                                                <td id="invoice_total_price" class="text-right"><?php echo $order['total_price']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <div class="row no-print">
                            <div class="col-12">
                                <a href="<?php echo base_url('admin/order'); ?>" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    Done
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

    <script type="text/javascript">
        function generateBarCode() {
            var nric = $('#text').val();
            var url = 'https://api.qrserver.com/v1/create-qr-code/?data=<?php echo base_url('qr') . '/' . $encrypt_qr; ?>&amp;size=50x50';
            $('#barcode').attr('src', url);
        }
    </script>
    <script>
        $(document).ready(function() {
            generateBarCode();
            $('#detail-table').DataTable({
                scrollX: true,
                "paging": false,
                "info": false,
                "searching": false,
                "ajax": {
                    "url": `<?php echo base_url('admin/order/search_detail') . '/' . $id; ?>`,
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
            setTimeout(function() {
                window.print();
            }, 3500);
        });
    </script>

    <script>
        function detailTable(date, id, total_price) {
            document.getElementById('invoice_date').innerText = "Date: " + date;
            document.getElementById('invoice_total_price').innerText = total_price;

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