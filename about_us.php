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
      <div class="row mt_35">
        <div class="col-md-8">
          <div class="full margin_bottom_30">
            <div class="accordion border_circle">
              <div class="bs-example">
                <div class="panel-group" id="accordion">
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
          <div class="full mt_35">
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
  <?php include 'testimonial.php'; ?>
  <!-- end section -->
  <!-- footer -->
  <?php include 'footer.php'; ?>
  <!-- end footer -->
  <!-- js section -->
  
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/menumaker.js"></script>
  <script src="js/wow.js"></script>
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
  <script src="js/accordion.js"></script>
</body>

</html>