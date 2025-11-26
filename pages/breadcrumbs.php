<?php
require_once __DIR__ . '/../config/config.php';

// Fetch products from database
$stmt = $link->query("SELECT * FROM product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $link->query("SELECT * FROM services");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="title-holder">
                        <div class="title-holder-cell text-left">
                            <h1 class="page-title">
                                <?php
                                $current_page = isset($_GET['q']) ? trim($_GET['q'], '/') : 'home';
                                if (!$current_page || $current_page === 'home') {
                                    $page_display = 'home';
                                } else {
                                    $page_display = explode('/', $current_page)[0];
                                }
                                echo ucwords(str_replace(['-', '_'], ' ', $page_display));
                                ?>
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="index">Home</a></li>
                                <?php
                                $current_page = isset($_GET['q']) ? trim($_GET['q'], '/') : 'home';
                                if (!$current_page || $current_page === 'home') {
                                    $current_page = 'home';
                                } else {
                                    $current_page = explode('/', $current_page)[0];
                                }
                                if ($current_page == 'feedback') {
                                    echo '<li><a href="faq">FAQ</a></li>';
                                    echo '<li class="active">' . ucwords(str_replace('-', ' ', $current_page)) . '</li>';
                                } elseif ($current_page == 'checkout') {
                                    echo '<li><a href="cart">Cart</a></li>';
                                    echo '<li class="active">' . ucwords(str_replace('-', ' ', $current_page)) . '</li>';
                                } elseif ($current_page == 'product') {
                                    // Fetch the product name if the ID is provided in the URL
                                    $product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
                                    $product_name = '';
                                    if ($product_id > 0) {
                                        if ($product) {
                                            $product_name = $product['name'];
                                        }
                                    }
                                    echo '<li><a href="shop">Shop</a></li>';
                                    if ($product_name) {
                                        echo '<li class="active">' . htmlspecialchars($product_name) . '</li>';
                                    } else {
                                        echo '<li class="active">Product</li>';
                                    }
                                } elseif ($current_page == 'service_display') {
                                    $service_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
                                    $service_name = '';
                                    if ($service_id > 0) {
                                        foreach ($services as $service) {
                                            if ($service['id'] == $service_id) {
                                                $service_name = $service['name'];
                                                break;
                                            }
                                        }
                                    }
                                    echo '<li><a href="">Services</a></li>';
                                    if ($service_name) {
                                        echo '<li class="active">' . htmlspecialchars($service_name) . '</li>';
                                    } else {
                                        echo '<li class="active">Service</li>';
                                    }
                                } elseif ($current_page == 'service_success') {
                                    echo '<li><a href="make_appointment">Make Appointment</a></li>';
                                    echo '<li class="active">Service Booking Success</li>';
                                } elseif ($current_page == 'service') {
                                    echo '<li class="active">Services</li>';
                                } elseif ($current_page == 'user_orders') {
                                    echo '<li><a href="shop">Shop</a></li>';
                                    echo '<li class="active">My Orders</li>';
                                } elseif ($current_page == 'user_service_requests') {
                                    echo '<li><a href="service">Services</a></li>';
                                    echo '<li class="active">My Services</li>';
                                } elseif ($current_page != 'index') {
                                    echo '<li class="active">' . ucwords(str_replace(['-', '_'], ' ', $current_page)) . '</li>';
                                }

                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>