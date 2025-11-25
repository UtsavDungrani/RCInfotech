<?php

// Initialize the session
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/vendor/autoload.php';

// Process status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];
    $old_status = '';

    // Get the old status and order details first
    $sql = "SELECT status, product_names, quantities FROM orders WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->execute([$order_id]);
    if ($row = $stmt->fetch()) {
        $old_status = $row['status'];
        $product_names = explode(',', $row['product_names']);
        $quantities = explode(',', $row['quantities']);
    }

    // Update order status
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $link->prepare($sql);
    $stmt->execute([$new_status, $order_id]);

    if ($stmt->rowCount() > 0) {
        // If status is being changed to 'processing' or 'shipped' or 'delivered', update product quantities
        if (
            ($new_status == 'processing' || $new_status == 'shipped' || $new_status == 'delivered') &&
            ($old_status == 'pending')
        ) {
            // Update product quantities for each product in the order
            for ($i = 0; $i < count($product_names); $i++) {
                $product_name = trim($product_names[$i]);
                $quantity = intval($quantities[$i]);

                // Update product stock
                $sql = "UPDATE product SET stock = stock - ? WHERE name = ?";
                $stmt = $link->prepare($sql);
                $stmt->execute([$quantity, $product_name]);
            }
        }
        // If status is being changed back to 'pending' from a confirmed status, restore quantities
        else if (
            $new_status == 'pending' &&
            ($old_status == 'processing' || $old_status == 'shipped' || $old_status == 'delivered')
        ) {
            // Restore product quantities for each product
            for ($i = 0; $i < count($product_names); $i++) {
                $product_name = trim($product_names[$i]);
                $quantity = intval($quantities[$i]);

                // Restore product stock
                $sql = "UPDATE product SET stock = stock + ? WHERE name = ?";
                $stmt = $link->prepare($sql);
                $stmt->execute([$quantity, $product_name]);
            }
        }

        // Get order details for email
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $link->prepare($sql);
        $stmt->execute([$order_id]);
        $order = $stmt->fetch();

        // Send status update email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rcinfotech11@gmail.com';
            $mail->Password = 'eolm wbba majw jlaa';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Additional settings to improve deliverability
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            // Recipients
            $mail->setFrom('rcinfotech11@gmail.com', 'IT Next Services');
            $mail->addReplyTo('support@rcinfotech.com', 'IT Next Services');

            $mail->addAddress($order['email'], $order['first_name'] . ' ' . $order['last_name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Order Status Update - IT Next Store';

            // Status message based on new status
            $status_message = '';
            switch ($new_status) {
                case 'Processing':
                    $status_message = "We are currently processing your order.";
                    break;
                case 'Shipped':
                    $status_message = "Your order has been shipped and is on its way to you.";
                    break;
                case 'Delivered':
                    $status_message = "Your order has been delivered. We hope you enjoy your purchase!";
                    break;
                case 'Cancelled':
                    $status_message = "Your order has been cancelled. If you did not request this cancellation, please contact our customer service.";
                    break;
                default:
                    $status_message = "Your order status has been updated to: " . $new_status;
            }

            // Prepare ordered items HTML
            $product_names = explode(',', $order['product_names']);
            $quantities = explode(',', $order['quantities']);
            $prices = explode(',', $order['prices']);


            $items_html = '<table>';
            $items_html .= '<tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>';

            for ($i = 0; $i < count($product_names); $i++) {
                $items_html .= '<tr>';
                $items_html .= '<td>' . htmlspecialchars($product_names[$i]) . '</td>';
                $items_html .= '<td>' . $quantities[$i] . '</td>';
                $items_html .= '<td>₹' . number_format($prices[$i], 2) . '</td>';
                $items_html .= '<td>₹' . number_format($prices[$i] * $quantities[$i], 2) . '</td>';
                $items_html .= '</tr>';
            }

            $items_html .= '<tr>';
            $items_html .= '<th colspan="3" class="total_box">Total</th>';
            $items_html .= '<td>₹' . number_format($order['total_amount'], 2) . '</td>';
            $items_html .= '</tr>';
            $items_html .= '</table>';

            $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                        border: 1px solid #ddd;
                    }
                    th {
                        border: 1px solid #ddd;
                        padding: 8px;
                        font-weight: bold;
                    }
                    td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    .total_box {
                        text-align: right;
                    }
                </style>
            </head>
            <body>
                <h2>Order Status Update</h2>
                <p>Dear {$order['first_name']} {$order['last_name']},</p>
                <p>{$status_message}</p>
                <h3>Order Details:</h3>
                <p><strong>Order Number:</strong> #{$order_id}</p>
                <p><strong>Order Date:</strong> " . date('F j, Y', strtotime($order['order_date'])) . "</p>
                <p><strong>New Status:</strong> {$new_status}</p>
                <h3>Ordered Items:</h3>
                {$items_html}
                <h3>Shipping Address:</h3>
                <p>{$order['shipping_address']}</p>
                <p>If you have any questions about your order, please don't hesitate to contact our customer service.</p>
                <p>Best regards,<br>IT Next Store Team</p>
            </body>
            </html>";

            $mail->AltBody = "Plain text version of your email";

            $mail->send();
        } catch (Exception $e) {
            error_log("Email sending failed: " . $mail->ErrorInfo);
        }

        $_SESSION['success'] = "Order status updated successfully";
    } else {
        $_SESSION['error'] = "Error updating order status";
    }

    header("Location: manage_orders");
    exit;
}

