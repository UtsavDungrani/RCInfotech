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


            $items_html = '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">';
            $items_html .= '<tr>
                                <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Quantity</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Total</th>
                            </tr>';

            for ($i = 0; $i < count($product_names); $i++) {
                $items_html .= '<tr>';
                $items_html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($product_names[$i]) . '</td>';
                $items_html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $quantities[$i] . '</td>';
                $items_html .= '<td style="border: 1px solid #ddd; padding: 8px;">₹' . number_format($prices[$i], 2) . '</td>';
                $items_html .= '<td style="border: 1px solid #ddd; padding: 8px;">₹' . number_format($prices[$i] * $quantities[$i], 2) . '</td>';
                $items_html .= '</tr>';
            }

            $items_html .= '<tr>';
            $items_html .= '<th style="border: 1px solid #ddd; padding: 8px; text-align: right;" colspan="3">Total</th>';
            $items_html .= '<td style="border: 1px solid #ddd; padding: 8px;">₹' . number_format($order['total_amount'], 2) . '</td>';
            $items_html .= '</tr>';
            $items_html .= '</table>';

            $mail->Body = "
            <html>
            <body style='font-family: Arial, sans-serif;'>
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

    header("Location: manage_orders.php");
    exit;
}

// Get all orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$stmt = $link->query($sql);
$orders = $stmt->fetchAll();
?>

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
    <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="../css/animate.css" />
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        .loader_animation {
            animation: none;
        }

        .wrapper {
            width: 100%;
            padding: 20px;
        }

        .order-card {
            background: #fff;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .order-status {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 14px;
            font-weight: bold;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background: #d1e7dd;
            color: #0f5132;
        }

        .order-items {
            margin: 15px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 3px;
        }

        .status-form {
            display: inline-block;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
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
        <a href="manage_orders.php" class="active">Orders</a>
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
                            <div class="main_heading text_align_left">
                                <h2>Manage Orders</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (empty($orders)): ?>
                        <div class="alert alert-info">No orders found.</div>
                <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                                <div class="order-card">
                                    <div class="order-header d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4>Order #<?= $order['id'] ?></h4>
                                            <p class="mb-0">
                                                Placed by: <?= htmlspecialchars($order['user_email']) ?><br>
                                                Date: <?= date('F j, Y', strtotime($order['order_date'])) ?>
                                            </p>
                                        </div>
                                        <div>
                                            <form method="post" class="status-form">
                                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                                <select name="new_status" class="form-control form-control-sm d-inline-block"
                                                    style="width: auto; height: 40px;">
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
                                                Email: <?= htmlspecialchars($order['user_email']) ?><br>
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