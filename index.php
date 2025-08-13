<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}

require_once "./config/config.php";

// Fetch products from database
$stmt = $link->query("SELECT * FROM product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch services from database
$stmt1 = $link->query("SELECT * FROM services");
$services = $stmt1->fetchAll(PDO::FETCH_ASSOC);  // Changed to use $stmt1 and store in $services
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

  <!-- Preload critical resources -->
  <link rel="preload" href="css/bootstrap.min.css" as="style">
  <link rel="preload" href="css/style.css" as="style">
  <link rel="preload" href="js/jquery.min.js" as="script">
  <link rel="preload" href="js/bootstrap.min.js" as="script">

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
  <link rel="stylesheet" href="css/all.min.css" />
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

    /* Add spacing for buttons in normal view */
    .float-right2 {
      gap: 10px;
    }

    .make_appo .btn.white_btn {
      margin-right: 10px;
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

    .img-product {
      height: 270px;
    }

    .footer_mail-section .field input {
      max-width: 210px;
    }

    .ser_img {
      height: 242px;
      width: 363px;
    }

    .text_justify {
      text-align: justify;
    }

    .layer_nr_bg {
      z-index: 5;
      background-color: rgba(0, 0, 0, 0.25);
      border-color: rgba(0, 0, 0, 0.50);
    }

    .layer_nr_1 {
      z-index: 5;
      background-color: rgba(29, 29, 29, 0.85);
      border-color: rgba(0, 0, 0, 0.50);
    }

    .layer_nr_2 {
      z-index: 6;
      white-space: nowrap;
    }

    .layer_nr_3 {
      z-index: 7;
      white-space: nowrap;
    }

    .slider_main {
      margin: 0px auto;
      background-color: transparent;
      padding: 0px;
      margin-top: 0px;
      margin-bottom: 0px;
    }

    .disp_none {
      display: none;
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

      .col-lg-4.col-md-6.col-sm-6.col-xs-12 {
        width: 50%;
        /* Full width for single product */
        max-width: 300px;
        /* Smaller width for the product container */
        margin: 0 auto;
        /* Center the product container */
        padding: 0 10px;
      }

      .product_list {
        margin-bottom: 20px;
      }

      .product_img {
        overflow: hidden;
      }

      .product_img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensures the image covers the square area */
      }

      .product_detail_btm {
        padding: 10px;
      }

      .product_price {
        text-align: center;
      }

      .starratin {
        justify-content: center;
      }

      .product_detail_btm .center {
        text-align: center;
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
      min-height: 220px;
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

  <!-- section -->
  <div id="slider" class="section main_slider">
    <div class="container-fuild">
      <div class="row">
        <div id="rev_slider_4_1_wrapper slider_main" class="rev_slider_wrapper fullwidthbanner-container"
          data-alias="classicslider1">
          <!-- START REVOLUTION SLIDER 5.0.7 auto mode -->
          <div id="rev_slider_4_1" class="rev_slider fullwidthabanner disp_none" data-version="5.0.7">
            <ul>
              <li data-index="rs-1812" data-transition="zoomin" data-slotamount="7" data-easein="Power4.easeInOut"
                data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="images/it_service/slide1.jpg"
                data-rotate="0" data-saveperformance="off" data-title="Computer Services" data-description="">
                <!-- MAIN IMAGE -->
                <img src="images/it_service/slide1.jpg" alt="#" data-bgposition="center center" data-kenburns="on"
                  data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120"
                  data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0"
                  data-bgparallax="10" class="rev-slidebg" data-no-retina>
                <!-- LAYERS -->
                <!-- LAYER NR. BG -->
                <div class="tp-caption tp-shape tp-shapewrapper   rs-parallaxlevel-0 layer_nr_bg"
                  id="slide-270-layer-1012" data-x="['center','center','center','center']"
                  data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                  data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap"
                  data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;"
                  data-transform_out="s:300;s:300;" data-start="750" data-basealign="slide" data-responsive_offset="on"
                  data-responsive="off"> </div>
                <!-- LAYER NR. 1 -->
                <div class="tp-caption tp-shape tp-shapewrapper   tp-resizeme rs-parallaxlevel-0 layer_nr_1"
                  id="slide-18-layer-912" data-x="['center','center','center','center']"
                  data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                  data-voffset="['15','15','15','15']" data-width="670" data-height="140" data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="2000"
                  data-responsive_offset="on"></div>
                <!-- LAYER NR. 2 -->
                <div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0 layer_nr_2"
                  id="slide-18-layer-112" data-x="['center','center','center','center']"
                  data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                  data-voffset="['0','0','0','0']" data-fontsize="['70','70','70','35']"
                  data-lineheight="['70','70','70','50']" data-width="none" data-height="none" data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="chars"
                  data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05">Computer Services </div>
                <!-- LAYER NR. 3 -->
                <div class="tp-caption NotGeneric-SubTitle   tp-resizeme rs-parallaxlevel-0 layer_nr_3"
                  id="slide-18-layer-412" data-x="['center','center','center','center']"
                  data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                  data-voffset="['52','51','51','31']" data-width="none" data-height="none" data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1500" data-splitin="none"
                  data-splitout="none" data-responsive_offset="on">Available On
                  RCInfotech </div>
              </li>
              <li data-index="rs-181" data-transition="zoomin" data-slotamount="7" data-easein="Power4.easeInOut"
                data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="images/it_service/slide2.jpg"
                data-rotate="0" data-saveperformance="off" data-title="Easy To Use & Customize" data-description="">
                <!-- MAIN IMAGE -->
                <img src="images/it_service/slide2.jpg" alt="" data-bgposition="center center" data-kenburns="on"
                  data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120"
                  data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0"
                  data-bgparallax="10" class="rev-slidebg" data-no-retina>
                <!-- LAYERS -->
                <!-- LAYER NR. BG -->
                <div class="tp-caption tp-shape tp-shapewrapper   rs-parallaxlevel-0 layer_nr_bg"
                  id="slide-270-layer-101" data-x="['center','center','center','center']"
                  data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                  data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap"
                  data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;"
                  data-transform_out="s:300;s:300;" data-start="750" data-basealign="slide" data-responsive_offset="on"
                  data-responsive="off"> </div>
                <!-- LAYER NR. 1 -->
                <div class="tp-caption tp-shape tp-shapewrapper   tp-resizeme rs-parallaxlevel-0 layer_nr_1"
                  id="slide-18-layer-91" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                  data-y="['middle','middle','middle','middle']" data-voffset="['15','15','15','15']" data-width="600"
                  data-height="140" data-whitespace="nowrap" data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="2000"
                  data-responsive_offset="on"></div>
                <!-- LAYER NR. 2 -->
                <div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0 layer_nr_2"
                  id="slide-18-layer-11" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                  data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                  data-fontsize="['70','70','70','35']" data-lineheight="['70','70','70','50']" data-width="none"
                  data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="chars"
                  data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05">Fast & Affordable </div>
                <!-- LAYER NR. 3 -->
                <div class="tp-caption NotGeneric-SubTitle   tp-resizeme rs-parallaxlevel-0 layer_nr_3"
                  id="slide-18-layer-41" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                  data-y="['middle','middle','middle','middle']" data-voffset="['52','51','51','31']" data-width="none"
                  data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1500" data-splitin="none"
                  data-splitout="none" data-responsive_offset="on">Available On
                  RCInfotech </div>
              </li>
              <li data-index="rs-18" data-transition="zoomin" data-slotamount="7" data-easein="Power4.easeInOut"
                data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="images/it_service/slide3.jpg"
                data-rotate="0" data-saveperformance="off" data-title="Perfectly Responsive" data-description="">
                <!-- MAIN IMAGE -->
                <img src="images/it_service/slide3.jpg" alt="" data-bgposition="center center" data-kenburns="on"
                  data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120"
                  data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0"
                  data-bgparallax="10" class="rev-slidebg" data-no-retina>
                <!-- LAYERS -->
                <!-- LAYER NR. BG -->
                <div class="tp-caption tp-shape tp-shapewrapper   rs-parallaxlevel-0 layer_nr_bg"
                  id="slide-270-layer-10" data-x="['center','center','center','center']"
                  data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                  data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap"
                  data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;"
                  data-transform_out="s:300;s:300;" data-start="750" data-basealign="slide" data-responsive_offset="on"
                  data-responsive="off"></div>
                <!-- LAYER NR. 1 -->
                <div class="tp-caption tp-shape tp-shapewrapper   tp-resizeme rs-parallaxlevel-0 layer_nr_1"
                  id="slide-18-layer-9" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                  data-y="['middle','middle','middle','middle']" data-voffset="['15','15','15','15']" data-width="500"
                  data-height="140" data-whitespace="nowrap" data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;" data-start="2000"
                  data-responsive_offset="on"></div>
                <!-- LAYER NR. 2 -->
                <div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0 layer_nr_2"
                  id="slide-18-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                  data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                  data-fontsize="['70','70','70','35']" data-lineheight="['70','70','70','50']" data-width="none"
                  data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                  data-transform_in="y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="chars"
                  data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05">We Will Fix It </div>
                <!-- LAYER NR. 3 -->
                <div class="tp-caption NotGeneric-SubTitle   tp-resizeme rs-parallaxlevel-0 layer_nr_3"
                  id="slide-18-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                  data-y="['middle','middle','middle','middle']" data-voffset="['52','51','51','31']" data-width="none"
                  data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                  data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                  data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1500" data-splitin="none"
                  data-splitout="none" data-responsive_offset="on">Available On
                  RCInfotech </div>
              </li>
            </ul>
            <div class="tp-static-layers"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end section -->
  <!-- section -->
  <div class="section padding_layout_1 light_silver service_list">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_center">
              <h2>Our Services</h2>
              <p class="large">
                We provide a wide range of IT services to meet your needs.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <?php foreach ($services as $service): ?>
          <div class="col-md-4 service_blog">
            <div class="full">
              <div class="service_img">
                <img class="img-responsive ser_img" src="get_service_image.php?id=<?= $service['id'] ?>"
                  alt="<?= $service['name'] ?>" loading="lazy" />
              </div>
              <div class="service_cont">
                <h3 class="service_head"><?= $service['name'] ?></h3>
                <p class="text_justify"><?= $service['page_des'] ?></p>
                <div class="bt_cont">
                  <a class="btn sqaure_bt" href="service_display.php?id=<?= $service['id'] ?>">View Service</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
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

  <!-- section -->
  <div class="section padding_layout_1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_center">
              <h2>Our Products</h2>
              <p class="large">We package the products with best services to make you a happy customer.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <?php foreach ($products as $product): ?>
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                <a href="product.php?id=<?= $product['id'] ?>">
                  <div class="product_list">
                    <div class="product_img">
                      <img class="img-responsive img-product" src="get_product_image.php?id=<?= $product['id'] ?>"
                        alt="<?= $product['name'] ?>" loading="lazy">
                    </div>
                    <div class="product_detail_btm">
                      <div class="center">
                        <h4><a href="product.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a></h4>
                      </div>
                      <div class="starratin">
                        <div class="center">
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="product_price">
                        <p>
                          <span class="old_price">₹<?= $product['old_price'] ?></span> –
                          <span class="new_price"> ₹<?= $product['new_price'] ?></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
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
              <p class="text_justify">
                Computers make it easier to do a lot of things, but most of the things they make it easier to do don't
                need to be done.
              </p>
              <a class="btn sqaure_bt" href="service.php">View Service</a>
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
  <div class="section padding_layout_1 light_silver gross_layout right_gross_layout">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_right">
              <h2>Our Feedback</h2>
              <p class="large">Easy and effective way to get your device repaired.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row counter">
        <div class="col-md-4"> </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin_bottom_50">
              <div class="text_align_right"><i class="fa fa-smile-o"></i></div>
              <div class="text_align_right">
                <p class="counter-heading text_align_right">Happy Customers</p>
              </div>
              <h5 class="counter-count">2150</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin_bottom_50">
              <div class="text_align_right"><i class="fa fa-laptop"></i></div>
              <div class="text_align_right">
                <p class="counter-heading text_align_right">Laptop Repairing</p>
              </div>
              <h5 class="counter-count">1280</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin_bottom_50">
              <div class="text_align_right"><i class="fa fa-desktop"></i></div>
              <div class="text_align_right">
                <p class="counter-heading">Computer Repairing</p>
              </div>
              <h5 class="counter-count">848</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin_bottom_50">
              <div class="text_align_right"><i class="fa fa-windows"></i></div>
              <div class="text_align_right">
                <p class="counter-heading">OS Installation</p>
              </div>
              <h5 class="counter-count">450</h5>
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
  <?php include 'testimonial.php'; ?>
  <!-- end section -->
  <!-- section -->
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="contact_us_section">
              <div class="call_icon"> <img src="images/it_service/phone_icon.png" alt="#" /> </div>
              <div class="inner_cont">
                <h2>REQUEST A FREE QUOTE</h2>
                <p>Get answers and advice from people you want it from.</p>
              </div>
              <div class="button_Section_cont"> <a class="btn dark_gray_bt" href="contact.php">Contact us</a> </div>
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
    jQuery(document).ready(function () {
      if (jQuery("#rev_slider_4_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_4_1");
      } else {
        jQuery("#rev_slider_4_1").show().revolution({
          sliderType: "standard",
          jsFileLocation: "revolution/js/",
          sliderLayout: "fullwidth",
          dottedOverlay: "none",
          delay: 9000,
          navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            mouseScrollReverse: "default",
            onHoverStop: "on",
            touch: {
              touchenabled: "on",
              swipe_threshold: 75,
              swipe_min_touches: 1,
              swipe_direction: "horizontal",
              drag_block_vertical: false
            },
            arrows: {
              style: "zeus",
              enable: true,
              hide_onmobile: true,
              hide_under: 600,
              hide_onleave: true,
              hide_delay: 200,
              hide_delay_mobile: 1200,
              tmp: '<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
              left: {
                h_align: "left",
                v_align: "center",
                h_offset: 20,
                v_offset: 0
              },
              right: {
                h_align: "right",
                v_align: "center",
                h_offset: 20,
                v_offset: 0
              }
            },
            bullets: {
              enable: true,
              hide_onmobile: true,
              hide_under: 600,
              style: "zeus",
              hide_onleave: true,
              hide_delay: 200,
              hide_delay_mobile: 1200,
              direction: "horizontal",
              h_align: "center",
              v_align: "bottom",
              h_offset: 0,
              v_offset: 50,
              space: 5,
              tmp: '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
            }
          },
          viewPort: {
            enable: true,
            outof: "pause",
            visible_area: "80%",
            presize: false
          },
          responsiveLevels: [1240, 1024, 778, 480],
          visibilityLevels: [1240, 1024, 778, 480],
          gridwidth: [1240, 1024, 778, 480],
          gridheight: [600, 500, 400, 300],
          lazyType: "none",
          parallax: {
            type: "scroll",
            origo: "slidercenter",
            speed: 400,
            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 46, 47, 48, 49, 50, 55],
            type: "scroll",
          },
          shadow: 0,
          spinner: "off",
          stopLoop: "off",
          stopAfterLoops: -1,
          stopAtSlide: -1,
          shuffle: "off",
          autoHeight: "off",
          hideThumbsOnMobile: "off",
          hideSliderAtLimit: 0,
          hideCaptionAtLimit: 0,
          hideAllCaptionAtLilmit: 0,
          debugMode: false,
          fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
          }
        });
      }
    });
  </script>
</body>

</html>