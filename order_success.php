<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["username"] === "user") {
  header("Location: login.php");
  exit;
}

$order_id = isset($_GET['order_id']) ? (int) $_GET['order_id'] : 0;

if ($order_id === 0) {
  header("Location: index.php");
  exit;
}

// Database connection
require './config/config.php';

// Get order details
$sql = "SELECT * FROM orders WHERE id = ? AND email = ?";
$stmt = $link->prepare($sql);
$stmt->execute([$order_id, $_SESSION["email"]]);
$order = $stmt->fetch();

if (!$order) {
  header("Location: index.php");
  exit;
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
        <div class="col-md-12">
          <div class="success-page">
            <i class="fa fa-check-circle"></i>
            <h2>Thank you for your order!</h2>
            <p>Your order has been placed and will be processed as soon as possible.</p>
            <p>Make note of your order number, which is: <strong>#<?= $order_id ?></strong></p>

            <div class="order-details">
              <h3>Order Details</h3>
              <table class="table">
                <tr>
                  <td><strong>Order Number:</strong></td>
                  <td>#<?= $order_id ?></td>
                </tr>
                <tr>
                  <td><strong>Order Date:</strong></td>
                  <td><?= date('F j, Y', strtotime($order['order_date'])) ?></td>
                </tr>
                <tr>
                  <td><strong>Name:</strong></td>
                  <td><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></td>
                </tr>
                <tr>
                  <td><strong>Email:</strong></td>
                  <td><?= htmlspecialchars($order['email']) ?></td>
                </tr>
                <tr>
                  <td><strong>Shipping Address:</strong></td>
                  <td><?= htmlspecialchars($order['shipping_address']) ?></td>
                </tr>
              </table>

              <h4 class="mb_15">Ordered Items</h4>
              <table class="table table_detail">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $product_names = explode(',', $order['product_names']);
                  $quantities = explode(',', $order['quantities']);
                  $prices = explode(',', $order['prices']);

                  for ($i = 0; $i < count($product_names); $i++):
                    $item_total = $prices[$i] * $quantities[$i];
                    ?>
                    <tr>
                      <td><?= htmlspecialchars($product_names[$i]) ?></td>
                      <td><?= $quantities[$i] ?></td>
                      <td>₹<?= number_format($prices[$i], 2) ?></td>
                      <td>₹<?= number_format($item_total, 2) ?></td>
                    </tr>
                  <?php endfor; ?>
                  <tr>
                    <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                    <td>₹<?= number_format($order['total_amount'] - 49, 2) ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right"><strong>Shipping:</strong></td>
                    <td>₹49.00</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                    <td><strong>₹<?= number_format($order['total_amount'], 2) ?></strong></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mt_30">
              <a href="shop.php" class="btn main_bt">Continue Shopping</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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