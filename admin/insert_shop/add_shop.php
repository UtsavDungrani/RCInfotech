<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../auth_check.php';

// Check authentication
checkAdminAuth();

// Initialize variables
$message = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Create database connection
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $image_path = null;

        // Handle file upload
        if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            echo "<script>alert('Please select a photo for the shop.');</script>";
            exit();
        } else {
            // Validate file type
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            $file_type = mime_content_type($_FILES['photo']['tmp_name']);

            if (!in_array($file_type, $allowed_types)) {
                echo "<script>alert('Error: Invalid file type. Only JPEG, PNG, GIF, and WebP images are allowed.');</script>";
                exit();
            } elseif ($_FILES['photo']['size'] > 5 * 1024 * 1024) { // 5MB limit
                echo "<script>alert('Error: File size exceeds 5MB limit.');</script>";
                exit();
            } else {
                // Create uploads directory if it doesn't exist
                $upload_dir = __DIR__ . '/../../uploads/shop/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                // Generate unique filename
                $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $filename = 'shop_' . time() . '_' . rand(1000, 9999) . '.' . $file_extension;
                $filepath = $upload_dir . $filename;
                $image_path = 'uploads/shop/' . $filename;

                // Move uploaded file to uploads directory
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
                    echo "<script>alert('Error: Failed to upload image file.');</script>";
                    exit();
                }
            }
        }

        // Insert new shop
        $sql = "INSERT INTO shop (Name, Address, `Contact no`, image_path) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        // Bind parameters (all as strings to be safe) and execute
        if (!$stmt->bind_param('ssss', $name, $address, $contact, $image_path)) {
            throw new Exception('Bind failed: ' . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Shop added successfully!');</script>";
        } else {
            // Delete file if database insertion failed
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            throw new Exception("Error: Failed to insert shop.");
        }

    } catch (Exception $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>
<?php include 'pages/csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Shop</title>
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
     <?php
    // Try primary address first, fallback to relative path if it doesn't exist
    $navbar_primary = $_SERVER['DOCUMENT_ROOT'] . '/rcinfotech/admin/navbar.php';
    $navbar_fallback = $_SERVER['DOCUMENT_ROOT'] . '/admin/navbar.php';

    if (file_exists($navbar_primary)) {
        include_once $navbar_primary;
    } elseif (file_exists($navbar_fallback)) {
        include_once $navbar_fallback;
    } else {
        error_log("Navbar file not found at either: $navbar_primary or $navbar_fallback");
    }
    ?>

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
                                    <a href="../logout"><i class="fa fa-sign-out"></i> Logout</a>
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
                                <h2>Add Shop</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $message; ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Shop Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="number" class="form-control" id="contact" name="contact" required>
                    </div>

                    <div class="form-group">
                        <label for="photo">Shop Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Add Shop</button>
                        <a href="../admin_home" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/menumaker.js"></script>
    <script src="../../js/wow.js"></script>
    <script src="../../js/custom.js"></script>
    <script src="../../js/security.js"></script>
</body>

</html>