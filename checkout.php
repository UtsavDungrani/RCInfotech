<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}

// Redirect to login if user is not logged in properly
if ($_SESSION["username"] === "user") {
  header("Location: login");
  exit;
}

// Start session and initialize cart if not exists
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Redirect to index.php if cart is empty
if (empty($_SESSION['cart'])) {
  header("Location: index");
  exit;
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
  $phone = trim($_POST['frm_contact']);
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

    $sql = "INSERT INTO orders (first_name, last_name, email, phone, shipping_address, total_amount, product_names, quantities, prices, order_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $link->prepare($sql);
    $stmt->execute([$first_name, $last_name, $email, $phone, $shipping_address, $order_total, $product_names_str, $quantities_str, $prices_str]);

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
                        <td>{$item['name']}</td>
                        <td>{$item['quantity']}</td>
                        <td>₹" . number_format($item['new_price'], 2) . "</td>
                        <td>₹" . number_format($item['total'], 2) . "</td>
                    </tr>";
        }

        $mail->Body = "
                <html>
                <head>
                  <style>
                    body {
                      font-family: Arial, sans-serif;
                    }
                    table {
                      border-collapse: collapse; 
                      width: 100%; 
                      max-width: 600px;
                    }
                    th {
                      padding: 8px; 
                      border: 1px solid #ddd; 
                      background-color: #f8f8f8;
                    }
                    td {
                      padding: 8px; 
                      border: 1px solid #ddd;
                    }
                    .text_right {
                      text-align: right;
                    }
                  </style>
                </head>
                <body>
                    <h2>Order Confirmation</h2>
                    <p>Dear {$first_name} {$last_name},</p>
                    <p>Thank you for your order! Your order has been successfully placed.</p>
                    
                    <h3>Order Details:</h3>
                    <p><strong>Order Number:</strong> #{$order_id}</p>
                    <p><strong>Order Date:</strong> " . date('F j, Y') . "</p>
                    
                    <h3>Items Ordered:</h3>
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        {$items_html}
                        <tr>
                            <td colspan='3' class='text_right'><strong>Subtotal:</strong></td>
                            <td>₹" . number_format($total, 2) . "</td>
                        </tr>
                        <tr>
                            <td colspan='3' class='text_right'><strong>Shipping:</strong></td>
                            <td>₹49.00</td>
                        </tr>
                        <tr>
                            <td colspan='3' class='text_right'><strong>Total:</strong></td>
                            <td><strong>₹" . number_format($order_total, 2) . "</strong></td>
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
      header("Location: order_success?order_id=" . $order_id);
      exit;
    } else {
      $errors[] = "Error processing order. Please try again.";
    }
  }
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
  <!-- end zoom effect -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body id="default_theme" class="it_serv_shopping_cart shopping-cart">
  <!-- loader -->
  <div class="bg_load"> <img class="loader_animation" src="images/loaders/loader.gif" alt="#" /> </div>
  <!-- end loader -->
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- end header -->

  <!-- inner page banner -->
  <?php include 'breadcrumbs.php'; ?>
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

            <form method="post" action="checkout">
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
                    <input type="tel" name="frm_contact" class="form-control" required pattern="^[6-9][0-9]{9}$"
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

  <script src="js/form_validation.js"></script>
  <script src="js/security.js"></script>
</body>

</html>