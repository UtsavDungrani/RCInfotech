<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Fetch all service requests from the bookser table
$service_requests = [];
try {
    $stmt = $link->query("SELECT * FROM bookser ORDER BY booking_time DESC");
    $service_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
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
    <title>Service Requests</title>
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
        <a href="service_requests.php" class="active">Service Requests</a>
        <a href="insert_product/add_product.php">Add Product</a>
        <a href="insert_services/add_service.php">Add Service</a>
        <a href="insert_shop/add_shop.php">Add Shops</a>
        <a href="insert_product/update_product.php">Manage Products</a>
        <a href="insert_services/update_service.php">Manage Services</a>
        <a href="insert_shop/update_shop.php">Manage Shop</a>
        <a href="manage_orders.php">Orders</a>
        <a href="#">Users</a>
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
                                                class="topbar-hightlight">Service Requests</span> </li>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="main_heading text_align_left home_head">
                                <h2>Service Requests</h2>
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
                                    <th>First Name</th>
                                    <th style="max-width: 130px; word-wrap: break-word;">Email</th>
                                    <th style="max-width: 150px; word-wrap: break-word;">Account info</th>
                                    <th>Mobile</th>
                                    <th>Subject</th>
                                    <th style="max-width: 120px; word-wrap: break-word;">Description</th>
                                    <th style="min-width: 101px; word-wrap: break-word;">Booking Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($service_requests as $request): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($request['id']); ?></td>
                                            <td><?php echo htmlspecialchars($request['fname']); ?>
                                                <?php echo htmlspecialchars($request['lname']); ?>
                                            </td>
                                            <td style="max-width: 130px; word-wrap: break-word;">
                                                <?php echo htmlspecialchars($request['email']); ?>
                                            </td>
                                            <td style="max-width: 150px; word-wrap: break-word;">
                                                <?php echo htmlspecialchars($request['booked_by_email']); ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($request['mobile']); ?></td>
                                            <td><?php echo htmlspecialchars($request['subject']); ?></td>
                                            <td style="max-width: 120px; word-wrap: break-word;">
                                                <?php echo htmlspecialchars($request['description']); ?>
                                            </td>
                                            <td style="min-width: 101px; word-wrap: break-word;">
                                                <?php echo htmlspecialchars($request['booking_time']); ?>
                                            </td>
                                            <td>
                                                <span style="
                                            <?php
                                            $status = htmlspecialchars($request['status'] ?? 'Pending');
                                            if ($status === 'approved') {
                                                echo 'background-color: green; color: white;';
                                            } elseif ($status === 'rejected') {
                                                echo 'background-color: red; color: white;';
                                            } elseif ($status === 'pending') {
                                                echo 'background-color: blue; color: white;';
                                            }
                                            ?>
                                            padding: 5px 15px; border-radius: 20px; display: inline-block;
                                        ">
                                                    <?php echo $status; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <form action="update_status.php" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $request['id']; ?>">
                                                    <button type="submit" name="status" value="approved"
                                                        class="btn btn-success btn-sm"
                                                        style="background-color: green; padding: 2px 8px; margin: 2px;">Approve</button>
                                                    <button type="submit" name="status" value="rejected"
                                                        class="btn btn-danger btn-sm"
                                                        style="background-color: red; padding: 2px 8px; margin: 2px;">Reject</button>
                                                </form>
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