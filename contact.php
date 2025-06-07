<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
	$_SESSION["username"] = "user";
}
?>
<?php include 'csp.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- mobile metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<!-- site metas -->
	<title>RCInfotech</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- site icons -->
	<link rel="icon" href="images/logos/logo-1.png" type="image/gif" />
	<!-- bootstrap css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<!-- Site css -->
	<link rel="stylesheet" href="css/style.css" />
	<!-- responsive css -->
	<link rel="stylesheet" href="css/responsive.css" />
	<!-- colors css -->
	<link rel="stylesheet" href="css/colors1.css" />
	<!-- custom css -->
	<link rel="stylesheet" href="css/custom.css" />
	<!-- wow Animation css -->
	<link rel="stylesheet" href="css/animate.css" />
	<link rel="stylesheet" href="css/all.min.css">
	<!-- revolution slider css -->
	<link rel="stylesheet" type="text/css" href="revolution/css/settings.css" />
	<link rel="stylesheet" type="text/css" href="revolution/css/layers.css" />
	<link rel="stylesheet" type="text/css" href="revolution/css/navigation.css" />
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	  <![endif]-->
	<style>
		.button {
			font-size: 15px;
			font-weight: bold;
			border-radius: 5px;
		}

		.loader_animation {
			animation: none;
		}

		.grp_btn {
			margin-top: 13px;
		}

		/* Dropdown styles */
		.menu_side .first-ul li {
			position: relative;
		}

		.menu_side .first-ul li:hover .dropdown-menu {
			display: block;
		}

		.dropdown-menu {
			display: none;
			position: absolute;
			top: 100%;
			left: 0;
			background: #fff;
			min-width: 200px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			z-index: 1000;
			padding: 0;
			margin: 0;
			border-radius: 4px;
		}

		.dropdown-menu li {
			display: block;
			width: 100%;
		}

		.dropdown-menu li a {
			display: block;
			padding: 10px 15px;
			color: #333;
			text-decoration: none;
			transition: all 0.3s ease;
		}

		.dropdown-menu li a:hover {
			background: #039ee3;
			color: #fff;
		}

		.menu_side .first-ul li.shop-dropdown>a:after {
			content: '\f107';
			font-family: FontAwesome;
			margin-left: 5px;
		}

		.footer_mail-section .field input {
			max-width: 210px;
		}

		.float-right2 {
			gap: 10px;
		}

		.make_appo .btn.white_btn {
			margin-right: 10px;
		}

		@media only screen and (max-width: 767px) {
			.grp_btn {
				margin-bottom: 10px !important;
			}

			.make_appo {
				margin: 0 !important;
			}

			.make_appo .btn {
				width: 160px !important;
				padding: 0 10px !important;
				font-size: 12px !important;
				margin: 0 !important;
				white-space: nowrap;
			}

			.float-right2 {
				justify-content: center !important;
				gap: 18px !important;
				padding: 0 10px !important;
			}

			/* Make logo smaller and adjust header layout */
			.logo {
				text-align: center;
				padding: 5px 0;
			}

			.logo img {
				max-width: 100px !important;
				height: auto !important;
			}

			#navbar_menu.small-screen #menu-button {
				top: -90px;
			}

			.menu_side .first-ul li.shop-dropdown>a:after {
				display: none;
			}

			.footer_blog .row {
				display: grid;
				grid-template-columns: 1fr 1fr;
				/* 2 columns */
				gap: 20px;
				/* Space between columns */
			}

			.footer_blog .col-md-6 {
				width: 100%;
				/* Full width for each column */
			}

			.footer_blog .col-md-6:nth-child(1) {
				grid-row: 1;
				/* Social media and additional links in the first row */
			}

			.footer_blog .col-md-6:nth-child(2) {
				grid-row: 1;
				/* Services and contact us in the first row */
			}

			.footer_blog .col-md-6:nth-child(3) {
				grid-row: 2;
				/* Move to the second row if needed */
			}

			.footer_blog .col-md-6:nth-child(4) {
				grid-row: 2;
				/* Move to the second row if needed */
			}

			.footer_blog .col-md-6:nth-child(1),
			.footer_blog .col-md-6:nth-child(3) {
				width: 130%;
			}

			.footer_mail-section .field input {
				max-width: 160px;
			}

			.contact_us_section {
				margin-top: -75px;
				margin-bottom: 15px;
			}

			.contact_us_section h2 {
				font-size: 24px;
			}
		}
	</style>
</head>

