<?php
session_start();
require_once '../../config/config.php';
require_once '../auth_check.php';

// Check authentication
checkAdminAuth();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $sh_description = $_POST['sh_description'];
    $description = $_POST['description'];

    // Read image as binary data
    $image_data = file_get_contents($_FILES['image']['tmp_name']);

    try {
        // Prepare SQL statement
        $stmt = $link->prepare("INSERT INTO services (name, page_des, image, description) 
                               VALUES (:name, :page_des, :image, :description)");

        // Bind parameters
        $stmt->execute([
            ':name' => $name,
            ':page_des' => $sh_description,
            ':image' => $image_data,
            ':description' => $description
        ]);

        echo "<script>alert('Service added successfully!');</script>";
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo "<script>alert('Error adding service. Please try again.');</script>";
    }
}
?>
<?php include '../../csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Service</title>
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
        <a href="../insert_product/add_product.php">Add Product</a>
        <a href="add_service.php" class="active">Add Service</a>
        <a href="../insert_shop/add_shop.php">Add Shops</a>
        <a href="../insert_product/update_product.php">Manage Products</a>
        <a href="update_service.php">Manage Services</a>
        <a href="../insert_shop/update_shop.php">Manage Shop</a>
        <a href="../manage_orders.php">Orders</a>
        <a href="../users.php">Users</a>
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
                                <h2>Add Service</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="add_service.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Service Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="sh_description">Short Description</label>
                        <textarea class="form-control" id="sh_description" name="sh_description" rows="3"
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Detailed Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Service Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Add Service</button>
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