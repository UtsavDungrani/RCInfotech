<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}
?>
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

    #accordion .panel.panel-default .panel-heading p a {
      position: relative;
      padding-right: 20px;
      display: flex;
      align-items: center;
    }

    #accordion .panel.panel-default .panel-heading p a i.fa-angle-down {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%) rotate(0deg);
      transition: transform 0.3s ease;
      margin: 0;
      font-size: 16px;
      line-height: 1;
    }

    /* When collapsed */
    #accordion .panel.panel-default .panel-heading p a.collapsed i.fa-angle-down {
      transform: translateY(-50%) rotate(0deg);
    }

    /* When expanded */
    #accordion .panel.panel-default .panel-heading p a:not(.collapsed) i.fa-angle-down {
      transform: translateY(-50%) rotate(180deg);
    }

    .footer_mail-section .field input {
      max-width: 210px;
    }

    /* Mobile view (max-width: 767px) */
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

      #accordion .panel.panel-default .panel-heading p a {
        padding-right: 15px;
        /* Adjust space for the icon in mobile view */
      }

      #accordion .panel.panel-default .panel-heading p a i.fa-angle-down {
        right: 5px;
        /* Adjust space from the right side in mobile view */
      }

      .contact_us_section {
        margin-top: -75px;
        margin-bottom: 15px;
      }

      .contact_us_section h2 {
        font-size: 24px;
      }

      .full {
        margin: 0%;
      }
    }
  </style>
</head>

