<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Users Management</title>

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

        <?php if (session()->getFlashdata('updateSuccessful')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User Updated Successfuly!',
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
                    title: 'User Added Successfuly!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('activateuser')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $user['name']; ?> Is Now Active!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deactivateuser')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: '<?php echo $user['name']; ?> Is Now Not Active!',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('deleteOutlet')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User Deleted Successfuly!',
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
                            <h1 class="m-0">Users Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/dashboard"); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users Management</li>
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
                                <a href="<?php echo base_url('/admin/add_user/'); ?>">
                                    <button type="button" class="btn btn-block btn-success"><i class="fa-solid fa-plus"></i> Add a User</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" style="align-content:flex-end">
                            <table id="user-table" class="table table-striped table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Joined Since</th>
                                        <th>Status</th>
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
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>

    <script>
        $(document).ready(function() {

            $('#user-table').DataTable({
                scrollX: true,
                "ajax": {
                    "url": "<?php echo base_url('admin/user/search'); ?>",
                    "dataSrc": ""
                },
                "columns": [{
                        searchable: false,
                        sortable: false,
                        data: null,
                        "width": "70",
                        name: null,
                        "className": "dt-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "data": "name",
                        "className": "dt-center",
                    },
                    {
                        "data": "email",
                        "className": "dt-center",
                        "width": "200"
                    },
                    {
                        data: null,
                        name: null,
                        "className": "dt-center",
                        sortable: false,
                        render: function(data, type, row, meta) {
                            switch (row.role) {
                                case "owner":
                                    return `Owner`;
                                    break;
                                case "admin":
                                    return `Admin`;
                                    break;
                                case "manager":
                                    return `Manager`;
                                    break;
                                default:
                                    return `-`;
                                    break;
                            }
                        }
                    },
                    {
                        "data": "created_at",
                        "className": "dt-center",
                        "width": "200"
                    },
                    {
                        data: null,
                        name: null,
                        "className": "dt-center",
                        sortable: false,
                        render: function(data, type, row, meta) {
                            switch (row.is_active) {
                                case "1":
                                    return `<a type="button" href="<?php echo base_url('admin/user/deactivate') ?>/` + row.id + `" class="btn btn-block btn-success">Active</a>`;
                                    break;
                                case "0":
                                    return `<a type="button" href="<?php echo base_url('admin/user/activate') ?>/` + row.id + `" class="btn btn-block btn-danger">Inactive</a>`;
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
                        "width": "12%",
                        name: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            if (<?php echo $count; ?> <= 1) {
                                return `<a href="<?php echo base_url('admin/user/view') ?>/${row.id}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                        `;
                            } else if (<?php echo $_SESSION['id'] ?> == row.id) {
                                return `<a href="<?php echo base_url('admin/user/view') ?>/${row.id}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                        `;
                            } else {
                                return `<a href="<?php echo base_url('admin/user/view') ?>/${row.id}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form method='POST' action='<?php echo base_url('admin/user/delete') ?>/${row.id}' style='display: unset;'>
                                            <button type='submit' class='btn btn-danger' onclick="return confirm('Are You Sure You Want To Delete This User?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        `;
                            }
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