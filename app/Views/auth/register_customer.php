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
	<link rel="stylesheet" type="text/css" href="/register/css/util.css">
	<link rel="stylesheet" type="text/css" href="/register/css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">

		<div class="container-login100">
			<div style="background-color: #D5CFA3;" class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/login/images/logos-02.png" alt="IMG">
				</div>

				<form action="<?php echo base_url("/login/admin/auth") ?>" method="POST" enctype="multipart/form-data" class="login100-form validate-form">

					<span class="login100-form-title">
						Register Your Account
					</span>

					<div class="wrap-input100 validate-input" data-validate="Fullname is required">
						<input class="input100" type="text" name="full_name" placeholder="Fullname">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-users" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Phone number is required">
						<input class="input100" type="text" name="phone" placeholder="Phone Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.com">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password Confirmation is required">
						<input class="input100" type="password" name="confirm_password" placeholder=" Confirm Your Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>


					<div class="text-center p-t-136">

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