<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["username"] === "user") {
  header("Location: login");
  exit;
}

$booking_id = isset($_GET['booking_id']) ? (int) $_GET['booking_id'] : 0;

if ($booking_id === 0) {
  header("Location: index");
  exit;
}

// Database connection
require './config/config.php';

// Get booking details
$sql = "SELECT * FROM bookser WHERE id = ? AND email = ?";
$stmt = $link->prepare($sql);
$stmt->execute([$booking_id, $_SESSION["email"]]);
$booking = $stmt->fetch();

if (!$booking) {
  header("Location: index");
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
                  <td><strong>Address:</strong></td>
                  <td><?= htmlspecialchars($booking['address']) ?></td>
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

            <div class="mt_30">
              <a href="service" class="btn main_bt">Continue to Services</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- section -->
  <?php include 'testimonial.php'; ?>
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