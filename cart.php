<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}

// Start session and initialize cart if not exists
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] += $quantity;
  } else {
    $_SESSION['cart'][$product_id] = $quantity;
  }
}

// Remove item from cart
if (isset($_GET['remove'])) {
  $product_id = $_GET['remove'];
  unset($_SESSION['cart'][$product_id]);
}

// Update quantities
if (isset($_POST['update_cart'])) {
  if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
      if ($quantity > 0) {
        $_SESSION['cart'][$product_id] = $quantity;
      } else {
        unset($_SESSION['cart'][$product_id]);
      }
    }
  }
}

// Include the PDO database connection
require_once './config/config.php';

// Get product details
$cart_items = [];
$total = 0;
if (!empty($_SESSION['cart'])) {
  $product_ids = implode(',', array_keys($_SESSION['cart']));
  $query = "SELECT * FROM product WHERE id IN ($product_ids)";
  $result = $link->query($query);

  if ($result) {
    while ($row = $result->fetch()) {
      $row['quantity'] = $_SESSION['cart'][$row['id']];
      $row['total'] = $row['new_price'] * $row['quantity'];
      $total += $row['total'];
      $cart_items[] = $row;
    }
  } else {
    echo "Error: " . $link->errorInfo()[2];
  }
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
                    <a href="shop.php" class="active">Shop</i></a>
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
                <h1 class="page-title">Shopping Cart</h1>
                <ol class="breadcrumb">
                  <li><a href="index.html">Home</a></li>
                  <li class="active">Shopping Cart</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end inner page banner -->
  <div class="section padding_layout_1 Shopping_cart_section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <div class="product-table">
            <form method="post" action="cart.php">
              <table class="table">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($cart_items)): ?>
                      <?php foreach ($cart_items as $item): ?>
                          <tr>
                            <td class="col-sm-8 col-md-6">
                              <div class="media">
                                <a class="thumbnail pull-left" href="#">
                                  <img class="media-object" src="admin/insert_product/<?= $item['image'] ?>" alt="#">
                                </a>
                                <div class="media-body">
                                  <h4 class="media-heading"><a href="#"><?= $item['name'] ?></a></h4>
                                  <span>Status: </span>
                                  <span class="text-<?= $item['stock'] > 0 ? 'success' : 'danger' ?>">
                                    <?= $item['stock'] > 0 ? 'In Stock' : 'Out of Stock' ?>
                                  </span>
                                </div>
                              </div>
                            </td>
                            <td class="col-sm-1 col-md-1" style="text-align: center">
                              <input class="form-control" name="quantity[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>"
                                type="number" min="1" max="10">
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                              <p class="price_table">₹<?= number_format($item['new_price'], 2) ?></p>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                              <p class="price_table">₹<?= number_format($item['total'], 2) ?></p>
                            </td>
                            <td class="col-sm-1 col-md-1">
                              <a href="cart.php?remove=<?= $item['id'] ?>" class="bt_main">
                                <i class="fa fa-trash"></i> Remove
                              </a>
                            </td>
                          </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                        <td colspan="5" class="text-center">Your cart is empty</td>
                      </tr>
                  <?php endif; ?>
                </tbody>
              </table>

              <div class="text-right">
                <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
              </div>
            </form>
          </div>
          <div class="shopping-cart-cart">
            <table>
              <tbody>
                <tr class="head-table">
                  <td>
                    <h5>Cart Totals</h5>
                  </td>
                  <td class="text-right"></td>
                </tr>
                <tr>
                  <td>
                    <h4>Subtotal</h4>
                  </td>
                  <td class="text-right">
                    <h4>₹<?= !empty($cart_items) ? number_format($total, 2) : '0.00' ?></h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h5>Estimated shipping</h5>
                  </td>
                  <td class="text-right">
                    <h4>₹<?= !empty($cart_items) ? '49.00' : '0.00' ?></h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h3>Total</h3>
                  </td>
                  <td class="text-right">
                    <h4>₹<?= !empty($cart_items) ? number_format($total + 49, 2) : '0.00' ?></h4>
                  </td>
                </tr>
                <tr>
                  <td class="text-center">
                    <a href="shop.php" class="button">Continue Shopping</a>
                  </td>
                  <td class="text-center">
                    <?php if (!empty($cart_items)): ?>
                        <a href="checkout.php" class="button">Proceed to Checkout</a>
                    <?php else: ?>
                        <a href="#" class="button"
                          style="background-color: #ccc; cursor: not-allowed; pointer-events: none;">Proceed to Checkout</a>
                    <?php endif; ?>
                  </td>
                </tr>
              </tbody>
            </table>
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
                      I am really satisfied with my first laptop service. </div>
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
                      I am really satisfied with my first laptop service. </div>
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
                      I am really satisfied with my first laptop service. </div>
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
                <li><a href="about_us.html"><i class="fa fa-angle-right"></i> About us</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Terms and conditions</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Privacy policy</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> News</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Contact us</a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <div class="main-heading left_text">
                <h2>Services</h2>
              </div>
              <ul class="footer-menu">
                <li><a href="#"><i class="fa fa-angle-right"></i> Data recovery</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Computer repair</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Mobile service</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Network solutions</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Technical support</a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <div class="main-heading left_text">
                <h2>Contact us</h2>
              </div>
              <p>Pramukhdarshan complex, Desai nagar, Bhavnagar, Gujarat 364003<br>
                <span style="font-size:18px;"><a href="tel:+9876543210">+91 9265121020</a></span>
              </p>
              <div class="footer_mail-section">
                <form>
                  <fieldset>
                    <div class="field">
                      <input placeholder="Email" type="text">
                      <button class="button_custom"><i class="fa fa-envelope" aria-hidden="true"></i></button>
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
  <!-- zoom effect -->
  <script src='js/hizoom.js'></script>
  <script>
    $('.hi1').hiZoom({
      width: 300,
      position: 'right'
    });
    $('.hi2').hiZoom({
      width: 400,
      position: 'right'
    });
  </script>
  <script src="js/security.js"></script>
</body>

</html>