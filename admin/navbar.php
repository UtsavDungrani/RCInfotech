<?php
// Load global config from project root
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
    <a href="/RCInfotech/admin/admin_home"
        class="<?= basename($_SERVER['PHP_SELF']) == 'admin_home' ? 'active' : '' ?>">Dashboard</a>
    <a href="/RCInfotech/admin/service_requests"
        class="<?= basename($_SERVER['PHP_SELF']) == 'service_requests' ? 'active' : '' ?>">
        Service Requests
        <?php if ($pending_service_count > 0): ?>
            <span class="pending_req_counter">
                <?= $pending_service_count ?>
            </span>
        <?php endif; ?>
    </a>
    <a href="/RCInfotech/admin/insert_product/add_product"
        class="<?= basename($_SERVER['PHP_SELF']) == 'add_product' ? 'active' : '' ?>">Add Product</a>
    <a href="/RCInfotech/admin/insert_services/add_service"
        class="<?= basename($_SERVER['PHP_SELF']) == 'add_service' ? 'active' : '' ?>">Add Service</a>
    <a href="/RCInfotech/admin/insert_shop/add_shop"
        class="<?= basename($_SERVER['PHP_SELF']) == 'add_shop' ? 'active' : '' ?>">Add Shops</a>
    <a href="/RCInfotech/admin/insert_product/update_product"
        class="<?= (basename($_SERVER['PHP_SELF']) == 'update_product' || basename($_SERVER['PHP_SELF']) == 'edit_product') ? 'active' : '' ?>">Manage
        Products</a>
    <a href="/RCInfotech/admin/insert_services/update_service"
        class="<?= (basename($_SERVER['PHP_SELF']) == 'update_service' || basename($_SERVER['PHP_SELF']) == 'edit_service') ? 'active' : '' ?>">Manage
        Services</a>
    <a href="/RCInfotech/admin/insert_shop/update_shop"
        class="<?= (basename($_SERVER['PHP_SELF']) == 'update_shop' || basename($_SERVER['PHP_SELF']) == 'edit_shop') ? 'active' : '' ?>">Manage
        Shop</a>
    <a href="/RCInfotech/admin/manage_orders"
        class="<?= basename($_SERVER['PHP_SELF']) == 'manage_orders' ? 'active' : '' ?>">Orders
        <?php if ($pending_order_count > 0): ?>
            <span class="pending_req_counter">
                <?= $pending_order_count ?>
            </span>
        <?php endif; ?>
    </a>
    <a href="/RCInfotech/admin/users" class="<?= basename($_SERVER['PHP_SELF']) == 'users' ? 'active' : '' ?>">Users</a>
    <a href="#">Settings</a>
    <a href="/RCInfotech/index">Back to Site</a>
</div>