<body id="default_theme" class="it_service">
	<!-- loader -->
	<div class="bg_load"> <img class="loader_animation" src="images/loaders/loader.gif" alt="#" /> </div>
	<!-- end loader -->
	<!-- header -->
	<?php include 'header.php'; ?>
	<!-- end header -->

	<!-- inner page banner -->
	<?php include 'breadcrumbs.php'; ?>
	<!-- end inner page banner -->
	<div class="section padding_layout_1 pd_1">
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12"></div>
				<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="full">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 adress_cont margin_bottom_30">
								<h3 class="text-center mb-4">Address</h3>
								<div class="row justify-content-center">
									<div class="col-lg-7 col-md-8 col-sm-10">
										<div class="information_bottom d-flex align-items-center mb-4">
											<div class="icon_bottom me-3">
												<i class="fa fa-road" aria-hidden="true"></i>
											</div>
											<div class="info_cont">
												<h4>F-9, Pramukhdarshan complex, Desai nagar</h4>
												<p class="mb-0">Bhavnagar, Gujarat 364003</p>
											</div>
										</div>
										<div class="information_bottom d-flex align-items-center mb-4">
											<div class="icon_bottom me-3">
												<i class="fa fa-user" aria-hidden="true"></i>
											</div>
											<div class="info_cont">
												<h4>Mon-Fri 8:30am-6:30pm</h4>
												<p class="mb-1">+91 8347768861</p>
												<p class="mb-0">+91 7878114066</p>
											</div>
										</div>
										<div class="information_bottom d-flex align-items-center">
											<div class="icon_bottom me-3">
												<i class="fa fa-envelope" aria-hidden="true"></i>
											</div>
											<div class="info_cont">
												<h4>rcinfotech11@gmail.com</h4>
												<p class="mb-0">24/7 online support</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contant_form">
								<h4>GET IN TOUCH</h4>
								<p>
									Our goal is to provide the best customer service and to
									answer all of your questions in a timely manner.
								</p>
								<div class="form_section">
									<form class="form_contant" action="index.html">
										<fieldset>
											<div class="row">
												<div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<input class="field_custom" placeholder="Websire URL" type="text"
														required />
												</div>
												<div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<input class="field_custom" placeholder="Your name" type="text"
														required />
												</div>
												<div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<input class="field_custom" placeholder="Email adress" type="email"
														required />
												</div>
												<div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
													<input class="field_custom" placeholder="Phone number" type="text"
														required />
												</div>
												<div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<textarea class="field_custom" placeholder="Messager"
														required></textarea>
												</div>
												<div class="center">
													<a class="btn main_bt" href="#">SUBMIT NOW</a>
												</div>
											</div>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="section padding_layout_1 pd_2">
	  <div class="container">
		<div class="row">
		  <div class="col-md-12">
			<div class="full">
			  <div class="main_heading text_align_left">
				<h2>Experienced Staff</h2>
				<p class="large">
				  Our experts have been featured in press numerous times.
				</p>
			  </div>
			</div>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-3 col-sm-6">
			<div class="full team_blog_colum">
			  <div class="it_team_img">
				<img
				  class="img-responsive"
				  src="images/it_service/Utsav.jpg"
				  alt="#"
				  height=343
				/>
			  </div>
			  <div class="team_feature_head">
				<h4>Utsav Dungrani</h4>
			  </div>
			  <div class="team_feature_social">
				<div class="social_icon">
				  <ul class="list-inline">
					<li>
					  <a
						class="fa fa-facebook"
						href="https://www.facebook.com/"
						title="Facebook"
						target="_blank"
					  ></a>
					</li>
					<li>
					  <a
						class="fa fa-google-plus"
						href="https://plus.google.com/"
						title="Google+"
						target="_blank"
					  ></a>
					</li>
					<li>
					  <a
						class="fa fa-twitter"
						href="https://twitter.com"
						title="Twitter"
						target="_blank"
					  ></a>
					</li>
					<li>
					  <a
						class="fa fa-linkedin"
						href="https://www.linkedin.com"
						title="LinkedIn"
						target="_blank"
					  ></a>
					</li>
					<li>
					  <a
						class="fa fa-instagram"
						href="https://www.instagram.com"
						title="Instagram"
						target="_blank"
					  ></a>
					</li>
				  </ul>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div> -->
	<!-- section -->
	<?php include 'testimonial.php'; ?>
	<!-- end section -->
	<!-- section -->
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="full">
						<div class="contact_us_section">
							<div class="call_icon">
								<img src="images/it_service/phone_icon.png" alt="#" />
							</div>
							<div class="inner_cont">
								<h2>REQUEST A FREE QUOTE</h2>
								<p>Get answers and advice from people you want it from.</p>
							</div>
							<div class="button_Section_cont">
								<a class="btn dark_gray_bt" href="contact.php">Contact us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end section -->
	<!-- footer -->
	<?php include 'footer.php'; ?>
	<!-- end footer -->
	<!-- js section -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- menu js -->
	<script src="js/menumaker.js"></script>
	<!-- wow animation -->
	<script src="js/wow.js"></script>
	<!-- custom js -->
	<script src="js/custom.js"></script>
	<!-- zoom effect -->
	<script src="js/hizoom.js"></script>
	<script>
		$(".hi1").hiZoom({
			width: 300,
			position: "right",
		});
		$(".hi2").hiZoom({
			width: 400,
			position: "right",
		});
	</script>
	<script src="js/security.js"></script>
</body>

</html>