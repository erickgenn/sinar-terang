<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sinar Terang | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/login/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="/login/css/main.css">
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
					title: 'Email atau Password Salah!',
					showConfirmButton: false,
					timer: 1600
				});
			</script>
		<?php endif; ?>

		<?php if (session()->getFlashdata('registration_successful')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'success',
					title: 'Registrasi Berhasil!',
					showConfirmButton: false,
					timer: 1800
				});
			</script>
		<?php endif; ?>

		<?php if (session()->getFlashdata('email_sent')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'success',
					title: 'Mohon Periksa Emailmu!',
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
					title: 'Passwordmu Berhasil Diubah!',
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
					title: 'Email Gagal Dikirim, Mohon Coba Lagi!',
					showConfirmButton: false,
					timer: 1800
				});
			</script>
		<?php endif; ?>

		<div class="container-login100">
			<div style="background-color: #D5CFA3;" class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/login/images/logos-02.png" alt="IMG">
				</div>

				<form action="<?php echo base_url("/login/auth") ?>" method="POST" enctype="multipart/form-data" class="login100-form validate-form">

					<span class="login100-form-title">
						Selamat Datang!
					</span>
					<div class="wrap-input100 validate-input" data-validate="Email valid diperlukan: ex@abc.com">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password dibutuhkan">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Lupa Passwordmu?
						</span>
						<a class="txt2" href="<?php echo base_url('forgot_password/customer/index'); ?>">
							Klik Disini
						</a>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Apakah Anda Admin?
						</span>
						<a class="txt2" href="<?php echo base_url("login/admin"); ?>">
							Klik Disini
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="<?php echo base_url("register/customer"); ?>">
							Buat Akun Baru
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="/login/vendor/bootstrap/js/popper.js"></script>
	<script src="/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="/login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="/login/vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="/login/js/main.js"></script>

</body>

</html>