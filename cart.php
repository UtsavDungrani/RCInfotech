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
  <div class="section padding_layout_1 Shopping_cart_section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <div class="product-table">
            <form method="post" action="cart">
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
                            <a class="thumbnail pull-left" href="product?id=<?= $item['id'] ?>">
                              <img class="media-object" src="get_product_image?id=<?= $item['id'] ?>" alt="#">
                            </a>
                            <div class="media-body">
                              <h4 class="media-heading"><a href="product?id=<?= $item['id'] ?>"><?= $item['name'] ?></a></h4>
                              <span>Status: </span>
                              <span class="text-<?= $item['stock'] > 0 ? 'success' : 'danger' ?>">
                                <?= $item['stock'] > 0 ? 'In Stock' : 'Out of Stock' ?>
                              </span>
                            </div>
                          </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text_center align-middle">
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
                          <a href="cart?remove=<?= $item['id'] ?>" class="bt_main">
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
                    <a href="shop" class="button">Continue Shopping</a>
                  </td>
                  <td class="text-center">
                    <?php if (!empty($cart_items)): ?>
                      <a href="checkout" class="button">Proceed to Checkout</a>
                    <?php else: ?>
                      <a href="#" class="button check_out_btn">Proceed to Checkout</a>
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