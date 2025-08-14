<?php
session_start();
require_once '../../config/config.php';
require_once '../auth_check.php';

// Check authentication
checkAdminAuth();

// Add database connection and file upload handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $file_type = $_FILES["image"]["type"];

        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Error: Only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        } else {
            // Check file size (limit to 5MB)
            if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
                echo "<script>alert('Error: File size must be less than 5MB.');</script>";
            } else {
                try {
                    // Read the image file as binary data
                    $image_data = file_get_contents($_FILES["image"]["tmp_name"]);

                    if ($image_data === false) {
                        echo "<script>alert('Error: Could not read uploaded file.');</script>";
                    } else {
                        // Use PDO connection for consistency
                        $stmt = $link->prepare("INSERT INTO product (name, image, old_price, new_price, stock, description_small, description_large) VALUES (:name, :image, :old_price, :new_price, :stock, :small_des, :large_des)");

                        $result = $stmt->execute([
                            ':name' => $_POST['name'],
                            ':image' => $image_data,
                            ':old_price' => $_POST['old_price'],
                            ':new_price' => $_POST['new_price'],
                            ':stock' => $_POST['stock'],
                            ':small_des' => $_POST['description_small'],
                            ':large_des' => $_POST['description_large']
                        ]);

                        if ($result) {
                            echo "<script>alert('Product added successfully!'); window.location.href='../admin_home.php';</script>";
                        } else {
                            echo "<script>alert('Error adding product: " . implode(", ", $stmt->errorInfo()) . "');</script>";
                        }
                    }
                } catch (PDOException $e) {
                    echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Error: Please select a valid image file.');</script>";
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
    <title>Add Product</title>
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
                        <small class="form-text text-muted">Supported formats: JPG, JPEG, PNG, GIF. Maximum size:
                            5MB</small>
                        <div id="imagePreview" class="mt-2 disp_none">
                            <img id="preview" src="#" alt="Preview" class="img_preview_con">
                        </div>
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

        // Image preview and validation
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');

            if (file) {
                // Check file size (5MB limit)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    this.value = '';
                    previewDiv.style.display = 'none';
                    return;
                }

                // Check file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Only JPG, JPEG, PNG & GIF files are allowed');
                    this.value = '';
                    previewDiv.style.display = 'none';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    previewDiv.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.style.display = 'none';
            }
        });
    </script>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/menumaker.js"></script>
    <script src="../../js/wow.js"></script>
    <script src="../../js/custom.js"></script>
    <script src="../../js/security.js"></script>
</body>

</html>