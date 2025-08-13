<?php
require_once __DIR__ . '/../config/config.php';
// Fetch pending service requests count
$pending_service_count = 0;
try {
    $stmt = $link->query("SELECT COUNT(*) FROM bookser WHERE status = 'pending'");
    $pending_service_count = (int) $stmt->fetchColumn();
} catch (Exception $e) {
    $pending_service_count = 0;
}
$pending_order_count = 0;
try {
    $stmt = $link->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'");
    $pending_order_count = (int) $stmt->fetchColumn();
} catch (Exception $e) {
    $pending_order_count = 0;
}
?>
<div class="sidebar">
    <a href="/RCInfotech/admin/admin_home.php"
        class="<?= basename($_SERVER['PHP_SELF']) == 'admin_home.php' ? 'active' : '' ?>">Dashboard</a>
    <a href="/RCInfotech/admin/service_requests.php"
        class="<?= basename($_SERVER['PHP_SELF']) == 'service_requests.php' ? 'active' : '' ?>">
        Service Requests
        <?php if ($pending_service_count > 0): ?>
            <span class="pending_req_counter">
                <?= $pending_service_count ?>
            </span>
        <?php endif; ?>
    </a>
    <a href="/RCInfotech/admin/insert_product/add_product.php"
        class="<?= basename($_SERVER['PHP_SELF']) == 'add_product.php' ? 'active' : '' ?>">Add Product</a>
    <a href="/RCInfotech/admin/insert_services/add_service.php"
        class="<?= basename($_SERVER['PHP_SELF']) == 'add_service.php' ? 'active' : '' ?>">Add Service</a>
    <a href="/RCInfotech/admin/insert_shop/add_shop.php"
        class="<?= basename($_SERVER['PHP_SELF']) == 'add_shop.php' ? 'active' : '' ?>">Add Shops</a>
    <a href="/RCInfotech/admin/insert_product/update_product.php"
        class="<?= (basename($_SERVER['PHP_SELF']) == 'update_product.php' || basename($_SERVER['PHP_SELF']) == 'edit_product.php') ? 'active' : '' ?>">Manage
        Products</a>
    <a href="/RCInfotech/admin/insert_services/update_service.php"
        class="<?= (basename($_SERVER['PHP_SELF']) == 'update_service.php' || basename($_SERVER['PHP_SELF']) == 'edit_service.php') ? 'active' : '' ?>">Manage
        Services</a>
    <a href="/RCInfotech/admin/insert_shop/update_shop.php"
        class="<?= (basename($_SERVER['PHP_SELF']) == 'update_shop.php' || basename($_SERVER['PHP_SELF']) == 'edit_shop.php') ? 'active' : '' ?>">Manage
        Shop</a>
    <a href="/RCInfotech/admin/manage_orders.php"
        class="<?= basename($_SERVER['PHP_SELF']) == 'manage_orders.php' ? 'active' : '' ?>">Orders
        <?php if ($pending_order_count > 0): ?>
            <span class="pending_req_counter">
                <?= $pending_order_count ?>
            </span>
        <?php endif; ?>
    </a>
    <a href="/RCInfotech/admin/users.php"
        class="<?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>">Users</a>
    <a href="#">Settings</a>
    <a href="/RCInfotech/index.php">Back to Site</a>
</div>