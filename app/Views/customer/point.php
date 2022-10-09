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
	<link rel="stylesheet" href="<?php echo base_url(); ?>/customer_page/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/customer_page/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/customer_page/css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/customer_page/css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/customer_page/fonts/flaticon/font/flaticon.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/customer_page/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/customer_page/css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="/customer_page/css/style.css?v=1.10">

	<!-- Modernizr JS -->
	<script src="/customer_page/js/modernizr-2.6.2.min.js"></script>

	<script src="https://kit.fontawesome.com/6938e8f442.js" crossorigin="anonymous"></script>

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

		<?php if (session()->getFlashdata('claim_success')) : ?>
			<script>
				swal({
					position: 'top-end',
					icon: 'https://cdn.dribbble.com/users/2050145/screenshots/5485422/head_dribbble.gif',
					buttons: false,
					closeOnClickOutside: false,
					timer: 3500,
					title: "Claim Success!",
					text: "This QR Has Been Claimed Before",
				});
			</script>
		<?php endif; ?>

		<div id="colorlib-main">

			<div class="colorlib-about">
				<div class="colorlib-narrow-content">
					<div class="row row-bottom-padded-md">
						<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
							<div class="about-desc">
								<span class="heading-meta"><?php echo $customer['name'] ?>'s Points</span>
								<h2 class="colorlib-heading colorlib-counter js-counter" data-from="0" data-to="<?php echo $customer['point'] ?>" data-speed="1500" data-refresh-interval="50" style="font-size: 27px;"></h2>
								<p>You can earn points by scanning the QR codes provided on your order bills</p>
								<p>These points can be exchanged as a discount for your next orders.</p>
							</div>
							<div class="row padding">
								<h2 class="colorlib-heading" style="margin-bottom: 3rem;">Points History</h2>
								<div class="col-md-12" style="max-height:290px;overflow-y: scroll;overflow-x: hidden;">
									<?php for ($i = 0; $i < count($point); $i++) : ?>
										<div class="info-box" style=" margin-top:1.2rem">
											<span class="info-box-icon bg-warning"><i class="fa-solid fa-coins"></i></span>
											<div class="info-box-content">
												<span class="info-box-text"><?php echo $point[$i]['operation'] ?> <?php echo $point[$i]['point'] ?></span>
												<span class="info-box-number"><?php echo $point[$i]['created_at'] ?></span>
											</div>
										</div>
									<?php endfor; ?>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="about-img animate-box" data-animate-effect="fadeInLeft" style="background-image: url(/customer_page/images/point.jpg);">
							</div>
						</div>
					</div>
				</div>
			</div>


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