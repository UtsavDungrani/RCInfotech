<?php
session_start();
require_once '../../config/config.php';
require_once '../auth_check.php';

// Check authentication
checkAdminAuth();

// Get product ID from URL
$product_id = $_GET['id'] ?? null;

// Fetch product data
$product = [];
if ($product_id) {
    try {
        $stmt = $link->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $old_price = $_POST['old_price'];
    $new_price = $_POST['new_price'];
    $stock = $_POST['stock'];
    $description_small = $_POST['description_small'];
    $description_large = $_POST['description_large'];
    $image_data = $product['image']; // Keep existing image if no new one is uploaded

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_data = file_get_contents($_FILES['image']['tmp_name']);
    }

    try {
        $stmt = $link->prepare("UPDATE product SET 
            name = ?, 
            old_price = ?, 
            new_price = ?, 
            stock = ?, 
            description_small = ?, 
            description_large = ?,
            image = ?
            WHERE id = ?");
        $stmt->execute([$name, $old_price, $new_price, $stock, $description_small, $description_large, $image_data, $product_id]);
        header("Location: update_product.php");
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
    <title>Edit Product</title>
    <link rel="icon" href="../../images/logos/logo-1.png" type="image/gif" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/responsive.css" />
    <link rel="stylesheet" href="../../css/colors1.css" />
    <link rel="stylesheet" href="../../css/animate.css" />
    <link rel="stylesheet" href="../../css/admin-styles.css">
    <link rel="stylesheet" href="../../css/all.min.css">
</head>

<body id="default_theme" class="it_service">
    <!-- loader -->
    <div class="bg_load"> <img class="loader_animation" src="../../images/loaders/loader.gif" alt="#" /> </div>
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
                                <h2>Edit Product</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= $product['name'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="old_price">Old Price</label>
                        <input type="number" step="0.01" class="form-control" id="old_price" name="old_price"
                            value="<?= $product['old_price'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="new_price">New Price</label>
                        <input type="number" step="0.01" class="form-control" id="new_price" name="new_price"
                            value="<?= $product['new_price'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock"
                            value="<?= $product['stock'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description_small">Short Description</label>
                        <textarea class="form-control" id="description_small" name="description_small"
                            rows="3"><?= $product['description_small'] ?? '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description_large">Long Description</label>
                        <textarea class="form-control" id="description_large" name="description_large"
                            rows="5"><?= $product['description_large'] ?? '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <?php if (!empty($product['image'])): ?>
                            <img src="../../get_product_image.php?id=<?= $product['id'] ?>" alt="Current Product Image"
                                class="max_width_200 mt_10">
                            <p>Current Image: <?= $product['name'] ?></p>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="update_product.php" class="btn btn-secondary">Cancel</a>
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