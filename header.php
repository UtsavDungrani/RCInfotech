<?php
// Add preload directives for critical resources
$preload_css = [
    'css/bootstrap.min.css',
    'css/style.css',
    'css/responsive.css',
    'css/colors1.css'
];

$preload_js = [
    'js/jquery.min.js',
    'js/bootstrap.min.js'
];

foreach ($preload_css as $css) {
    echo "<link rel='preload' href='$css' as='style'>\n";
}
foreach ($preload_js as $js) {
    echo "<link rel='preload' href='$js' as='script'>\n";
}
?>
<header id="default_header" class="header_style_1">
    <!-- header top -->
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="full">
                        <div class="topbar-left">
                            <ul class="list-inline">
                                <li> <span class="topbar-label"><i class="fa fa-home" aria-hidden="true"></i></span>
                                    <span class="topbar-hightlight">Desai nagar, Bhavnagar</span>
                                </li>
                                <li> <span class="topbar-label"><i class="fa-regular fa-envelope"
                                            aria-hidden="true"></i></span> <span class="topbar-hightlight"><a
                                            href="mailto:info@yourdomain.com">Hello,
                                            <?= htmlspecialchars($_SESSION["username"]); ?> </a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 right_section_header_top">
                    <div class="float-left my-3">
                        <div class="social_icon">
                            <ul class="list-inline">
                                <li><a class="fa-brands fa-facebook-f" href="https://www.facebook.com/" title="Facebook"
                                        target="_blank" rel="noopener"></a></li>
                                <li><a class="fa-brands fa-x-twitter" href="https://twitter.com" title="Twitter"
                                        target="_blank" rel="noopener"></a>
                                </li>
                                <li><a class="fa-brands fa-linkedin-in" href="https://www.linkedin.com" title="LinkedIn"
                                        target="_blank" rel="noopener"></a></li>
                                <li><a class="fa-brands fa-instagram" href="https://www.instagram.com" title="Instagram"
                                        target="_blank" rel="noopener"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="float-right2 d-flex flex-row mb-2 grp_btn">
                        <div class="make_appo">
                            <a class="btn white_btn" href="make_appointment">Make Appointment</a>
                        </div>
                        <div class="make_appo">
                            <a class="btn white_btn"
                                href="<?= htmlspecialchars($_SESSION["username"] === "user" ? "./login" : "./logout"); ?>">
                                <?= htmlspecialchars($_SESSION["username"] === "user" ? "Login" : "Logout"); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header top -->
    <!-- header bottom -->
    <div class="header_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <!-- logo start -->
                    <div class="logo"> <a href="index"><img src="images/logos/logo.png" alt="logo" /></a> </div>
                    <!-- logo end -->
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <!-- menu start -->
                    <div class="menu_side">
                        <div id="navbar_menu">
                            <ul class="first-ul">
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'index' ? 'active' : '' ?>"
                                        href="index">Home</a></li>
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'about_us' ? 'active' : '' ?>"
                                        href="about_us">About Us</a></li>
                                <li class="shop-dropdown">
                                    <a class="<?= (basename($_SERVER['PHP_SELF']) == 'service' || basename($_SERVER['PHP_SELF']) == 'user_service_requests' || basename($_SERVER['PHP_SELF']) == 'service_display' || basename($_SERVER['PHP_SELF']) == 'service_success') ? 'active' : '' ?>"
                                        href="service">Service</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="service">Services</a></li>
                                        <li><a href="user_service_requests">Booked Services</a></li>
                                    </ul>
                                </li>
                                <li class="shop-dropdown">
                                    <a class="<?= (basename($_SERVER['PHP_SELF']) == 'shop' || basename($_SERVER['PHP_SELF']) == 'cart' || basename($_SERVER['PHP_SELF']) == 'user_orders' || basename($_SERVER['PHP_SELF']) == 'product' || basename($_SERVER['PHP_SELF']) == 'checkout' || basename($_SERVER['PHP_SELF']) == 'order_success') ? 'active' : '' ?>"
                                        href="shop">Shop</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="shop">All Products</a></li>
                                        <li><a href="cart">Shopping Cart</a></li>
                                        <li><a href="user_orders">My Orders</a></li>
                                    </ul>
                                </li>
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'contact' ? 'active' : '' ?>"
                                        href="contact">Contact</a></li>
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'search_shop' ? 'active' : '' ?>"
                                        href="search_shop">Near by shops</a></li>
                                <li><a class="<?= (basename($_SERVER['PHP_SELF']) == 'faq' || basename($_SERVER['PHP_SELF']) == 'feedback') ? 'active' : '' ?>"
                                        href="faq">FAQ</a></li>
                                <li><a class="<?= (basename($_SERVER['PHP_SELF']) == 'profile') ? 'active' : '' ?>"
                                        href="profile">Profile</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
    <!-- header bottom end -->
</header>