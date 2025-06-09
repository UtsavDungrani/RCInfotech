<?php
session_start();
require_once '../../config/config.php';
require_once '../auth_check.php';

// Check authentication
checkAdminAuth();

// Get shop ID from URL
$shop_id = $_GET['id'] ?? null;

// Fetch shop data
$shop = [];
if ($shop_id) {
    try {
        $stmt = $link->prepare("SELECT * FROM shop WHERE id = ?");
        $stmt->execute([$shop_id]);
        $shop = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $image_data = $shop['image']; // Keep existing image if no new one is uploaded

    // Handle image upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $image_data = file_get_contents($_FILES['photo']['tmp_name']);
    }

    try {
        $stmt = $link->prepare("UPDATE shop SET 
            Name = ?, 
            Address = ?, 
            `Contact no` = ?,
            image = ?
            WHERE id = ?");
        $stmt->execute([$name, $address, $contact, $image_data, $shop_id]);
        header("Location: update_shop.php");
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
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
    <title>Edit Shop</title>
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
        <a href="../insert_services/add_service.php">Add Service</a>
        <a href="add_shop.php">Add Shop</a>
        <a href="../insert_product/update_product.php">Manage Products</a>
        <a href="../insert_services/update_service.php">Manage Services</a>
        <a href="update_shop.php" class="active">Manage Shops</a>
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
                                <h2>Edit Shop</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Shop Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $shop['Name'] ?? '' ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"
                            required><?= $shop['Address'] ?? '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact"
                            value="<?= $shop['Contact no'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Shop Photo:</label>
                        <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
                        <?php if (!empty($shop['image'])): ?>
                            <img src="../../get_shop_image.php?id=<?= $shop['id'] ?>" alt="<?= $shop['Name'] ?>"
                                style="max-width: 200px; margin-top: 10px;">
                            <p>Current Image: <?= $shop['Name'] ?></p>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Shop</button>
                    <a href="update_shop.php" class="btn btn-secondary">Cancel</a>
                </form>
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