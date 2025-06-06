<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}

// Redirect to login if user is not logged in properly
if ($_SESSION["username"] === "user") {
  header("Location: login.php");
  exit;
}

// Start session and initialize cart if not exists
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';

// Database connection
require './config/config.php';

// Get cart items and calculate total
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
  }
}

// Process checkout
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
  // Validate form data
  $errors = [];

  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $address = trim($_POST['address']);
  $city = trim($_POST['city']);
  $state = trim($_POST['state']);
  $zip = trim($_POST['zip']);

  if (empty($first_name))
    $errors[] = "First name is required";
  if (empty($last_name))
    $errors[] = "Last name is required";
  if (empty($email))
    $errors[] = "Email is required";
  if (empty($phone))
    $errors[] = "Phone number is required";
  if (!preg_match("/^[6-9][0-9]{9}$/", $phone))
    $errors[] = "Please enter a valid 10-digit Indian mobile number starting with 6-9";
  if (empty($address))
    $errors[] = "Address is required";
  if (empty($city))
    $errors[] = "City is required";
  if (empty($state))
    $errors[] = "State is required";
  if (empty($zip))
    $errors[] = "ZIP code is required";

  if (empty($errors)) {
    // Create order in database
    $shipping_address = "$address, $city, $state - $zip";
    $order_total = $total + 49; // Adding shipping cost
    $user_email = $_SESSION['email'];

    // Prepare product details from cart items
    $product_names = [];
    $quantities = [];
    $prices = [];
    foreach ($cart_items as $item) {
      $product_names[] = $item['name'];
      $quantities[] = $item['quantity'];
      $prices[] = $item['new_price'];
    }

    $product_names_str = implode(',', $product_names);
    $quantities_str = implode(',', $quantities);
    $prices_str = implode(',', $prices);

    $sql = "INSERT INTO orders (user_email, first_name, last_name, email, phone, shipping_address, total_amount, product_names, quantities, prices, order_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $link->prepare($sql);
    $stmt->execute([$user_email, $first_name, $last_name, $email, $phone, $shipping_address, $order_total, $product_names_str, $quantities_str, $prices_str]);

    if ($stmt->rowCount() > 0) {
      $order_id = $link->lastInsertId();

      // Send confirmation email
      $mail = new PHPMailer(true);

      try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rcinfotech11@gmail.com';
        $mail->Password = 'eolm wbba majw jlaa';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Additional settings to improve deliverability
        $mail->SMTPOptions = [
          'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
          ],
        ];

        // Recipients
        $mail->setFrom('rcinfotech11@gmail.com', 'IT Next Services');
        $mail->addReplyTo('support@rcinfotech.com', 'IT Next Services');
        $mail->addAddress($email, $first_name . ' ' . $last_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Order Confirmation - IT Next Store';

        // Create order items HTML
        $items_html = '';
        foreach ($cart_items as $item) {
          $items_html .= "<tr>
                        <td style='padding: 8px; border: 1px solid #ddd;'>{$item['name']}</td>
                        <td style='padding: 8px; border: 1px solid #ddd;'>{$item['quantity']}</td>
                        <td style='padding: 8px; border: 1px solid #ddd;'>₹" . number_format($item['new_price'], 2) . "</td>
                        <td style='padding: 8px; border: 1px solid #ddd;'>₹" . number_format($item['total'], 2) . "</td>
                    </tr>";
        }

        $mail->Body = "
                <html>
                <body style='font-family: Arial, sans-serif;'>
                    <h2>Order Confirmation</h2>
                    <p>Dear {$first_name} {$last_name},</p>
                    <p>Thank you for your order! Your order has been successfully placed.</p>
                    
                    <h3>Order Details:</h3>
                    <p><strong>Order Number:</strong> #{$order_id}</p>
                    <p><strong>Order Date:</strong> " . date('F j, Y') . "</p>
                    
                    <h3>Items Ordered:</h3>
                    <table style='border-collapse: collapse; width: 100%; max-width: 600px;'>
                        <tr>
                            <th style='padding: 8px; border: 1px solid #ddd; background-color: #f8f8f8;'>Product</th>
                            <th style='padding: 8px; border: 1px solid #ddd; background-color: #f8f8f8;'>Quantity</th>
                            <th style='padding: 8px; border: 1px solid #ddd; background-color: #f8f8f8;'>Price</th>
                            <th style='padding: 8px; border: 1px solid #ddd; background-color: #f8f8f8;'>Total</th>
                        </tr>
                        {$items_html}
                        <tr>
                            <td colspan='3' style='padding: 8px; border: 1px solid #ddd; text-align: right;'><strong>Subtotal:</strong></td>
                            <td style='padding: 8px; border: 1px solid #ddd;'>₹" . number_format($total, 2) . "</td>
                        </tr>
                        <tr>
                            <td colspan='3' style='padding: 8px; border: 1px solid #ddd; text-align: right;'><strong>Shipping:</strong></td>
                            <td style='padding: 8px; border: 1px solid #ddd;'>₹49.00</td>
                        </tr>
                        <tr>
                            <td colspan='3' style='padding: 8px; border: 1px solid #ddd; text-align: right;'><strong>Total:</strong></td>
                            <td style='padding: 8px; border: 1px solid #ddd;'><strong>₹" . number_format($order_total, 2) . "</strong></td>
                        </tr>
                    </table>
                    
                    <h3>Shipping Address:</h3>
                    <p>{$shipping_address}</p>
                    
                    <p>We will notify you when your order has been shipped.</p>
                    
                    <p>If you have any questions about your order, please contact our customer service.</p>
                    
                    <p>Best regards,<br>IT Next Store Team</p>
                </body>
                </html>";

        $mail->AltBody = "Plain text version of your email";

        $mail->send();
      } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
      }

      // Clear the cart
      unset($_SESSION['cart']);

      // Redirect to success page
      header("Location: order_success.php?order_id=" . $order_id);
      exit;
    } else {
      $errors[] = "Error processing order. Please try again.";
    }
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

      .order-summary {
        margin-top: 25px;
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
                <h1 class="page-title">Checkout</h1>
                <ol class="breadcrumb">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="cart.php">Cart</a></li>
                  <li class="active">Checkout</li>
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
        <div class="col-md-8">
          <div class="checkout-form">
            <h3>Shipping Details</h3>
            <?php if (!empty($errors)): ?>
                <div class="error">
                  <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="checkout.php">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>First Name *</label>
                    <input type="text" name="first_name" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" name="last_name" class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email Address *</label>
                    <input type="email" name="email" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="tel" name="phone" class="form-control" required pattern="^[6-9][0-9]{9}$"
                      maxlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                      title="Please enter valid 10 digit Indian mobile number starting with 6-9">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Street Address *</label>
                <input type="text" name="address" class="form-control" required>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>City *</label>
                    <input type="text" name="city" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>State *</label>
                    <input type="text" name="state" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>ZIP Code *</label>
                    <input type="text" name="zip" class="form-control" required>
                  </div>
                </div>
              </div>

              <button type="submit" name="place_order" class="btn main_bt">Place Order</button>
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="order-summary">
            <h3>Order Summary</h3>
            <table class="table">
              <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                      <td><?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?></td>
                      <td class="text-right">₹<?= number_format($item['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                  <td>Subtotal</td>
                  <td class="text-right">₹<?= number_format($total, 2) ?></td>
                </tr>
                <tr>
                  <td>Shipping</td>
                  <td class="text-right">₹49.00</td>
                </tr>
                <tr>
                  <th>Total</th>
                  <th class="text-right">₹<?= number_format($total + 49, 2) ?></th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

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

  <script>
    // Phone number validation
    document.querySelector('input[name="phone"]').addEventListener('input', function (e) {
      // Remove any non-numeric characters
      this.value = this.value.replace(/[^0-9]/g, '');

      // Ensure first digit is 6-9
      if (this.value.length > 0) {
        const firstDigit = parseInt(this.value[0]);
        if (firstDigit < 6) {
          this.value = '';
        }
      }
    });

    // Prevent paste of non-numeric characters
    document.querySelector('input[name="phone"]').addEventListener('paste', function (e) {
      e.preventDefault();
      const pastedText = (e.clipboardData || window.clipboardData).getData('text');
      if (/^[6-9][0-9]*$/.test(pastedText)) {
        this.value = pastedText.slice(0, 10);
      }
    });
  </script>
  <script src="js/security.js"></script>
</body>

</html>