<body id="default_theme" class="it_service">
  <!-- loader -->
  <div class="bg_load"> <img class="loader_animation" src="images/loaders/loader.gif" alt="#" /> </div>
  <!-- end loader -->
  <!-- header -->
  <header id="default_header" class="header_style_1">
    <!-- header top -->
    <div class="header_top">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="full">
              <div class="topbar-left">
                <ul class="list-inline">
                  <li> <span class="topbar-label"><i class="fa  fa-home"></i></span> <span
                      class="topbar-hightlight">Desai nagar, Bhavnagar</span> </li>
                  <li> <span class="topbar-label"><i class="fa-regular fa-envelope"></i></span> <span
                      class="topbar-hightlight"><a href="mailto:info@yourdomain.com">Hello,
                        <?= htmlspecialchars($_SESSION["username"]); ?> </a></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 right_section_header_top">
            <div class="float-left my-3">
              <div class="social_icon">
                <ul class="list-inline">
                  <li><a class="fa-brands fa-facebook-f" href="https://www.facebook.com/" title="Facebook"
                      target="_blank"></a></li>
                  <li><a class="fa-brands fa-x-twitter" href="https://twitter.com" title="Twitter" target="_blank"></a>
                  </li>
                  <li><a class="fa-brands fa-linkedin-in" href="https://www.linkedin.com" title="LinkedIn"
                      target="_blank"></a></li>
                  <li><a class="fa-brands fa-instagram" href="https://www.instagram.com" title="Instagram"
                      target="_blank"></a></li>
                </ul>
              </div>
            </div>
            <div class="float-right2 d-flex flex-row mb-2 grp_btn">
              <div class="make_appo"> <a class="btn white_btn" href="make_appointment.php">Make Appointment</a></div>
              <div class="make_appo"> <a class="btn white_btn" style="width:180px; margin-left:18px;"
                  href="<?= htmlspecialchars($_SESSION["username"] === "user" ? "./login.php" : "./logout.php"); ?>"
                  style="margin-left: 15px;"><?= htmlspecialchars($_SESSION["username"] === "user" ? "Login" : "Logout"); ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end header top -->
    <!-- header bottom -->
    <div class="header_bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <!-- logo start -->
            <div class="logo"> <a href="index.php"><img src="images/logos/logo.png" alt="logo" /></a> </div>
            <!-- logo end -->
          </div>
          <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
            <!-- menu start -->
            <div class="menu_side">
              <div id="navbar_menu">
                <ul class="first-ul">
                  <li><a href="index.php">Home</a></li>
                  <li><a class="active" href="about_us.php">About Us</a></li>
                  <li class="shop-dropdown">
                    <a href="service.php">Service</i></a>
                    <ul class="dropdown-menu">
                      <li><a href="service.php">Services</a></li>
                      <li><a href="user_service_requests.php">Booked Services</a></li>
                    </ul>
                  </li>
                  <li class="shop-dropdown">
                    <a href="shop.php">Shop</i></a>
                    <ul class="dropdown-menu">
                      <li><a href="shop.php">All Products</a></li>
                      <li><a href="cart.php">Shopping Cart</a></li>
                      <li><a href="user_orders.php">My Orders</a></li>
                    </ul>
                  </li>
                  <li><a href="contact.php">Contact</a></li>
                  <li><a href="search_shop.php">Near by shops</a></li>
                  <li><a href="faq.php">FAQ</a></li>
                </ul>
              </div>
              <!-- <div class="search_icon">
                <ul>
                  <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search"
                        aria-hidden="true"></i></a></li>
                </ul>
              </div> -->
            </div>
            <!-- menu end -->
          </div>
        </div>
      </div>
    </div>
    <!-- header bottom end -->
  </header>
  <!-- end header -->
  <!-- inner page banner -->
  <div id="inner_banner" class="section inner_banner_section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="title-holder">
              <div class="title-holder-cell text-left">
                <h1 class="page-title">About Us</h1>
                <ol class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li class="active">About Us</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end inner page banner -->
  <!-- section -->
  <div class="section padding_layout_1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_center">
              <h2>We are Leading Company</h2>
              <p class="large">Fastest repair service with best price!</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row about_blog">
        <div class="col-lg-6 col-md-6 col-sm-12 about_cont_blog">
          <div class="full text_align_left">
            <h3>What we do</h3>
            <p>
              You can register for appiontment and get responce within 2 hour and you can get your services from your
              nearest vendor which can affordable.
            </p>
            <ul>
              <li>
                <i class="fa fa-check-circle"></i>Fast service providing
              </li>
              <li>
                <i class="fa fa-check-circle"></i>Affordable services
              </li>
              <li>
                <i class="fa fa-check-circle"></i>90 Days warrenty on any services
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 about_feature_img">
          <div class="full text_align_center">
            <img class="img-responsive" src="images/it_service/post-06.jpg" alt="#" />
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 35px">
        <div class="col-md-8">
          <div class="full margin_bottom_30">
            <div class="accordion border_circle">
              <div class="bs-example">
                <div class="panel-group" id="accordion" style="margin-top: 0;">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                          aria-controls="collapseOne"><i class="fa fa-bar-chart"></i>
                          Complete Recovery from Local & External Drive
                          <i class="fa fa-angle-down"></i>
                        </a>
                      </p>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <p>
                          You can recover your files which can deleted by any issue and you can get easily backup of it.
                          This service is provided for your any device like Laptop, Desktop, Mobile, Tablet, etc..
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                          aria-controls="collapseTwo"><i class="fa fa-plane"></i> Recovery Photo, Image,
                          Video and Audio
                          <i class="fa fa-angle-down"></i>
                        </a>
                      </p>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>
                          Photo recovery is also part of file recovery in which yo can recover your file and images.
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false"
                          aria-controls="collapseThree"><i class="fa fa-star"></i> Mobile Phone Recovery
                          <i class="fa fa-angle-down"></i>
                        </a>
                      </p>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>
                          To recover your mobile phone we provide services that can give you ack deleted files.
                        </p>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false"
                          aria-controls="collapseFour"><i class="fa fa-bar-chart"></i>
                          Complete Recovery from Local & External Drive
                          <i class="fa fa-angle-down"></i>
                        </a>
                      </p>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>
                          You recover your external and internal files by booking data recovery services.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="full" style="margin-top: 35px">
            <h3>Need file recovery?</h3>
            <p>
              The process of restoring access to files that have been lost due to user error, storage corruption, or
              unexpected outages. This is done by putting together the remaining fragments, rebuilding from what's left,
              or using backups.
            </p>
            <p><a class="btn main_bt" href="#">Read More</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end section -->
  <!-- section -->
  <div class="section padding_layout_1 light_silver gross_layout">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_left">
              <h2>Service Process</h2>
              <p class="large">Easy and effective way to get your device repaired.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si1.png" alt="#" /></div>
                  <h4 class="service-heading">Fast service</h4>
                  <p>You get fast service within 2 hour responce.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si2.png" alt="#" /></div>
                  <h4 class="service-heading">Secure payments</h4>
                  <p>Your payment and account detail will be safe.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si3.png" alt="#" /></div>
                  <h4 class="service-heading">Expert team</h4>
                  <p>We have hired expert team to provide best services.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si4.png" alt="#" /></div>
                  <h4 class="service-heading">Affordable services</h4>
                  <p>We provides services which can affordable for everyone.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si5.png" alt="#" /></div>
                  <h4 class="service-heading">90 Days warranty</h4>
                  <p>You can get 90 Days warranty on any services.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="full">
                <div class="service_blog_inner">
                  <div class="icon text_align_left"><img src="images/it_service/si6.png" alt="#" /></div>
                  <h4 class="service-heading">Award winning</h4>
                  <p>Work in progress.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end section -->
  <!-- <div class="section padding_layout_1">
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
  <div class="section padding_layout_1 testmonial_section white_fonts">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_left">
              <h2 style="text-transform: none">What Clients Say?</h2>
              <p class="large">Here are testimonials from clients..</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-7">
          <div class="full">
            <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ul class="carousel-indicators">
                <li data-target="#testimonial_slider" data-slide-to="0" class="active"></li>
                <li data-target="#testimonial_slider" data-slide-to="1"></li>
                <li data-target="#testimonial_slider" data-slide-to="2"></li>
              </ul>
              <!-- The slideshow -->
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="testimonial-container">
                    <div class="testimonial-content">
                      You guys rock! Thank you for making it painless,
                      pleasant and most of all hassle free! I wish I would
                      have thought of it first. I am really satisfied with my
                      first laptop service.
                    </div>
                    <div class="testimonial-photo">
                      <img src="images/it_service/client1.jpg" class="img-responsive" alt="#" width="150"
                        height="150" />
                    </div>
                    <div class="testimonial-meta">
                      <h4>Maria Anderson</h4>
                      <span class="testimonial-position">CFO, Tech NY</span>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonial-container">
                    <div class="testimonial-content">
                      You guys rock! Thank you for making it painless,
                      pleasant and most of all hassle free! I wish I would
                      have thought of it first. I am really satisfied with my
                      first laptop service.
                    </div>
                    <div class="testimonial-photo">
                      <img src="images/it_service/client2.jpg" class="img-responsive" alt="#" width="150"
                        height="150" />
                    </div>
                    <div class="testimonial-meta">
                      <h4>Maria Anderson</h4>
                      <span class="testimonial-position">CFO, Tech NY</span>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonial-container">
                    <div class="testimonial-content">
                      You guys rock! Thank you for making it painless,
                      pleasant and most of all hassle free! I wish I would
                      have thought of it first. I am really satisfied with my
                      first laptop service.
                    </div>
                    <div class="testimonial-photo">
                      <img src="images/it_service/client3.jpg" class="img-responsive" alt="#" width="150"
                        height="150" />
                    </div>
                    <div class="testimonial-meta">
                      <h4>Maria Anderson</h4>
                      <span class="testimonial-position">CFO, Tech NY</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="full"></div>
        </div>
      </div>
    </div>
  </div>
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
  <footer class="footer_style_2">
    <div class="container-fuild">
      <div class="row">
        <div style="width: 500px;">
          <div style="width: 100%"><iframe width="100%" height="630" frameborder="0" scrolling="no" marginheight="0"
              marginwidth="0"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d472.0673927927595!2d72.11304969999999!3d21.760874899999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f50f3945bcedb%3A0xbd03f1f2080a40c7!2sRIGHTS%20COMPUTER!5e0!3m2!1sen!2sin!4v1711384511011!5m2!1sen!2sin"><a
                href="https://www.maps.ie/population/">Population calculator map</a></iframe></div>
        </div>
        <div class="footer_blog">
          <div class="row">
            <div class="col-md-6">
              <div class="main-heading left_text">
                <h2>Social media</h2>
              </div>
              <!-- <p>Tincidunt elit magnis nulla facilisis. Dolor sagittis maecenas. Sapien nunc amet ultrices, dolores sit ipsum velit purus aliquet, massa fringilla leo orci.</p> -->
              <ul class="social_icons">
                <li class="social-icon in"><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li class="social-icon in"><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                <li class="social-icon tw"><a href="#"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                </li>
                <li class="social-icon fb"><a href="#"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <div class="main-heading left_text">
                <h2>Additional links</h2>
              </div>
              <ul class="footer-menu">
                <li>
                  <a href="about_us.php"><i class="fa fa-angle-right"></i> About us</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> Terms and conditions</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> Privacy policy</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> News</a>
                </li>
                <li>
                  <a href="contact.php"><i class="fa fa-angle-right"></i> Contact us</a>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <div class="main-heading left_text">
                <h2>Services</h2>
              </div>
              <ul class="footer-menu">
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> Data recovery</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> Computer repair</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> Mobile service</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> Network solutions</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-angle-right"></i> Technical support</a>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <div class="main-heading left_text">
                <h2>Contact us</h2>
              </div>
              <p>
                Pramukhdarshan complex, Desai nagar, Bhavnagar, Gujarat 364003<br />
                <span style="font-size: 18px"><a href="tel:+9876543210">+91 9265121020</a></span>
              </p>
              <div class="footer_mail-section">
                <form>
                  <fieldset>
                    <div class="field">
                      <input placeholder="Email" type="text" />
                      <button class="button_custom">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                      </button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="cprt">
          <p>RCInfotech © Copyrights 2019 Design by RCInfotech</p>
        </div>
      </div>
    </div>
  </footer>
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
  <script src="revolution/js/jquery.themepunch.tools.min.js"></script>
  <script src="revolution/js/jquery.themepunch.revolution.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
  <script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
  <script src="js/security.js"></script>
  <script>
    $(document).ready(function () {
      // Initialize the accordion with the first panel expanded
      $('#collapseOne').collapse('show');

      // Ensure only one panel is open at a time
      $('#accordion').on('show.bs.collapse', function (e) {
        $('#accordion .panel-collapse').not(e.target).collapse('hide');
      });

      // ---------- Fix the arrow icon alignment on page load ----------
      $('#accordion .panel-heading a').each(function () {
        var $this = $(this);
        var target = $($this.attr('href'));

        if (target.hasClass('in')) {
          $this.removeClass('collapsed');
        } else {
          $this.addClass('collapsed');
        }
      });

      // Update arrow icon on collapse toggle
      $('#accordion .panel-collapse').on('shown.bs.collapse', function () {
        $(this).prev('.panel-heading').find('a').removeClass('collapsed');
      });

      $('#accordion .panel-collapse').on('hidden.bs.collapse', function () {
        $(this).prev('.panel-heading').find('a').addClass('collapsed');
      });
    });
  </script>
</body>

</html>