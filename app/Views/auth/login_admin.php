<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sinar Terang | Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/login_admin/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login_admin/css/util.css">
	<link rel="stylesheet" type="text/css" href="/login_admin/css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">

		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<?php if (session()->getFlashdata('login_failed')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'error',
					title: 'Email or Password is Incorrect!',
					showConfirmButton: false,
					timer: 1500
				});
			</script>
		<?php endif; ?>

		<?php if (session()->getFlashdata('email_sent')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'success',
					title: 'Please Check Your Email',
					showConfirmButton: false,
					timer: 1800
				});
			</script>
		<?php endif; ?>

		<?php if (session()->getFlashdata('password_changed')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'success',
					title: 'Your Password Has Been Changed!',
					showConfirmButton: false,
					timer: 1800
				});
			</script>
		<?php endif; ?>

		<?php if (session()->getFlashdata('email_failed')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'error',
					title: 'Email Failed to Be Sent, Please Try Again!',
					showConfirmButton: false,
					timer: 1800
				});
			</script>
		<?php endif; ?>

		<div class="container-login100" style="background-color: #0d152d;">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(/login_admin/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Selamat Datang!
					</span>
					<span style="font-size: 1.5em; color: white;">
						Sinar Terang Admin
					</span>
				</div>

				<form action="<?php echo base_url("/login/admin/auth") ?>" method="POST" enctype="multipart/form-data" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Masukkan email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Masukkan password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-10">
						<div>
							<p class="txt1">
								Lupa password?
								<a href="<?php echo base_url('forgot_password/admin/index'); ?>" class="txt1">
									Klik Disini
								</a>
							</p>
						</div>
					</div>
					<br>
					<br>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="/login_admin/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="/login_admin/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="/login_admin/vendor/bootstrap/js/popper.js"></script>
	<script src="/login_admin/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="/login_admin/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="/login_admin/vendor/daterangepicker/moment.min.js"></script>
	<script src="/login_admin/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="/login_admin/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="/login_admin/js/main.js"></script>

</body>

</html>