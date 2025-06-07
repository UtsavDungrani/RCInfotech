<?php
session_start();
require_once '../../config/config.php';
require_once '../auth_check.php';

// Add CSP header
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self';");

// Check authentication
checkAdminAuth();

// Add database connection and file upload handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use the existing connection from config.php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Read the image file as binary data
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO product (name, image, old_price, new_price, stock, description_small, description_large) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sbddiss",
        $_POST['name'],
        $imageData,
        $_POST['old_price'],
        $_POST['new_price'],
        $_POST['stock'],
        $_POST['description_small'],
        $_POST['description_large']
    );

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding product: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <link rel="icon" href="../../images/logos/logo-1.png" type="image/gif" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/responsive.css" />
    <link rel="stylesheet" href="../../css/colors1.css" />
    <link rel="stylesheet" href="../../css/custom.css" />
    <link rel="stylesheet" href="../../css/animate.css" />
    <link rel="stylesheet" href="../../css/admin-styles.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <style>
        .loader_animation {
            animation: none;
        }
    </style>
</head>

<body id="default_theme" class="it_service">
    <!-- loader -->
    <div class="bg_load"> <img class="loader_animation" src="../../images/loaders/loader.gif" alt="#" /> </div>
    <!-- end loader -->

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="../admin_home.php">Dashboard</a>
        <a href="../service_requests.php">Service Requests</a>
        <a href="add_product.php" class="active">Add Product</a>
        <a href="../insert_services/add_service.php">Add Service</a>
        <a href="../insert_shop/add_shop.php">Add Shops</a>
        <a href="update_product.php">Manage Products</a>
        <a href="../insert_services/update_service.php">Manage Services</a>
        <a href="../insert_shop/update_shop.php">Manage Shop</a>
        <a href="../manage_orders.php">Orders</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
        <a href="../../index.php">Back to Site</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header id="default_header" class="header_style_1" style="height: 75px;">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="full">
                                <div class="topbar-left">
                                    <ul class="list-inline">
                                        <li> <span class="topbar-label"><i class="fa fa-home"></i></span> <span
                                                class="topbar-hightlight">Admin Dashboard</span> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 admin-con">
                            <div class="admin-profile">
                                <div class="admin-name">
                                    <?php echo $_SESSION['admin_name'] ?? 'Admin'; ?> <i class="fa fa-caret-down"></i>
                                </div>
                                <div class="admin-dropdown">
                                    <!-- <a href="profile.php"><i class="fa fa-user"></i> Profile</a>
                                    <a href="settings.php"><i class="fa fa-cog"></i> Settings</a> -->
                                    <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="section padding_layout_1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="main_heading text_align_left home_head">
                                <h2>Add product</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="old_price">Old Price</label>
                                <input type="number" class="form-control" id="old_price" name="old_price" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_price">New Price</label>
                                <input type="number" class="form-control" id="new_price" name="new_price" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>

                    <div class="form-group">
                        <label for="description_small">Short Description</label>
                        <textarea class="form-control" id="description_small" name="description_small" rows="3"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description_large">Detailed Description</label>
                        <textarea class="form-control" id="description_large" name="description_large" rows="5"
                            required></textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                        <a href="../admin_home.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add this script to hide the loader after a specific duration
        setTimeout(function () {
            document.querySelector('.bg_load').style.display = 'none';
        }, 2000);
    </script>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/menumaker.js"></script>
    <script src="../../js/wow.js"></script>
    <script src="../../js/custom.js"></script>
    <script src="../../js/security.js"></script>
</body>

</html>