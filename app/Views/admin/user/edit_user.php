<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sinar Terang | Edit User</title>

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

        <?php if (session()->getFlashdata('updateFailed')) : ?>
            <script>
                swal({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Failed to Update, Please Try Again!',
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
                                <li class="breadcrumb-item"><a href="<?php echo base_url("/admin/user"); ?>">Users Management</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">

                    <section class="content">
                        <form method="POST" action="<?php echo base_url('admin/edit_user') . '/' . $id ?>" name="faq_form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: #D5CFA3;">
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="text" id="inputName" name="user_name" class="form-control" value="<?php echo $user['name']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAnswer">Email</label>
                                                <input type="email" id="inputEmail" name="user_email" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="inputRole">Role</label>
                                                <select class="form-control" name="user_role" required>
                                                    <option value="<?php echo $user['role']; ?>" selected>
                                                        <?php
                                                        switch ($user['role']) {
                                                            case "owner":
                                                                echo "Owner";
                                                                break;
                                                            case "admin":
                                                                echo "Admin";
                                                                break;
                                                            case "manager":
                                                                echo "Manager";
                                                                break;
                                                        }
                                                        ?>
                                                    </option>
                                                    <option value="owner">Owner</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="manager">Manager</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success float-right">Edit User</button>
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

    <script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url('/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#inputQuestion'), {
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList']
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#inputAnswer'), {
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList']
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function checker(e) {
            var password = document.getElementById('inputPassword').value;
            var confirm = document.getElementById('inputConfirmPassword').value;
            if (password != confirm) {
                document.getElementById('div_password').style.display = "block";
                return false;
            } else {
                return true;
            }
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