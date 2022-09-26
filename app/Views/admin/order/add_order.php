<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Add an Order</title>

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

        <?php if (session()->getFlashdata('insertFailed')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Failed to Add Order, Please Try Again!',
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
                            <?php if (isset($customer_id)) : ?>
                                <h1 class="m-0">Order for <?php echo $customer['name'] ?></h1>
                            <?php else : ?>
                                <h1 class="m-0">Orders</h1>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="<?php echo base_url("/admin/order"); ?>">Orders</a></li>
                                <li class="breadcrumb-item active">Add an Order</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <div align="center">
                                <b>Click The Products Below to Make an Order</b> <br>
                                <span>Scroll Down to See More Products</span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="max-height: 480px; overflow-y: auto;">
                            <div class="row row-cols-1 row-cols-md-3">
                                <?php for ($i = 0; $i < count($product); $i++) : ?>
                                    <div class="col mb-4">
                                        <div class="card" style="margin:0; padding:20px; cursor:pointer; background-color: #F8F7F3;" onclick="addRow(<?php echo $i ?>)">
                                            <div>
                                                <?php if (!empty($product[$i]['picture'])) : ?>
                                                    <div class="card-body" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; margin: auto; padding:0;">
                                                        <img src="<?php echo base_url('/uploads/product') . '/' . $product[$i]['picture'] ?>" class="img-fluid" style="min-width:150px; min-height:150px; max-width:150px; max-height:150px; width:100%;height:100%;object-fit:contain;" />
                                                    </div>
                                                <?php else : ?>
                                                    <div>
                                                        <img src="<?php echo base_url('/assets/no_image.jpg'); ?>" class="img-fluid" width="275" height="400" />
                                                    </div>
                                                <?php endif; ?>
                                                <div style="padding:10px 0 0">
                                                    <div class="text-center">
                                                        <h5 class="text-bold"><?php echo $product[$i]['name'] ?></h5>
                                                    </div>
                                                    <div>
                                                        <span><?= $product[$i]['price'] ?></span>
                                                        <input id="product_name<?php echo $i ?>" type="hidden" value="<?php echo $product[$i]['name'] ?>">
                                                        <input id="product_id<?php echo $i ?>" type="hidden" value="<?php echo $product[$i]['id'] ?>">
                                                        <input id="product_price<?php echo $i ?>" type="hidden" value="<?php echo $product[$i]['price'] ?>">
                                                        <input id="product_stock<?php echo $i ?>" type="hidden" value="<?php echo $product[$i]['quantity'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <!-- Table Card -->
                    <form method="POST" action="<?php echo base_url('admin/add_order'); ?>">
                        <div class="card">
                            <div class="card-header">
                                <div align="center">
                                    <b>Order Table</b>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered dataTable table-sm" id="order-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Product ID</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Product Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <?php if (isset($customer_id)) : ?>
                                    <div class="form-group col-3">
                                        <label for="inputPoints">Claim Points</label>
                                        <input type="number" id="inputPoints" name="order_points" min="0" max="<?php echo $customer['point'] ?>" class="form-control" required>
                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-success fa-pull-right">Add Order</button>
                                <input type="hidden" id="list_order" name="list_id">
                            </div>
                        </div>
                    </form>
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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>

    <script>
        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            getCellValues();
        }

        function addRow(id) {
            let productId = document.getElementById("product_id" + id).value;
            let name = document.getElementById("product_name" + id).value;
            let price = document.getElementById("product_price" + id).value;
            let stock = document.getElementById("product_stock" + id).value;

            if (document.getElementById("existing_name" + id)) {
                let qty_value = document.getElementById("product_qty" + id).value;
                if (parseInt(qty_value) >= stock) {
                    document.getElementById("product_qty" + id).value = qty_value;
                    swal({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Stock is Insufficient!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    qty_value = parseInt(qty_value) + 1;
                    document.getElementById("product_qty" + id).value = qty_value;
                    getCellValues();
                }
            } else {
                html = `<tr>
                    <td class="text-center">${productId}</td>
                    <td id="existing_name${id}" class="text-center">${name}</td>
                    <td class="text-right">${price}</td>
                    <td width="30px"><input id="product_qty${id}" name="product_qty[]" class="form-control" type="number" min="1" max="${stock}" onKeyDown="return false" value=1></td>
                    <td class="text-center" width="90px"><button type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>`;
                $('#order-table').append(html);
                getCellValues();
            }
        }

        function getCellValues() {
            let list_order_arr = [];
            var table = document.getElementById('order-table');
            for (var r = 1, n = table.rows.length; r < n; r++) {
                let id = table.rows[r].cells[0].innerHTML;
                list_order_arr.push(id);
            }
            document.getElementById("list_order").value = String(list_order_arr);
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