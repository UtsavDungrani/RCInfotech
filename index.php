<?php
$route = isset($_GET['q']) ? trim($_GET['q'], '/') : 'home';

// Map routes to actual files
$routes = [
    '' => 'pages/index.php',
    'home' => 'pages/index.php',
    'about' => 'pages/about_us.php',
    'about_us' => 'pages/about_us.php',
    'services' => 'pages/service.php',
    'service' => 'pages/service.php',
    'service_display' => 'pages/service_display.php',
    'contact' => 'pages/contact.php',
    'product' => 'pages/product.php',
    'shop' => 'pages/shop.php',
    'cart' => 'pages/cart.php',
    'checkout' => 'pages/checkout.php',
    'login' => 'pages/login.php',
    'logout' => 'pages/logout.php',
    'register' => 'pages/register.php',
    'profile' => 'pages/profile.php',
    'make_appointment' => 'pages/make_appointment.php',
    'faq' => 'pages/faq.php',
    'feedback' => 'pages/feedback.php',
    'search_shop' => 'pages/search_shop.php',
    'order_success' => 'pages/order_success.php',
    'service_success' => 'pages/service_success.php',
    'user_orders' => 'pages/user_orders.php',
    'user_service_requests' => 'pages/user_service_requests.php',
];

// Check if route exists in our map
// Special handling: allow admin/* routes to map directly to files in the admin/ directory
if (strpos($route, 'admin/') === 0) {
    $file = $route . '.php';
    if (file_exists($file)) {
        include $file;
        return;
    } else {
        http_response_code(404);
        echo "404 - Page not found";
        return;
    }
}

if (array_key_exists($route, $routes)) {
    $file = $routes[$route];
    if (file_exists($file)) {
        include $file;
    } else {
        http_response_code(404);
        echo "404 - Page not found";
    }
} else {
    // Try to find the file directly in pages directory
    $file = 'pages/' . $route . '.php';
    if (file_exists($file)) {
        include $file;
    } else {
        http_response_code(404);
        echo "404 - Page not found";
    }
}
?>