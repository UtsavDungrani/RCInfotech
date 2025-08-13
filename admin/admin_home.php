<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Add database connection and product count query
$product_count = 0;
$services_count = 0; // Add variable for services count
$shops_count = 0; // Add variable for shops count
$users_count = 0; // Add variable for users count
try {
    // Product count
    $stmt = $link->query("SELECT COUNT(*) as total_products FROM product");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $product_count = $result['total_products'];

    // Services count
    $stmt = $link->query("SELECT COUNT(*) as total_services FROM services");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $services_count = $result['total_services'];

    // Shops count
    $stmt = $link->query("SELECT COUNT(*) as total_shops FROM shop");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $shops_count = $result['total_shops'];

    // Users count
    $stmt = $link->query("SELECT COUNT(*) as total_users FROM users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $users_count = $result['total_users'];

    $stmt = $link->query("SELECT COUNT(*) as total_orders FROM orders");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $orders_count = $result['total_orders'];

    $stmt = $link->query("SELECT SUM(total_amount) as total_amount FROM orders");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $orders_amount = $result['total_amount'];
} catch (PDOException $e) {
    // Handle error or log it
    error_log("Database error: " . $e->getMessage());
}
?>
<?php include '../csp.php';?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="icon" href="../images/logos/logo-1.png" type="image/gif" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="../css/colors1.css" />
    <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="../css/animate.css" />
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        .loader_animation {
            animation: none;
        }
    </style>
</head>

<body id="default_theme" class="it_service">
    <!-- loader -->
    <div class="bg_load"> <img class="loader_animation" src="../images/loaders/loader.gif" alt="#" /> </div>
    <!-- end loader -->

    <!-- Sidebar -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/RCInfotech/admin/navbar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <header id="default_header" class="header_style_1 height_75">
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
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
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
                                <h2>Dashboard Overview</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Total Products</h3>
                        <p><?php echo $product_count; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Services</h3>
                        <p><?php echo $services_count; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Shops</h3>
                        <p><?php echo $shops_count; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Users</h3>
                        <p><?php echo $users_count; ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Orders</h3>
                        <p><?php echo $orders_count; ?></p>
                    </div>
                    <div class="card">
                        <h3>Revenue</h3>
                        <p>₹<?php echo $orders_amount; ?></p>
                    </div>
                </div>

                <div class="row mt_30">
                    <div class="col-md-6">
                        <div class="card">
                            <h3>Recent Orders</h3>
                            <!-- Add recent orders table here -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <h3>System Status</h3>
                            <!-- Add system status information here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add this script to hide the loader after a specific duration
        setTimeout(function () {
            document.querySelector('.bg_load').style.display = 'none';
        }, 2000);
    </script>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/menumaker.js"></script>
    <script src="../js/wow.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/security.js"></script>

</body>

</html>