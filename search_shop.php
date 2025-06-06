<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}

// Add database connection
require_once './config/config.php';

// Modify SQL query to include search condition
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM shop";
if (!empty($search)) {
  $sql .= " WHERE Name LIKE '%" . $conn->real_escape_string($search) . "%'";
}
$result = $conn->query($sql);
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
    .search {
      width: 30%;
      height: 3rem;
      margin-left: auto;
    }

    .success-page {
      text-align: center;
      padding: 40px 0;
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

    .grp_btn {
      margin-top: 13px;
    }

    .loader_animation {
      animation: none;
    }

    .button {
      font-size: 15px;
      font-weight: bold;
      border-radius: 5px;
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

    .img_con {
      height: 370px;
    }

    .product_detail_btm {
      margin: 0 20px;
    }

    .col-md-4 {
      margin-bottom: 20px;
    }

    .footer_mail-section .field input {
      max-width: 210px;
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
  <div class="bg_load"><img class="loader_animation" src="images/loaders/loader.gif" alt="#" /></div>
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
                  <li><a class="active" href="search_shop.php">Near by shops</a></li>
                  <li><a href="faq.php">FAQ</a></li>
                </ul>
              </div>
              <!-- <dv class="search_icon">
                <ul>
                  <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search"
                        aria-hidden="true"></i></a></li>
                </ul>
              </dv> -->
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
                <h1 class="page-title">Near by shop</h1>
                <ol class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li class="active">Near by shop</li>
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
      <div class="row mb-4">
        <div class="col-md-12">
          <input class="form-control search" type="text" id="searchInput" placeholder="Search shop name"
            aria-label="Search">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="full">
            <div class="main_heading text_align_center">
              <h2>Shops in Bhavnagar</h2>
              <p class="large">We provides services from various shops.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row shop_con">
        <?php
        if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4">
                        <div class="product_list">
                            <div class="product_img"> 
                                <img class="w-100 p-4 img_con" src="admin/insert_shop/' . $row['photo_dir'] . '" alt="' . $row['Name'] . '"> 
                            </div>
                            <div class="product_detail_btm">
                                <div class="center">
                                    <h4 class="sname">' . $row['Name'] . '</h4>
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
                                <div>
                                    <p><b><span class="address">Address:- ' . $row['Address'] . '<br>Contact No:-  +91 <span class="mno">' . $row['Contact no'] . '</span></span></b></p>
                                </div>
                            </div>
                        </div>
                    </div>';
          }
        } else {
          echo "0 results";
        }
        $conn->close();
        ?>
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

  <!-- Add JavaScript for real-time filtering with proper row maintenance -->
  <script>
    document.getElementById('searchInput').addEventListener('input', function () {
      const searchTerm = this.value.toLowerCase();
      const cards = document.querySelectorAll('.col-md-4');
      const rowContainer = document.querySelector('.row');

      // First, hide all product cards
      cards.forEach(card => {
        if (card.querySelector('.product_list')) {
          card.style.display = 'none';
        }
      });

      // Then show matching cards and maintain rows
      let visibleCount = 0;
      cards.forEach(card => {
        if (card.querySelector('.product_list')) {
          const shopName = card.querySelector('.sname').textContent.toLowerCase();
          const address = card.querySelector('.address').textContent.toLowerCase();
          const contact = card.querySelector('.mno').textContent.toLowerCase();

          if (shopName.includes(searchTerm) || address.includes(searchTerm) || contact.includes(searchTerm)) {
            card.style.display = 'block';
            visibleCount++;
          }
        }
      });

      // Add clearfix divs to maintain layout
      const existingClearfixes = rowContainer.querySelectorAll('.clearfix');
      existingClearfixes.forEach(clearfix => clearfix.remove());

      for (let i = 3; i < visibleCount; i += 3) {
        const clearfix = document.createElement('div');
        clearfix.className = 'clearfix';
        cards[i - 1].after(clearfix);
      }
    });
  </script>
  <script src="js/security.js"></script>
</body>

</html>