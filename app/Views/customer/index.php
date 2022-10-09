<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sinar Terang</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="/customer_page/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="/customer_page/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="/customer_page/css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="/customer_page/css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="/customer_page/fonts/flaticon/font/flaticon.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="/customer_page/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/customer_page/css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="/customer_page/css/style.css?v=1.10">

	<!-- Modernizr JS -->
	<script src="/customer_page/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>

		<?php include(APPPATH . "Views/layout/aside_cust.php"); ?>

		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<?php if (session()->getFlashdata('login_successful')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'https://cdn.dribbble.com/users/400493/screenshots/2703191/hello.gif',
					buttons: false,
					closeOnClickOutside: false,
					timer: 2500,
					title: "Hi! <?php echo $_SESSION['login_successful'] ?>",
					text: "Glad to see you again!",
				});
			</script>
		<?php endif; ?>

		<?php if (session()->getFlashdata('logout_successful')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'https://cdn.dribbble.com/users/253590/screenshots/6058509/media/6d657daf5316f4926a71c4c564371305.gif',
					buttons: false,
					closeOnClickOutside: false,
					timer: 2500,
					title: "Bye-Bye!",
					text: "Sad to see you go",
				});
			</script>
		<?php endif; ?>

		<?php if (session()->getFlashdata('qr_claimed')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'https://cdn.dribbble.com/users/2050145/screenshots/5486129/sad_face.gif',
					buttons: false,
					closeOnClickOutside: false,
					timer: 2500,
					title: "Oops!",
					text: "This QR Has Been Claimed Before",
				});
			</script>
		<?php endif; ?>



		<div id="colorlib-main">
			<aside id="colorlib-hero" class="js-fullheight">
				<div class="flexslider js-fullheight">
					<ul class="slides">
						<li style="background-image: url(/customer_page/images/img_bg_1.jpg);">
							<div class="overlay"></div>
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 js-fullheight slider-text">
										<div class="slider-text-inner">
											<div class="desc">
												<h1>Welcome!</h1>
												<h2>We only sell high quality home furnitures!</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li style="background-image: url(/customer_page/images/img_bg_2.jpg);">
							<div class="overlay"></div>
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 js-fullheight slider-text">
										<div class="slider-text-inner">
											<div class="desc">
												<h1>Welcome!</h1>
												<h2>We only sell high quality home furnitures!</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li style="background-image: url(/customer_page/images/img_bg_3.jpg);">
							<div class="overlay"></div>
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 js-fullheight slider-text">
										<div class="slider-text-inner">
											<div class="desc">
												<h1>Welcome!</h1>
												<h2>We only sell high quality home furnitures!</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</aside>



		</div>
	</div>

	<!-- jQuery -->
	<script src="/customer_page/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="/customer_page/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="/customer_page/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="/customer_page/js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="/customer_page/js/jquery.flexslider-min.js"></script>
	<!-- Sticky Kit -->
	<script src="/customer_page/js/sticky-kit.min.js"></script>
	<!-- Owl carousel -->
	<script src="/customer_page/js/owl.carousel.min.js"></script>
	<!-- Counters -->
	<script src="/customer_page/js/jquery.countTo.js"></script>


	<!-- MAIN JS -->
	<script src="/customer_page/js/main.js"></script>

</body>

</html>