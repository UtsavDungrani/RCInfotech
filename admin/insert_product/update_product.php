<?php
session_start();
require_once '../../config/config.php';
require_once '../auth_check.php';

// Check authentication
checkAdminAuth();

// Fetch all products
$products = [];
try {
    $stmt = $link->query("SELECT * FROM product");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
}
?>
<?php include '../../csp.php';?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Products</title>
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
        <a href="add_product.php">Add Product</a>
        <a href="../insert_services/add_service.php">Add Service</a>
        <a href="../insert_shop/add_shop.php">Add Shops</a>
        <a href="update_product.php" class="active">Manage Products</a>
        <a href="../insert_services/update_service.php">Manage Services</a>
        <a href="../insert_shop/update_shop.php">Manage Shop</a>
        <a href="../manage_orders.php">Orders</a>
        <a href="../users.php">Users</a>
        <a href="#">Settings</a>
        <a href="../index.php">Back to Site</a>
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
                                <h2>Update Products</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Old Price</th>
                            <th>New Price</th>
                            <th>Stock</th>
                            <th>Short Description</th>
                            <th>Long Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td>
                                    <?php if (!empty($product['image'])): ?>
                                        <img src="../../get_product_image.php?id=<?= $product['id'] ?>" alt="<?= $product['name'] ?>"
                                            style="max-width: 100px; height: auto;">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td><?= $product['old_price'] ?></td>
                                <td><?= $product['new_price'] ?></td>
                                <td><?= $product['stock'] ?></td>
                                <td><?= $product['description_small'] ?></td>
                                <td><?= $product['description_large'] ?></td>
                                <td>
                                    <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn btn-danger bg-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Add loader script
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