// Get all orders
// Pagination setup
$records_per_page = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;
$total_records = 0;
$total_pages = 1;

// Define filter and sort variables
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
$date_order = isset($_GET['date_order']) ? $_GET['date_order'] : 'desc';

try {
    // Build WHERE clause for status
    $where = '';
    $params = [];
    if ($status_filter !== 'all') {
        $where = 'WHERE status = :status';
        $params[':status'] = $status_filter;
    }
    // Get total count with filter
    $stmt_count = $link->prepare("SELECT COUNT(*) FROM orders $where");
    if ($where) {
        $stmt_count->bindParam(':status', $params[':status']);
    }
    $stmt_count->execute();
    $total_records = $stmt_count->fetchColumn();
    $total_pages = max(1, ceil($total_records / $records_per_page));
    // Get paginated records with filter and sort
    $order = ($date_order === 'asc') ? 'ASC' : 'DESC';
    $sql = "SELECT * FROM orders $where ORDER BY order_date $order LIMIT :limit OFFSET :offset";
    $stmt = $link->prepare($sql);
    if ($where) {
        $stmt->bindParam(':status', $params[':status']);
    }
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $orders = [];
}
?>
<?php include '../csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Orders - Admin Panel</title>
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
                            <div class="main_heading text_align_left mb_0">
                                <h2>Manage Orders</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter/Sort Form (NEW) -->
                <div class="row mb_20">
                    <div class="col-md-12">
                        <form method="GET" class="d-flex align-items-center justify-content-between gap_10">
                            <div class="d-flex align-items-center gap_10">
                                <label for="status" class="me-2 mb-0">Status:</label>
                                <select name="status" id="status" class="form-control me-3 width_140">
                                    <option value="all" <?php echo ($status_filter === 'all' ? 'selected' : ''); ?>>All
                                    </option>
                                    <option value="pending" <?php echo ($status_filter === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="processing" <?php echo ($status_filter === 'processing' ? 'selected' : ''); ?>>Processing</option>
                                    <option value="shipped" <?php echo ($status_filter === 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                                    <option value="delivered" <?php echo ($status_filter === 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                                </select>
                                <label for="date_order" class="me-2 mb-0">Date:</label>
                                <select name="date_order" id="date_order" class="form-control me-3 width_150">
                                    <option value="desc" <?php echo ($date_order === 'desc' ? 'selected' : ''); ?>>Newest
                                        First</option>
                                    <option value="asc" <?php echo ($date_order === 'asc' ? 'selected' : ''); ?>>Oldest
                                        First</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm width_auto">Filter</button>
                        </form>
                    </div>
                </div>
                <!-- End Filter/Sort Form -->

                <?php if (empty($orders)): ?>
                    <div class="alert alert-info">No orders found.</div>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <div class="order-card">
                            <div class="order-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>Order #<?= $order['id'] ?></h4>
                                    <p class="mb-0">
                                        Placed by: <?= htmlspecialchars($order['email']) ?><br>
                                        Date: <?= date('F j, Y', strtotime($order['order_date'])) ?>
                                    </p>
                                </div>
                                <div>
                                    <form method="post" class="status-form">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <select name="new_status"
                                            class="form-control form-control-sm d-inline-block status_select">
                                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending
                                            </option>
                                            <option value="processing" <?= $order['status'] == 'processing' ? 'selected' : '' ?>>
                                                Processing</option>
                                            <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Shipped
                                            </option>
                                            <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>
                                                Delivered</option>
                                        </select>
                                        <button type="submit" name="update_status"
                                            class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>

                            <div class="order-items">
                                <h5>Items:</h5>
                                <?php
                                $product_names = explode(',', $order['product_names']);
                                $quantities = explode(',', $order['quantities']);
                                $prices = explode(',', $order['prices']);
                                for ($i = 0; $i < count($product_names); $i++): ?>
                                    <div class="item">
                                        <?= htmlspecialchars($product_names[$i]) ?> × <?= $quantities[$i] ?>
                                        <span class="float-right">₹<?= number_format($prices[$i] * $quantities[$i], 2) ?></span>
                                    </div>
                                <?php endfor; ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Customer Details:</h5>
                                    <p>
                                        Name: <?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?><br>
                                        Email: <?= htmlspecialchars($order['email']) ?><br>
                                        Phone: <?= htmlspecialchars($order['phone']) ?><br>
                                        Shipping Address: <?= htmlspecialchars($order['shipping_address']) ?>
                                    </p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <h5>Total Amount:</h5>
                                    <h4>₹<?= number_format($order['total_amount'], 2) ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- Pagination Bar (UPDATED) -->
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
                <!-- End Pagination Bar -->
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/menumaker.js"></script>
    <script src="../js/wow.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/security.js"></script>
</body>

</html>