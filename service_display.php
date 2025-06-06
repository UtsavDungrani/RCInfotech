<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}

// Database connection
require_once './config/config.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get service ID from URL parameter
$service_id = isset($_GET['id']) ? (int) $_GET['id'] : 1; // Default to 1 if no ID provided

// Add CSS to hide the corresponding service div
echo "<style>";
echo "#ser_" . $service_id . " { display: none; }";
echo "</style>";

// Get service details from database
$sql = "SELECT name, description, image_path FROM services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$result = $stmt->get_result();

$serviceName = "Default Service"; // Default fallback name
$serviceDescription = "Default description..."; // Default fallback description
$serviceImage = "images/it_service/Service_6.jpeg"; // Default fallback image

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $serviceName = $row['name'];
  $serviceDescription = $row['description'];
  if ($row['image_path']) {
    // Use the image path directly instead of base64 encoding
    $serviceImage = "" . $row['image_path'];
  }
}

$stmt->close();

// Add this code to fetch all services
$sql_services = "SELECT id, name, image_path, page_des FROM services";
$result_services = $conn->query($sql_services);
$services = [];
if ($result_services && $result_services->num_rows > 0) {
  while ($row = $result_services->fetch_assoc()) {
    $services[] = $row;
  }
}

$conn->close();
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
    .pd_1 {
      padding-bottom: 0;
    }

    .pd_2 {
      padding-top: 80px;
    }

    .grp_btn {
      margin-top: 13px;
    }

    .button {
      font-size: 15px;
      font-weight: bold;
      border-radius: 5px;
    }

    .loader_animation {
      animation: none;
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

    .service_cont {
      min-height: 270px;
      position: relative;
    }

    .bt_cont {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
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
  <div id="inner_banner" class="section inner_banner_section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="title-holder">
              <div class="title-holder-cell text-left">
                <h1 class="page-title" id="service-title"><?php echo htmlspecialchars($serviceName); ?></h1>
                <ol class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="service.php">Service</a></li>
                  <li class="active" id="active-service"><?php echo htmlspecialchars($serviceName); ?></li>
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
  <div class="section padding_layout_1 service_list pd_1">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-12 service_blog margin_bottom_50">
              <div class="full">
                <div class="service_img">
                  <img class="img-responsive" src="admin/insert_services/<?php echo htmlspecialchars($serviceImage); ?>"
                    style="width: 100%; height: 460px; object-fit: cover;" alt="img" id="service_image" />
                </div>
                <div class="service_cont">
                  <h3 class="service_head" id="ser_des_name"><?php echo htmlspecialchars($serviceName); ?></h3>
                  <p id="service_description">
                    <?php echo nl2br(htmlspecialchars($serviceDescription)); ?>
                  </p>
                </div>
                <hr class="hr" />
              </div>
            </div>

            <?php foreach ($services as $service): ?>
                <div class="col-md-4 service_blog" id="ser_<?= $service['id'] ?>">
                  <div class="full">
                    <div class="service_img">
                      <img class="img-responsive" src="admin/insert_services/<?= $service['image_path'] ?>"
                        alt="<?= $service['name'] ?>" style="height: 242px; width: 350px;" />
                    </div>
                    <div class="service_cont">
                      <h3 class="service_head"><?= $service['name'] ?></h3>
                      <p style="text-align: justify;"><?= $service['page_des'] ?></p>
                      <div class="bt_cont">
                        <a class="btn sqaure_bt" href="service_display.php?id=<?= $service['id'] ?>">View Service</a>
                      </div>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
          </div>
          <div class="row" style="margin-bottom: 30px">
            <div class="col-md-12">
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
                              You can recover your files which can deleted by any issue and you can get easily backup of
                              it.
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                              aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-star"></i> Mobile
                              Phone Recovery
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                              aria-expanded="false" aria-controls="collapseFour"><i class="fa fa-bar-chart"></i>
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
              <h4><br />SEARCH</h4>
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
                From retail, telecommunications and e-commerce to insurance,
                healthcare and government, organizations across industries
                must meet user expectations for real-time, convenient ways to
                conduct transactions and access information.
              </p>
              <a class="btn sqaure_bt" href="make_appointment.php">Booking</a>
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
    <!-- end section -->
    <!-- section -->
  </div>
  <!-- end section -->
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