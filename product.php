<?php
# Initialize the session
session_start();

# Set default username if not logged in
if (!isset($_SESSION["username"])) {
  $_SESSION["username"] = "user";
}
// Include database connection
require_once 'config/config.php';

// Get product ID from URL parameter
$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch product details
$sql = "SELECT * FROM product WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
  // Handle case when product is not found
  echo "<script>window.location.href='shop.php';</script>";
  exit;
}

// Add this PHP code near the top of the file, after getting the product ID
$current_group = ceil($product_id / 3);

// Fetch total number of products
$sql_total = "SELECT COUNT(*) as total FROM product";
$result_total = $conn->query($sql_total);
$total_products = $result_total->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
  <!-- site metas -->
  <title>RCInfotech</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
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
  <link rel="stylesheet" href="css/hizoom.css" />
  <!-- end zoom effect -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- Add this CSS in the head section or in your custom.css file -->
  <style>
    /* Hide all products by default */
    [id^="pro_"] {
      display: none;
    }

    <?php
    // Show next 3 products after current product
    for ($i = 1; $i <= 3; $i++) {
      $next_id = $product_id + $i;
      if ($next_id > $total_products) {
        $next_id -= $total_products; // Wrap around to the beginning
      }
      if ($next_id >= 1) {  // Ensure we don't show negative IDs
        echo "#pro_" . $next_id . " { display: block; }\n";
      }
    }
    ?>

    /* Always hide the current product from related products */
    #pro_<?php echo $product_id; ?> {
      display: none !important;
    }

    /* Standardize product image dimensions */
    .product_img {
      width: 270px !important;
      height: 270px !important;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .product_img img {
      width: 270px !important;
      height: 270px !important;
      object-fit: contain;
      object-position: center;
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

    .loader_animation {
      animation: none;
    }

    .button {
      font-size: 15px;
      font-weight: bold;
      border-radius: 5px;
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

      .col-lg-4.col-md-6.col-sm-6.col-xs-12 {
        width: 50%;
        width: 200px;
        margin: 0 auto;
        padding: 0 10px;
      }

      .product-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        margin-left: -20px;
      }

      .product_img {
        height: 180px !important;
        width: 180px !important;
        overflow: hidden;
      }

      .product_detail_btm {
        width: 180px !important;
      }

      .product-grid .col-lg-4.col-md-6.col-sm-6.col-xs-12.margin_bottom_30_all:nth-child(1),
      .product-grid .col-lg-4.col-md-6.col-sm-6.col-xs-12.margin_bottom_30_all:nth-child(2),
      .product-grid .col-lg-4.col-md-6.col-sm-6.col-xs-12.margin_bottom_30_all:nth-child(3) {
        margin-bottom: 20px;
      }

      .product-grid .col-lg-4.col-md-6.col-sm-6.col-xs-12.margin_bottom_30_all:nth-child(3) {
        grid-column: 1/3;
      }
    }
  </style>
</head>

<body id="default_theme" class="it_shop_detail">
  <!-- loader -->
  <div class="bg_load">
    <img class="loader_animation" src="images/loaders/loader.gif" alt="#" />
  </div>
  <!-- end loader -->
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- end header -->
  <!-- inner page banner -->
  <?php include 'breadcrumbs.php'; ?>
  <!-- end inner page banner -->
  <!-- section -->
  <div class="section padding_layout_1 product_detail">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12">
              <div class="product_detail_feature_img hizoom hi2">
                <div class="hizoom hi2">
                  <img src="admin/insert_product/<?php echo htmlspecialchars($product['image']); ?>" alt="#" />
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 product_detail_side detail_style1">
              <div class="product-heading" id="product_heading">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
              </div>
              <div class="product-detail-side">
                <span><del>₹<?php echo htmlspecialchars($product['old_price']); ?>.00</del></span><span
                  class="new-price">₹<?php echo htmlspecialchars($product['new_price']); ?>.00</span>
                <span class="rating">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star-o" aria-hidden="true"></i>
                </span>
                <span class="review">(5 customer review)</span>
              </div>
              <div class="detail-contant">
                <p>
                  <?php echo htmlspecialchars($product['description_small']); ?>
                  <br /><br />
                  <span class="stock" style="font-weight:600;"><?php echo (int) $product['stock']; ?> in stock</span>
                </p>
                <form class="cart" method="post" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                  <div class="quantity">
                    <input step="1" min="1" max="5" name="quantity" value="1" title="Qty" class="input-text qty text"
                      size="4" type="number" />
                  </div>
                  <button type="submit" name="add_to_cart" class="btn sqaure_bt">
                    Add to cart
                  </button>
                </form>
              </div>
              <div class="share-post">
                <a href="#" class="share-text">Share</a>
                <ul class="social_icons">
                  <li>
                    <a href="#"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="full">
                <div class="tab_bar_section">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#reviews">Reviews (2)</a>
                    </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div id="description" class="tab-pane active">
                      <div class="product_desc">
                        <p>
                          <?php echo nl2br(htmlspecialchars($product['description_large'])); ?>
                        </p>
                      </div>
                    </div>
                    <div id="reviews" class="tab-pane fade">
                      <div class="product_review">
                        <h3>Reviews (2)</h3>
                        <div class="commant-text row">
                          <div class="col-lg-2 col-md-2 col-sm-4">
                            <div class="profile">
                              <img class="img-responsive" src="images/it_service/client1.png" alt="#" />
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-10 col-sm-8">
                            <h5>David</h5>
                            <p>
                              <span class="c_date">March 2, 2018</span> |
                              <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span>
                            </p>
                            <span class="rating">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                            </span>
                            <p class="msg">
                              ThisThis book is a treatise on the theory of
                              ethics, very popular during the Renaissance. The
                              first line of Lorem Ipsum, "Lorem ipsum dolor
                              sit amet..
                            </p>
                          </div>
                        </div>
                        <div class="commant-text row">
                          <div class="col-lg-2 col-md-2 col-sm-4">
                            <div class="profile">
                              <img class="img-responsive" src="images/it_service/client2.png" alt="#" />
                            </div>
                          </div>
                          <div class="col-lg-10 col-md-10 col-sm-8">
                            <h5>Jack</h5>
                            <p>
                              <span class="c_date">March 2, 2018</span> |
                              <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span>
                            </p>
                            <span class="rating">
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-o" aria-hidden="true"></i>
                            </span>
                            <p class="msg">
                              Nunc augue purus, posuere in accumsan sodales
                              ac, euismod at est. Nunc faccumsan ermentum
                              consectetur metus placerat mattis. Praesent
                              mollis justo felis, accumsan faucibus mi maximus
                              et. Nam hendrerit mauris id scelerisque
                              placerat. Nam vitae imperdiet turpis
                            </p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="full review_bt_section">
                              <div class="float-right">
                                <a class="btn sqaure_bt" data-toggle="collapse" href="#collapseExample" role="button"
                                  aria-expanded="false" aria-controls="collapseExample">Leave a Review</a>
                              </div>
                            </div>
                            <div class="full">
                              <div id="collapseExample" class="full collapse commant_box">
                                <form accept-charset="UTF-8" action="index.html" method="post">
                                  <input id="ratings-hidden" name="rating" type="hidden" />
                                  <textarea class="form-control animated" cols="50" id="new-review" name="comment"
                                    placeholder="Enter your review here..." required=""></textarea>
                                  <div class="full_bt center">
                                    <button class="btn sqaure_bt" type="submit">
                                      Save
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="full">
                <div class="main_heading text_align_left" style="margin-bottom: 35px">
                  <h3>Related products</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="row product-grid">
            <?php
            // Show next 3 products after current product
            for ($i = 1; $i <= 3; $i++) {
              $next_id = $product_id + $i;
              if ($next_id > $total_products) {
                $next_id -= $total_products; // Wrap around to the beginning
              }
              if ($next_id >= 1) {  // Ensure we don't show negative IDs
                $sql = "SELECT * FROM product WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $next_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $related_product = $result->fetch_assoc();

                if ($related_product) {
                  echo '
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                                <a href="product.php?id=' . $related_product['id'] . '">
                  <div class="product_list">
                    <div class="product_img" style="height: 270px;">
                                            <img class="img-responsive img-product" src="admin/insert_product/' . $related_product['image'] . '" alt="" />
                    </div>
                    <div class="product_detail_btm">
                      <div class="center">
                                                <h4>' . $related_product['name'] . '</h4>
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
                                                    <span class="old_price">₹' . $related_product['old_price'] . '.00</span> –
                                                    <span class="new_price"> ₹' . $related_product['new_price'] . '.00</span>
                        </p>
                      </div>
                    </div>
                  </div>
                </a>
                            </div>';
                }
              }
            }
            ?>
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
              <p>
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
  <!-- zoom effect -->
  <script src="js/hizoom.js"></script>
  <script>
    $(".hi1").hiZoom({
      width: 300,
      position: "right",
    });
    $(".hi2").hiZoom({
      width: 400,
      position: "right",
    });
  </script>
  <script src="js/security.js"></script>
</body>

</html>