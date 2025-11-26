<?php
session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../auth_check.php';

// Check authentication
checkAdminAuth();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $sh_description = $_POST['sh_description'];
    $description = $_POST['description'];

    // Validate file upload
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error: Invalid file upload.');</script>";
    } else {
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = mime_content_type($_FILES['image']['tmp_name']);

        if (!in_array($file_type, $allowed_types)) {
            echo "<script>alert('Error: Invalid file type. Only JPEG, PNG, GIF, and WebP images are allowed.');</script>";
        } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) { // 5MB limit
            echo "<script>alert('Error: File size exceeds 5MB limit.');</script>";
        } else {
            // Create uploads directory if it doesn't exist
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/RCInfotech/uploads/services/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate unique filename
            $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = 'service_' . time() . '_' . rand(1000, 9999) . '.' . $file_extension;
            $filepath = $upload_dir . $filename;
            $image_path = 'uploads/services/' . $filename;

            // Move uploaded file to uploads directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {
                try {
                    // Prepare SQL statement
                    $stmt = $link->prepare("INSERT INTO services (name, page_des, image_path, description) 
                                           VALUES (:name, :page_des, :image_path, :description)");

                    // Bind parameters
                    $stmt->execute([
                        ':name' => $name,
                        ':page_des' => $sh_description,
                        ':image_path' => $image_path,
                        ':description' => $description
                    ]);

                    echo "<script>alert('Service added successfully!');</script>";
                } catch (PDOException $e) {
                    // Delete file if database insertion failed
                    unlink($filepath);
                    error_log("Database error: " . $e->getMessage());
                    echo "<script>alert('Error adding service. Please try again.');</script>";
                }
            } else {
                echo "<script>alert('Error: Failed to upload image file.');</script>";
            }
        }
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
    <title>Add Service</title>
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
                                <h2>Add Service</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="add_service" method="post" enctype="multipart/form-data">
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