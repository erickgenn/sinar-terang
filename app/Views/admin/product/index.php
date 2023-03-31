<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Product</title>

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

        <?php if (session()->getFlashdata('insertSuccessful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Produk Berhasil Ditambah!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('activateProduct')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $product['name']; ?> Sekarang Tersedia!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deactivateProduct')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $product['name']; ?> Sekarang Tidak Tersedia!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deleteProduct')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $product['name']; ?> Berhasil Dihapus!',
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
                    title: 'Produk Berhasil Diubah!',
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
                            <h1 class="m-0">Produk</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Produk</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header">
                            <div class="float-right">
                                <a href="<?php echo base_url('/admin/add_product/'); ?>">
                                    <button type="button" class="btn btn-block btn-success"><i class="fa-solid fa-plus"></i> Tambah Produk</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="align-content:flex-end">
                            <table id="product-table" class="table table-striped table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Awal</th>
                                        <th>Harga Paling Rendah</th>
                                        <th>Jumlah Stok</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>

    <script>
        $(document).ready(function() {
            $('#product-table').DataTable({
                scrollX: true,
                "ajax": {
                    "url": "<?php echo base_url('admin/product/search'); ?>",
                    "dataSrc": ""
                },
                "columns": [{
                        searchable: false,
                        sortable: false,
                        data: null,
                        name: null,
                        "className": "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "code",
                        "width": "130",
                        "className": "dt-center"
                    },
                    {
                        "data": "name",
                        "width": "130",
                        sortable: false,
                        "className": "dt-center"
                    },
                    {
                        "data": "price",
                        "width": "150",
                        searchable: false,
                        sortable: false,
                        "className": "dt-body-right dt-head-center"

                    },
                    {
                        "data": "price_low",
                        "width": "150",
                        searchable: false,
                        sortable: false,
                        "className": "dt-body-right dt-head-center"

                    },
                    {
                        data: null,
                        name: null,
                        "className": "dt-center",
                        "width": "100",
                        searchable: false,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            if (row.quantity <= 10) {
                                return `<h3 style="color:#990000">` + row.quantity + `</h3>`;
                            } else {
                                return row.quantity;
                            }
                        }
                    },
                    {
                        data: null,
                        "className": "dt-center",
                        name: null,
                        searchable: false,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            switch (row.is_active) {
                                case "1":
                                    return `<a type="button" href="<?php echo base_url('admin/product/deactivate') ?>/` + row.id + `" class="btn btn-block btn-success">Active</a>`;
                                    break;
                                case "0":
                                    return `<a type="button" href="<?php echo base_url('admin/product/activate') ?>/` + row.id + `" class="btn btn-block btn-danger">Inactive</a>`;
                                    break;
                                default:
                                    return `-`;
                                    break;
                            }
                        }
                    },
                    {
                        data: null,
                        "className": "dt-center",
                        "width": "11%",
                        name: null,
                        searchable: false,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return `<a href="<?php echo base_url('admin/product/view') ?>/${row.id}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form method='POST' action='<?php echo base_url('admin/product/delete') ?>/${row.id}' style='display: unset;'>
                                            <button type='submit' class='btn btn-danger' onclick="return confirm('Are You Sure You Want To Delete This Product?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
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