<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Add Product</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../login/images/logos-02.png" alt="AdminLTELogo" height="260" width="260">
        </div>

        <?php include(APPPATH . "Views/layout/aside.php"); ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <?php if (session()->getFlashdata('insertFailed')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Failed to Add Product, Please Try Again!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('insertFailed')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Failed to Add Product, Please Try Again!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('ImageFailed')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Upload Image Failed! Please Try Another Image',
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
                            <h1 class="m-0">Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/product"); ?>">Products</a></li>
                                <li class="breadcrumb-item active">Add a Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">

                    <section class="content">
                        <form method="POST" action="<?php echo base_url('admin/add_product'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #D5CFA3;">
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="text" id="inputName" name="product_name" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputQuantity">Quantity</label>
                                                <input type="number" id="inputQuantity" name="product_quantity" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPrice">Price</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" id="inputPrice" name="product_price" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPicture">Picture</label>
                                                <input type="file" id="inputPicture" name="product_picture" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Description</label>
                                                <textarea id="inputDescription" name="product_description" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputOutlet">Select Outlet</label>
                                                <input type="hidden" id="outlet_id" name="product_outlet_id" class="form-control">
                                                <div class="card">
                                                    <div class="card-body p-0">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Outlet Name</th>
                                                                    <th style="text-align:right;">
                                                                        <input class="form-check-input" onClick="toggle(this)" type="checkbox">
                                                                        <label class=" form-check-label">Select All</label>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php for ($i = 0; $i < count($outlet); $i++) : ?>
                                                                    <tr>
                                                                        <td><?php echo $outlet[$i]['name']; ?></td>
                                                                        <td style="text-align:right;">
                                                                            <input id="checkboxes" class="form-check-input" type="checkbox" name="outlet_check[]" value="<?php echo $outlet[$i]['id']; ?>">
                                                                        </td>
                                                                    </tr>
                                                                <?php endfor; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" onclick="getChecked()" class="btn btn-success float-right">Add New Product</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <br>

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

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url('/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#inputDescription'), {
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList']
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('outlet_check[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        function getChecked() {
            var outlet_id = document.querySelectorAll('input[name="outlet_check[]"]:checked');

            var arr_id = [];

            for (var x = 0, l = outlet_id.length; x < l; x++) {
                arr_id.push(outlet_id[x].value);
            }

            var str = arr_id.join(',');
            document.getElementById('outlet_id').value = str;
        }
    </script>


    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../plugins/chart.js/Chart.min.js"></script>

    <script src="../plugins/sparklines/sparkline.js"></script>

    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>

    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="../plugins/summernote/summernote-bs4.min.js"></script>

    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="../dist/js/adminlte.js?v=3.2.0"></script>

    <script src="../dist/js/pages/dashboard.js"></script>
</body>

</html>