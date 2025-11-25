<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Fetch all service requests from the bookser table
$service_requests = [];
try {
    $stmt = $link->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
}
?>
<?php include '../csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service Requests</title>
    <link rel="icon" href="../images/logos/logo-1.png" type="image/gif" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="../css/colors1.css" />
    <link rel="stylesheet" href="../css/animate.css" />
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="../css/all.min.css">
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
                                                class="topbar-hightlight">Users information</span> </li>
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
                                    <a href="logout"><i class="fa fa-sign-out"></i> Logout</a>
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
                                <h2>Users information</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile Photo</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Registration date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td>
                                            <?php
                                            // Prefer stored file path (photo_path) and fall back to binary blob (photo)
                                            if (!empty($user['photo_path'])) {
                                                // Ensure correct relative path when in admin/ folder
                                                $imgSrc = (strpos($user['photo_path'], '/') === 0) ? $user['photo_path'] : '../' . $user['photo_path'];
                                                ?>
                                                <img src="<?= htmlspecialchars($imgSrc) ?>" alt="User Photo" class="user-photo"
                                                    title="Click to view larger"
                                                    onclick="openModal(this.src, '<?= htmlspecialchars($user['name'] ?? $user['username']) ?>')">
                                                <?php
                                            } elseif (!empty($user['photo'])) {
                                                ?>
                                                <img src="data:image/jpeg;base64,<?= base64_encode($user['photo']) ?>"
                                                    alt="User Photo" class="user-photo" title="Click to view larger"
                                                    onclick="openModal(this.src, '<?= htmlspecialchars($user['name'] ?? $user['username']) ?>')">
                                                <?php
                                            } else {
                                                ?>
                                                <div class="user-avatar">
                                                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($user['address']); ?></td>
                                        <td><?php echo htmlspecialchars($user['reg_date']); ?></td>
                                        <td>
                                            <a href="edit_user?id=<?= $user['id'] ?>" class="btn btn-primary">Edit</a>
                                            <a href="delete_user?id=<?= $user['id'] ?>" class="btn btn-danger bg-danger"
                                                onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal (Updated for User Photos) -->
    <div id="imageModal" class="modal main_img_con" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered main_inner_con">
            <div class="modal-content main_inner_content_con">
                <div class="modal-header border-0 main_content_header">
                    <h5 class="modal-title w-100 text-center main_header_text" id="userPhotoModalLabel">
                        User's Profile Photo
                    </h5>
                </div>
                <div class="modal-body text-center main_con_body">
                    <img class="modal-image main_image" id="modalImage" alt="User Photo">
                </div>
                <div class="modal-footer border-0 justify-content-center image_close_btn">
                    <button type="button" class="btn btn-primary" id="closeModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/menumaker.js"></script>
    <script src="../js/wow.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/security.js"></script>
    <script src="../js/profile_image.js"></script>
</body>

</html>