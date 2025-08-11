<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Fetch all service requests from the bookser table
$service_requests = [];
// Pagination setup
$records_per_page = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;
$total_records = 0;
$total_pages = 1;

// Define filter and sort variables
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$service_filter = isset($_GET['service']) ? $_GET['service'] : 'all';
$date_order = isset($_GET['date_order']) ? $_GET['date_order'] : 'desc';

// Fetch all available services for the filter dropdown
$available_services = [];
try {
    $stmt_services = $link->query("SELECT DISTINCT name FROM services ORDER BY name");
    $available_services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database error fetching services: " . $e->getMessage());
}

try {
    // Build WHERE clause for status and service filters
    $where_conditions = [];
    $params = [];
    
    if ($status_filter !== 'all') {
        $where_conditions[] = 'status = :status';
        $params[':status'] = $status_filter;
    }
    
    if ($service_filter !== 'all') {
        $where_conditions[] = 'subject = :service';
        $params[':service'] = $service_filter;
    }
    
    $where = '';
    if (!empty($where_conditions)) {
        $where = 'WHERE ' . implode(' AND ', $where_conditions);
    }
    
    // Get total count with filter
    $stmt_count = $link->prepare("SELECT COUNT(*) FROM bookser $where");
    foreach ($params as $key => $value) {
        $stmt_count->bindValue($key, $value);
    }
    $stmt_count->execute();
    $total_records = $stmt_count->fetchColumn();
    $total_pages = max(1, ceil($total_records / $records_per_page));
    
    // Get paginated records with filter and sort
    $order = ($date_order === 'asc') ? 'ASC' : 'DESC';
    $sql = "SELECT * FROM bookser $where ORDER BY booking_time $order LIMIT :limit OFFSET :offset";
    $stmt = $link->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $service_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/RCInfotech/admin/navbar.php'; ?>

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
                <!-- Filter/Sort Form -->
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <form method="GET" class="d-flex align-items-center justify-content-between" style="gap: 10px;">
                            <div class="d-flex align-items-center" style="gap: 10px;">
                                <label for="status" class="me-2 mb-0">Status:</label>
                                <select name="status" id="status" class="form-control me-3" style="width: 140px;">
                                    <option value="all" <?php echo ($status_filter === 'all' ? 'selected' : ''); ?>>All
                                    </option>
                                    <option value="pending" <?php echo ($status_filter === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="approved" <?php echo ($status_filter === 'approved' ? 'selected' : ''); ?>>Approved</option>
                                    <option value="rejected" <?php echo ($status_filter === 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                </select>
                                <label for="service" class="me-2 mb-0">Service:</label>
                                <select name="service" id="service" class="form-control me-3" style="width: 140px;">
                                    <option value="all" <?php echo ($service_filter === 'all' ? 'selected' : ''); ?>>All
                                    </option>
                                    <?php foreach ($available_services as $service): ?>
                                        <option value="<?php echo htmlspecialchars($service['name']); ?>"
                                            <?php echo ($service_filter === htmlspecialchars($service['name']) ? 'selected' : ''); ?>>
                                            <?php echo htmlspecialchars($service['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="date_order" class="me-2 mb-0">Date:</label>
                                <select name="date_order" id="date_order" class="form-control me-3"
                                    style="width: 150px;">
                                    <option value="desc" <?php echo ($date_order === 'desc' ? 'selected' : ''); ?>>Newest
                                        First</option>
                                    <option value="asc" <?php echo ($date_order === 'asc' ? 'selected' : ''); ?>>Oldest
                                        First</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"
                                style="width:auto;">Filter</button>
                        </form>
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
                                    <th>Mobile</th>
                                    <th>Service</th>
                                    <th style="max-width: 120px; word-wrap: break-word;">Description</th>
                                    <th style="min-width: 101px; word-wrap: break-word;">Booking Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (
                                    $service_requests as $request): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($request['id']); ?></td>
                                        <td><?php echo htmlspecialchars($request['fname']); ?>
                                            <?php echo htmlspecialchars($request['lname']); ?>
                                        </td>
                                        <td style="max-width: 130px; word-wrap: break-word;">
                                            <?php echo htmlspecialchars($request['email']); ?>
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
                                            <?php if ($status === 'pending'): ?>
                                                <form action="update_status.php" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $request['id']; ?>">
                                                    <button type="submit" name="status" value="approved"
                                                        class="btn btn-success btn-sm"
                                                        style="background-color: green; padding: 2px 8px; margin: 2px;">Approve</button>
                                                    <button type="submit" name="status" value="rejected"
                                                        class="btn btn-danger btn-sm"
                                                        style="background-color: red; padding: 2px 8px; margin: 2px;">Reject</button>
                                                </form>
                                            <?php else: ?>
                                                <span style="color: #888; font-size: 18px; font-weight: bold;">Finalized</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination Bar -->
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php
                                // Build query string for pagination links, preserving filters
                                $query_params = $_GET;
                                if (isset($query_params['page']))
                                    unset($query_params['page']);
                                $base_query = http_build_query($query_params);
                                ?>
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="?<?php echo $base_query . ($base_query ? '&' : '') . 'page=' . ($page - 1); ?>"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php if ($i == $page)
                                        echo 'active'; ?>">
                                        <a class="page-link"
                                            href="?<?php echo $base_query . ($base_query ? '&' : '') . 'page=' . $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                            href="?<?php echo $base_query . ($base_query ? '&' : '') . 'page=' . ($page + 1); ?>"
                                            aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
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