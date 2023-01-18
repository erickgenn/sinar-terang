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

		<div id="colorlib-main">
			<div class="colorlib-work">
				<div class="colorlib-narrow-content">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
							<h2 class="colorlib-heading">Produk Kami</h2>
						</div>
					</div>
					<div class="row row-bottom-padded-md">
						<?php for ($i = 0; $i < count($product); $i++) : ?>
							<div class="col-md-<?php echo $col_num[$i] ?> animate-box" data-animate-effect="fadeInLeft">
								<div class="project" style="background-image: url(<?php echo base_url('/uploads/product') . "/" . $product[$i]['picture'] ?>);">
									<div class="desc">
										<div class="con">
											<h2 style="font-color: white;"><a><?php echo $product[$i]['name'] ?></a></h2>
											<span><a style="color: white;"><?php echo $product[$i]['description'] ?></a></span>
											<br>
											<h3><a><?php echo $product[$i]['price'] ?></a></h3>
										</div>
									</div>
								</div>
							</div>
						<?php endfor; ?>
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