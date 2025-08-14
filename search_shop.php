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
  <div class="bg_load"><img class="loader_animation" src="images/loaders/loader.gif" alt="#" /></div>
  <!-- end loader -->
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- end header -->

  <!-- inner page banner -->
  <?php include 'breadcrumbs.php'; ?>
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
            echo '<div class="col-md-4 shop_card">
                        <div class="product_list shop_list">
                            <div class="product_img shop_img"> 
                                <img class="w-100 p-4 img_con" src="get_shop_image?id=' . $row['id'] . '" alt="' . $row['Name'] . '" loading="lazy"> 
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
        if (card.querySelector('.shop_list')) {
          card.style.display = 'none';
        }
      });

      // Then show matching cards and maintain rows
      let visibleCount = 0;
      cards.forEach(card => {
        if (card.querySelector('.shop_list')) {
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