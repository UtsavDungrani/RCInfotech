<header id="default_header" class="header_style_1">
    <!-- header top -->
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="full">
                        <div class="topbar-left">
                            <ul class="list-inline">
                                <li> <span class="topbar-label"><i class="fa fa-home"></i></span> <span
                                        class="topbar-hightlight">Desai nagar, Bhavnagar</span> </li>
                                <li> <span class="topbar-label"><i class="fa-regular fa-envelope"></i></span> <span
                                        class="topbar-hightlight"><a href="mailto:info@yourdomain.com">Hello,
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
                                        target="_blank"></a></li>
                                <li><a class="fa-brands fa-x-twitter" href="https://twitter.com" title="Twitter"
                                        target="_blank"></a>
                                </li>
                                <li><a class="fa-brands fa-linkedin-in" href="https://www.linkedin.com" title="LinkedIn"
                                        target="_blank"></a></li>
                                <li><a class="fa-brands fa-instagram" href="https://www.instagram.com" title="Instagram"
                                        target="_blank"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="float-right2 d-flex flex-row mb-2 grp_btn">
                        <div class="make_appo">
                            <a class="btn white_btn" href="make_appointment.php">Make Appointment</a>
                        </div>
                        <div class="make_appo">
                            <a class="btn white_btn"
                                href="<?= htmlspecialchars($_SESSION["username"] === "user" ? "./login.php" : "./logout.php"); ?>">
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
                    <div class="logo"> <a href="index.php"><img src="images/logos/logo.png" alt="logo" /></a> </div>
                    <!-- logo end -->
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <!-- menu start -->
                    <div class="menu_side">
                        <div id="navbar_menu">
                            <ul class="first-ul">
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>"
                                        href="index.php">Home</a></li>
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'about_us.php' ? 'active' : '' ?>"
                                        href="about_us.php">About Us</a></li>
                                <li class="shop-dropdown">
                                    <a class="<?= (basename($_SERVER['PHP_SELF']) == 'service.php' || basename($_SERVER['PHP_SELF']) == 'user_service_requests.php' || basename($_SERVER['PHP_SELF']) == 'service_display.php' || basename($_SERVER['PHP_SELF']) == 'service_success.php') ? 'active' : '' ?>"
                                        href="service.php">Service</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="service.php">Services</a></li>
                                        <li><a href="user_service_requests.php">Booked Services</a></li>
                                    </ul>
                                </li>
                                <li class="shop-dropdown">
                                    <a class="<?= (basename($_SERVER['PHP_SELF']) == 'shop.php' || basename($_SERVER['PHP_SELF']) == 'cart.php' || basename($_SERVER['PHP_SELF']) == 'user_orders.php' || basename($_SERVER['PHP_SELF']) == 'product.php' || basename($_SERVER['PHP_SELF']) == 'checkout.php' || basename($_SERVER['PHP_SELF']) == 'order_success.php') ? 'active' : '' ?>"
                                        href="shop.php">Shop</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="shop.php">All Products</a></li>
                                        <li><a href="cart.php">Shopping Cart</a></li>
                                        <li><a href="user_orders.php">My Orders</a></li>
                                    </ul>
                                </li>
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>"
                                        href="contact.php">Contact</a></li>
                                <li><a class="<?= basename($_SERVER['PHP_SELF']) == 'search_shop.php' ? 'active' : '' ?>"
                                        href="search_shop.php">Near by shops</a></li>
                                <li><a class="<?= (basename($_SERVER['PHP_SELF']) == 'faq.php' || basename($_SERVER['PHP_SELF']) == 'feedback.php') ? 'active' : '' ?>"
                                        href="faq.php">FAQ</a></li>
                            </ul>
                        </div>
                        <!-- <div class="search_icon">
                <ul>
                  <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search"
                        aria-hidden="true"></i></a></li>
                </ul>
              </div> -->
                    </div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
    <!-- header bottom end -->
</header>