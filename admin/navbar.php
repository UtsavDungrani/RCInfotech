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
// current request path (path only — excludes query string like ?id=1)
$current = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
<div class="sidebar">
    <a href="/admin/admin_home" class="<?= $current == 'admin_home' ? 'active' : '' ?>">Dashboard</a>
    <a href="/admin/service_requests" class="<?= $current == 'service_requests' ? 'active' : '' ?>">
        Service Requests
        <?php if ($pending_service_count > 0): ?>
            <span class="pending_req_counter">
                <?= $pending_service_count ?>
            </span>
        <?php endif; ?>
    </a>
    <a href="/admin/insert_product/add_product" class="<?= $current == 'add_product' ? 'active' : '' ?>">Add Product</a>
    <a href="/admin/insert_services/add_service" class="<?= $current == 'add_service' ? 'active' : '' ?>">Add
        Service</a>
    <a href="/admin/insert_shop/add_shop" class="<?= $current == 'add_shop' ? 'active' : '' ?>">Add Shops</a>
    <a href="/admin/insert_product/update_product"
        class="<?= ($current == 'update_product' || $current == 'edit_product') ? 'active' : '' ?>">Manage
        Products</a>
    <a href="/admin/insert_services/update_service"
        class="<?= ($current == 'update_service' || $current == 'edit_service') ? 'active' : '' ?>">Manage
        Services</a>
    <a href="/admin/insert_shop/update_shop"
        class="<?= ($current == 'update_shop' || $current == 'edit_shop') ? 'active' : '' ?>">Manage
        Shop</a>
    <a href="/admin/manage_orders" class="<?= $current == 'manage_orders' ? 'active' : '' ?>">Orders
        <?php if ($pending_order_count > 0): ?>
            <span class="pending_req_counter">
                <?= $pending_order_count ?>
            </span>
        <?php endif; ?>
    </a>
    <a href="/admin/users" class="<?= $current == 'users' ? 'active' : '' ?>">Users</a>
    <a href="#">Settings</a>
    <a href="/index">Back to Site</a>
</div>
<script>
    // Fallback navigation: try primary URL, then try variants with/without /RCInfotech and with/without .php
    (function () {
        var projectPrefix = '/RCInfotech';

        function hasExtension(path) { return /\.[^\/]+$/.test(path); }

        function buildVariants(href) {
            var v = href.replace(/\s+$/, '');
            // ensure leading slash for consistency
            if (v.charAt(0) !== '/') v = '/' + v;
            var variants = [];
            variants.push(v);
            if (v.indexOf(projectPrefix) === 0) {
                var without = v.substring(projectPrefix.length) || '/';
                if (without.charAt(0) !== '/') without = '/' + without;
                variants.push(without);
            } else {
                variants.push(projectPrefix + v);
            }

            var final = [];
            variants.forEach(function (x) {
                if (final.indexOf(x) === -1) final.push(x);
                if (hasExtension(x)) {
                    var noext = x.replace(/\.[^/.]+$/, '');
                    if (final.indexOf(noext) === -1) final.push(noext);
                } else {
                    var withPhp = x + '.php';
                    if (final.indexOf(withPhp) === -1) final.push(withPhp);
                }
            });
            return final;
        }

        async function tryNavigateSequential(list) {
            for (var i = 0; i < list.length; i++) {
                var url = list[i];
                try {
                    var res = await fetch(url, { method: 'HEAD', cache: 'no-store' });
                    if (res && res.ok) { window.location.href = url; return; }
                } catch (e) { /* ignore and try next */ }
            }
            if (list.length) window.location.href = list[list.length - 1];
        }

        document.addEventListener('click', function (e) {
            var a = e.target.closest && e.target.closest('.sidebar a');
            if (!a) return;
            var href = a.getAttribute('href');
            if (!href || href.startsWith('#') || href.indexOf('javascript:') === 0) return;

            var explicit = a.getAttribute('data-fallback');
            if (explicit) {
                e.preventDefault();
                tryNavigateSequential([href, explicit]);
                return;
            }

            e.preventDefault();
            var list = buildVariants(href);
            tryNavigateSequential(list);
        }, false);
    })();
</script>