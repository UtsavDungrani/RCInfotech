<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["username"] === "user") {
  header("Location: login.php");
  exit;
}

$booking_id = isset($_GET['booking_id']) ? (int) $_GET['booking_id'] : 0;

if ($booking_id === 0) {
  header("Location: index.php");
  exit;
}

// Database connection
require './config/config.php';

// Get booking details
$sql = "SELECT * FROM bookser WHERE id = ? AND booked_by_email = ?";
$stmt = $link->prepare($sql);
$stmt->execute([$booking_id, $_SESSION["email"]]);
$booking = $stmt->fetch();

if (!$booking) {
  header("Location: index.php");
  exit;
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
  <!-- zoom effect -->
  <link rel='stylesheet' href='css/hizoom.css'>
  <!-- end zoom effect -->
  <style>
    .success-page {
      text-align: center;
    }

    .success-page i {
      color: #4CAF50;
      font-size: 100px;
      line-height: 200px;
      margin-bottom: 20px;
    }

    .success-page h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .order-details {
      background: #f8f8f8;
      padding: 20px;
      border-radius: 5px;
      margin-top: 30px;
      text-align: left;
    }

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

    a.btn,
    button.btn {
      min-width: 175px;
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

<body id="default_theme" class="it_serv_shopping_cart shopping-cart">
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
                <h1 class="page-title">Service Booking Success</h1>
                <ol class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li class="active">Service Booking Success</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end inner page banner -->

  <div class="section padding_layout_1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="success-page">
            <i class="fa fa-check-circle"></i>
            <h2>Thank you for your service booking!</h2>
            <p>Your service booking has been placed and will be processed as soon as possible.</p>
            <p>Make note of your booking number, which is: <strong>#<?= $booking_id ?></strong></p>

            <div class="order-details">
              <h3>Booking Details</h3>
              <table class="table">
                <tr>
                  <td><strong>Booking Number:</strong></td>
                  <td>#<?= $booking_id ?></td>
                </tr>
                <tr>
                  <td><strong>Booking Date:</strong></td>
                  <td><?= date('F j, Y', strtotime($booking['booking_time'])) ?></td>
                </tr>
                <tr>
                  <td><strong>Name:</strong></td>
                  <td><?= htmlspecialchars($booking['fname'] . ' ' . $booking['lname']) ?></td>
                </tr>
                <tr>
                  <td><strong>Email:</strong></td>
                  <td><?= htmlspecialchars($booking['email']) ?></td>
                </tr>
                <tr>
                  <td><strong>Contact Number:</strong></td>
                  <td><?= htmlspecialchars($booking['mobile']) ?></td>
                </tr>
                <tr>
                  <td><strong>Service:</strong></td>
                  <td><?= htmlspecialchars($booking['subject']) ?></td>
                </tr>
                <tr>
                  <td><strong>Description:</strong></td>
                  <td><?= htmlspecialchars($booking['description']) ?></td>
                </tr>
              </table>
            </div>

            <div style="margin-top: 30px;">
              <a href="service.php" class="btn main_bt">Continue to Services</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

  <script src="js/security.js"></script>
</body>

</html>