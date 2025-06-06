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

      #accordion .panel.panel-default .panel-heading p a {
        padding-right: 15px;
        /* Adjust space for the icon in mobile view */
      }

      #accordion .panel.panel-default .panel-heading p a i.fa-angle-down {
        right: 5px;
        /* Adjust space from the right side in mobile view */
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
                  <li><a href="about_us.php">About Us</a></li>
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
                  <li><a class="active" href="faq.php">FAQ</a></li>
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
                <h1 class="page-title">FAQ</h1>
                <ol class="breadcrumb">
                  <li><a href="index.html">Home</a></li>
                  <li class="active">FAQ</li>
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
        <div class="col-md-9">
          <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12">
              <div class="full margin_bottom_30">
                <div class="accordion border_circle">
                  <div class="bs-example">
                    <div class="panel-group" id="accordion" style="margin-top: 0;">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                              aria-controls="collapseOne">
                              1. When We Power On Button And also we Don't see Windows Display Why???
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <p>Here are some things you can try:
                              Restart your PC several times to launch the Windows Startup Automatic Repair screen.
                              Reset your BIOS.
                              To do this, remove the CMOS battery powering the BIOS on your motherboard and reinsert it.
                              Boot in safe mode. Safe mode can help uninstall new programs or drivers that could be
                              affecting your laptop.
                              Disconnect external display devices or docks.
                              Try reseating all of these to make sure they're connected.
                              Try using them in another computer to check they're working properly.
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                              aria-controls="collapseTwo">
                              2. If Pc Not Working?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>Unplug the computer from wherever it's currently plugged in and plug it directly into a
                              wall outlet, bypassing the UPS, surge suppressor, or power strip. If nothing still
                              happens, make sure that outlet works by plugging something else into it, like a desk lamp,
                              and confirming it turns on. </p>
                            <p>Other things you can try include:
                              Trying a different power source
                              Checking your monitor connection
                              Disconnecting your devices
                              Listening for beeps
                              Restoring your computer to previous settings
                              Checking for unresponsive apps
                              Unplugging USB devices
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                              aria-expanded="false" aria-controls="collapseThree">
                              3. What if display of Monitor not working?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>Turn off the computer and the monitor. Unplug the video cable which connects the monitor
                              to the computer. Check the video port on the computer and the monitor, and the video cable
                              if they are damaged or the pins are bent. If there is no damage, reconnect the monitor
                              to the computer.</p>
                            <p>Other things you can try include:
                              Reconnecting the video cable between the monitor and the computer
                              Attaching the monitor to different computer
                              Trying different screen resolutions
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                              aria-expanded="false" aria-controls="collapseFour">
                              4. What Is The Solution For Blue Screen Error?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>These errors can be caused by both hardware and software issues. If you added new
                              hardware to your PC before the Blue Screen error, shut down your PC, remove the hardware,
                              and try restarting. If you're having trouble restarting, you can start your
                              PC in safe mode.</p>
                            <p>A blue screen error, also known as a stop error or fatal system error, occurs when
                              Windows encounters a "STOPError" and crashes. This can be caused by hardware issues or
                              issues with low-level software running in the Windows kernel.</p>
                            <p>Here are some things you can try to fix a blue screen error:
                              Shut down your PC and disconnect any devices
                              Reboot in safe mode
                              Uninstall the software that is causing the error
                              Roll back driver updates
                              Run a malware scan
                              Check for damage
                              Review your RAM
                              Perform a hard reset
                              Run a hardware diagnostic test
                              Boot into safe mode with networking
                              Run the blue screen troubleshooter using SupportAssist
                              Repair the missing or corrupted Windows system files
                              Update the BIOS and drivers
                              Restore the computer using Windows System Restore
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                              aria-expanded="false" aria-controls="collapseFive">
                              5. What Is The Reason For Computer restarting Automatic?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>You can also try these steps:
                              Force power-off your Windows system
                              Remove peripherals and clean boot Windows
                              End unresponsive processes
                              Update your device drivers
                            </p>
                            <p>You can also try these steps to disable automatic restarts in Windows 11:
                              Open the Group Policy Editor (gpedit.msc)
                              Go to Administrative Templates > Windows Components > Windows Update
                              Double-click on "No auto-restart with logged on users for scheduled automatic updates
                              installations"
                              Select Enabled, and then select OK
                            </p>
                          </div>
                        </div>
                      </div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <p class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false"
                              aria-controls="collapseSix">
                              6. What Is The Solution For No Power In CPU?
                              <i class="fa fa-angle-down"></i>
                            </a>
                          </p>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                          <div class="panel-body">
                            <p>There could be several reasons why your computer is not turning on: Power supply failure:
                              The power supply unit (PSU) may have failed, which could cause the computer to not turn on
                              or not function properly. Motherboard issue: If the motherboard is damaged or has failed,
                              it can prevent the computer from starting up. </p>
                            <p>Other fixes
                              Try these other fixes:
                              Check for beep codes
                              Check for display issues
                              Check unusual BIOS settings
                              Disconnect non-essential devices
                              Check for malware
                              Check your monitor connection
                              Restore your computer to previous settings
                              Check for unresponsive apps
                              Unplug USB devices
                            </p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="center"><a class="btn sqaure_bt" href="feedback.php">Feedback Form</a></div>
            <div style="height:110px;"></div>
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
            <div class="col-md-12">
              <div class="full" style="margin-top: 15px;">
                <h3>Need file recovery?</h3>
                <p>The process of restoring access to files that have been lost due to user error, storage corruption,
                  or unexpected outages. This is done by putting together the remaining fragments, rebuilding from
                  what's left, or using backups.</p>
                <p><a class="btn main_bt" href="#">Read More</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="side_bar">
            <div class="side_bar_blog">
              <h4>SEARCH</h4>
              <div class="side_bar_search">
                <div class="input-group stylish-input-group">
                  <input class="form-control" placeholder="Search" type="text" />
                  <span class="input-group-addon">
                    <button type="submit">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </div>
            </div>
            <div class="side_bar_blog">
              <h4>GET A QUOTE</h4>
              <p>
                Computers make it easier to do a lot of things, but most of the things they make it easier to do don't
                need to be done.
              </p>
              <a class="btn sqaure_bt" href="service.html">View Service</a>
            </div>
            <div class="side_bar_blog">
              <h4>OUR SERVICE</h4>
              <div class="categary">
                <ul>
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
            </div>
            <div class="side_bar_blog">
              <h4>RECENT NEWS</h4>
              <div class="categary">
                <ul>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Land lights let be
                      divided</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Seasons over bearing
                      air</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Greater open after
                      grass</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-angle-right"></i> Gathered was divide
                      second</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="side_bar_blog">
              <h4>TAG</h4>
              <div class="tags">
                <ul>
                  <li><a href="#">Bootstrap</a></li>
                  <li><a href="#">HTML5</a></li>
                  <li><a href="#">Wordpress</a></li>
                  <li><a href="#">Bootstrap</a></li>
                  <li><a href="#">HTML5</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end section -->
  <!-- section -->
  <div class="section padding_layout_1 testmonial_section white_fonts">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_left">
              <h2 style="text-transform: none;">What Clients Say?</h2>
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
                    <div class="testimonial-content"> You guys rock! Thank you for making it painless, pleasant and most
                      of all hassle free! I wish I would have thought of it first.
                      I am really satisfied with my first laptop service.</div>
                    <div class="testimonial-photo"> <img src="images/it_service/client1.jpg" class="img-responsive"
                        alt="#" width="150" height="150"> </div>
                    <div class="testimonial-meta">
                      <h4>Maria Anderson</h4>
                      <span class="testimonial-position">CFO, Tech NY</span>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonial-container">
                    <div class="testimonial-content"> You guys rock! Thank you for making it painless, pleasant and most
                      of all hassle free! I wish I would have thought of it first.
                      I am really satisfied with my first laptop service.</div>
                    <div class="testimonial-photo"> <img src="images/it_service/client2.jpg" class="img-responsive"
                        alt="#" width="150" height="150"> </div>
                    <div class="testimonial-meta">
                      <h4>Maria Anderson</h4>
                      <span class="testimonial-position">CFO, Tech NY</span>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="testimonial-container">
                    <div class="testimonial-content"> You guys rock! Thank you for making it painless, pleasant and most
                      of all hassle free! I wish I would have thought of it first.
                      I am really satisfied with my first laptop service.</div>
                    <div class="testimonial-photo"> <img src="images/it_service/client3.jpg" class="img-responsive"
                        alt="#" width="150" height="150"> </div>
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
          <div class="full"> </div>
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
  <!-- revolution js files -->
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