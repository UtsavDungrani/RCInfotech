<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Handle form submission for editing a user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? 'user';

    try {
        $stmt = $link->prepare("UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $_SESSION['success'] = "User updated successfully!";
        header("Location: users.php");
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "Failed to update user. Please try again.";
        header("Location: users.php");
        exit();
    }
}

// Fetch the user's current details for the form
$user = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $link->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "Failed to fetch user details.";
        header("Location: users.php");
        exit();
    }
}
?>
<?php include '../csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link rel="icon" href="../images/logos/logo-1.png" type="image/gif" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="../css/colors1.css" />
    <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="../css/animate.css" />
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="../css/all.min.css">
</head>

<body id="default_theme" class="it_service">
    <!-- loader -->
    <div class="bg_load"> <img class="loader_animation" src="../images/loaders/loader.gif" alt="#" /> </div>
    <!-- end loader -->

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="admin_home.php">Dashboard</a>
        <a href="service_requests.php">Service Requests</a>
        <a href="insert_product/add_product.php">Add Product</a>
        <a href="insert_services/add_service.php">Add Service</a>
        <a href="insert_shop/add_shop.php">Add Shops</a>
        <a href="insert_product/update_product.php">Manage Products</a>
        <a href="insert_services/update_service.php">Manage Services</a>
        <a href="insert_shop/update_shop.php">Manage Shop</a>
        <a href="manage_orders.php">Orders</a>
        <a href="users.php" class="active">Users</a>
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
                                                class="topbar-hightlight">Edit User</span> </li>
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
                <!-- Display success/error messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="main_heading text_align_left home_head">
                                <h2>Edit User</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $user['id'] ?? '' ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="users.php" class="btn btn-secondary">Cancel</a>
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
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/menumaker.js"></script>
    <script src="../js/wow.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/security.js"></script>
</body>

</html>