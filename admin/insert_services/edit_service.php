<?php
session_start();
require_once '../../config/config.php';
require_once '../auth_check.php';

// Check authentication
checkAdminAuth();

$service_id = $_GET['id'] ?? null;

$service = [];
if ($service_id) {
    try {
        $stmt = $link->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$service_id]);
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $page_des = $_POST['page_des'];
    $image_data = $service['image']; // Use current image if no new one uploaded

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            $image_data = file_get_contents($_FILES['image']['tmp_name']);
        } else {
            $_SESSION['error'] = "File is not an image.";
            header("Location: edit_service?id=$service_id");
            exit();
        }
    }

    try {
        $stmt = $link->prepare("UPDATE services SET 
            name = ?, 
            description = ?,
            page_des = ?,
            image = ?
            WHERE id = ?");
        $stmt->execute([$name, $description, $page_des, $image_data, $service_id]);
        header("Location: update_service");
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "Error updating service.";
        header("Location: edit_service?id=$service_id");
        exit();
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
    <title>Edit Service</title>
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
                                <h2>Edit Service</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Service Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= htmlspecialchars($service['name'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="page_des">Page Description</label>
                        <textarea class="form-control" id="page_des" name="page_des" rows="3"
                            required><?= htmlspecialchars($service['page_des'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5"
                            required><?= htmlspecialchars($service['description'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Service Image:</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <?php if (!empty($service['image'])): ?>
                            <div class="mt_10">
                                <img src="../../get_service_image?id=<?= $service_id ?>" alt="Current Service Image"
                                    class="max_width_200">
                                <p class="mt_5">Current Image: <?= $service['name'] ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                    <a href="update_service" class="btn btn-secondary">Cancel</a>
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