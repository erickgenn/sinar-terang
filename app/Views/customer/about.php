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
	<link rel="stylesheet" href="/customer_page/css/style.css">

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

		<div id="colorlib-main">

			<div class="colorlib-about">
				<div class="colorlib-narrow-content">
					<div class="row row-bottom-padded-md">
						<div class="col-md-6">
							<div class="about-img animate-box" data-animate-effect="fadeInLeft" style="background-image: url(/customer_page/images/img_bg_2.jpg);">
							</div>
						</div>
						<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
							<div class="about-desc">
								<span class="heading-meta">Selamat Datang!</span>
								<h2 class="colorlib-heading">Siapa Kami?</h2>
								<p>Sinar Terang didirikan sejak tahun 2004.</p>
								<p>Sinar Terang hanya menjual perabot rumah tangga dengan kualitas tinggi. Kami dengan sangat bangga memperkenalkan perabot rumah tangga yang indah dengan harga yang murah.</p>
							</div>
							<div class="row padding">
								<div class="col-md-4 no-gutters animate-box" data-animate-effect="fadeInLeft">
									<a class="steps active">
										<p class="icon"><span><i class="icon-check"></i></span></p>
										<h3>Kualitas <br>Baik</h3>
									</a>
								</div>
								<div class="col-md-4 no-gutters animate-box" data-animate-effect="fadeInLeft">
									<a class="steps active">
										<p class="icon"><span><i class="icon-check"></i></span></p>
										<h3>Terjangkau</h3>
									</a>
								</div>
								<div class="col-md-4 no-gutters animate-box" data-animate-effect="fadeInLeft">
									<a class="steps active">
										<p class="icon"><span><i class="icon-check"></i></span></p>
										<h3>Dapat <br>Diandalkan</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
							<h2 class="colorlib-heading">FAQ</h2>
							<p>Frequently Asked Questions.</p>
						</div>
						<div class="col-md-8 animate-box" data-animate-effect="fadeInRight">
							<div class="fancy-collapse-panel">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<?php for ($i = 0; $i < count($faq); $i++) : ?>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="heading<?php echo $i ?>">
												<h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ?>" aria-expanded="false" aria-controls="collapse<?php echo $i ?>"><?php echo strip_tags($faq[$i]['question']); ?>
													</a>
												</h4>
											</div>
											<div id="collapse<?php echo $i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i ?>">
												<div class="panel-body">
													<p><?php echo $faq[$i]['answer'] ?></p>
												</div>
											</div>
										</div>
									<?php endfor; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div id="colorlib-counter" class="colorlib-counters" style="background-image: url(/customer_page/images/about-info.jpg);" data-stellar-background-ratio="0.5">
				<div class="overlay"></div>
				<div class="colorlib-narrow-content">
					<div class="row">
					</div>
					<div class="row">
						<div class="col-md-4 text-center animate-box">
							<span class="icon"><i class="fa-solid fa-couch"></i></span>
							<span class="colorlib-counter js-counter" data-from="0" data-to="<?php echo $count_product ?>" data-speed="1500" data-refresh-interval="50"></span>
							<span class="colorlib-counter-label">Products</span>
						</div>
						<div class="col-md-4 text-center animate-box">
							<span class="icon"><i class="fa-solid fa-shop"></i></span>
							<span class="colorlib-counter js-counter" data-from="0" data-to="<?php echo $count_outlet ?>" data-speed="1500" data-refresh-interval="50"></span>
							<span class="colorlib-counter-label">Stores</span>
						</div>
						<div class="col-md-4 text-center animate-box">
							<span class="icon"><i class="fa-solid fa-user-group"></i></span>
							<span class="colorlib-counter js-counter" data-from="0" data-to="<?php echo $count_order ?>" data-speed="1500" data-refresh-interval="50"></span>
							<span class="colorlib-counter-label">Orders</span>
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