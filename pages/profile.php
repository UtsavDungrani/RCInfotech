<?php
# Initialize session
session_start();

# Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE || $_SESSION["username"] === "user") {
    echo "<script>alert('Please login to access your profile.');</script>";
    echo "<script>window.location.href='./login';</script>";
    exit;
}

# Include connection
require_once __DIR__ . '/../config/config.php';

$user_id = $_SESSION["id"];
$username = $_SESSION["username"];
$email = $_SESSION["email"];

# Initialize variables
$success_message = $error_message = "";
$current_password_err = $new_password_err = $confirm_password_err = "";
$name_err = $phone_err = $address_err = $photo_err = "";

# Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_profile'])) {
        // Update basic profile information
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);

        if (empty($name)) {
            $name_err = "Please enter your name.";
        }

        if (empty($phone)) {
            $phone_err = "Please enter your phone number.";
        }

        if (empty($address)) {
            $address_err = "Please enter your address.";
        }

        // Handle photo upload
        $photo_path = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $max_size = 5 * 1024 * 1024; // 5MB

            if (!in_array($_FILES['photo']['type'], $allowed_types)) {
                $photo_err = "Please upload a valid image file (JPEG, PNG, GIF).";
            } elseif ($_FILES['photo']['size'] > $max_size) {
                $photo_err = "Image size should be less than 5MB.";
            } else {
                // Create uploads directory if it doesn't exist
                $upload_dir = __DIR__ . '/uploads/profiles/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                // Generate unique filename
                $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $filename = 'profile_' . $user_id . '_' . time() . '.' . $file_extension;
                $filepath = $upload_dir . $filename;
                $photo_path = 'uploads/profiles/' . $filename;

                // Move uploaded file
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
                    $photo_err = "Failed to upload image file.";
                }
            }
        }

        if (empty($name_err) && empty($phone_err) && empty($address_err) && empty($photo_err)) {
            if ($photo_path) {
                // Update with photo path
                $sql = "UPDATE users SET name = :name, phone = :phone, address = :address, username = :username, email = :email, photo_path = :photo_path WHERE id = :id";
                try {
                    $stmt = $link->prepare($sql);
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                    $stmt->bindParam(':photo_path', $photo_path, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        $success_message = "Profile updated successfully!";
                    } else {
                        $error_message = "Something went wrong. Please try again.";
                    }
                } catch (PDOException $e) {
                    $error_message = "Database error: " . $e->getMessage();
                }
            } else {
                // Update without photo
                $sql = "UPDATE users SET name = :name, phone = :phone, address = :address, username = :username, email = :email WHERE id = :id";
                try {
                    $stmt = $link->prepare($sql);
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
                    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

                    if ($stmt->execute()) {
                        $success_message = "Profile updated successfully!";
                    } else {
                        $error_message = "Something went wrong. Please try again.";
                    }
                } catch (PDOException $e) {
                    $error_message = "Database error: " . $e->getMessage();
                }
            }
        }
    }

    if (isset($_POST['change_password'])) {
        // Change password
        $current_password = trim($_POST['current_password']);
        $new_password = trim($_POST['new_password']);
        $confirm_password = trim($_POST['confirm_password']);

        if (empty($current_password)) {
            $current_password_err = "Please enter your current password.";
        }

        if (empty($new_password)) {
            $new_password_err = "Please enter a new password.";
        } elseif (strlen($new_password) < 6) {
            $new_password_err = "Password must have at least 6 characters.";
        }

        if (empty($confirm_password)) {
            $confirm_password_err = "Please confirm your password.";
        } elseif ($new_password !== $confirm_password) {
            $confirm_password_err = "Passwords do not match.";
        }

        if (empty($current_password_err) && empty($new_password_err) && empty($confirm_password_err)) {
            // Verify current password
            $sql = "SELECT password FROM users WHERE id = :id";

            try {
                $stmt = $link->prepare($sql);
                $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() === 1) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($current_password, $user['password'])) {
                        // Update password
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                        $sql = "UPDATE users SET password = :password WHERE id = :id";
                        $stmt = $link->prepare($sql);
                        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

                        if ($stmt->execute()) {
                            $success_message = "Password changed successfully!";
                        } else {
                            $error_message = "Something went wrong. Please try again.";
                        }
                    } else {
                        $current_password_err = "Current password is incorrect.";
                    }
                }
            } catch (PDOException $e) {
                $error_message = "Database error: " . $e->getMessage();
            }
        }
    }
}

# Get current user data
$sql = "SELECT * FROM users WHERE id = :id";
try {
    $stmt = $link->prepare($sql);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Database error: " . $e->getMessage();
}

// Get user order count
$sql = "SELECT COUNT(*) as order_count FROM orders WHERE email = :email";
try {
    $stmt = $link->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $orders_count = $stmt->fetch(PDO::FETCH_ASSOC)['order_count'];
} catch (PDOException $e) {
    $orders_count = 0;
}

$sql = "SELECT COUNT(*) as services_count FROM bookser WHERE email = :email";
try {
    $stmt = $link->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $services_count = $stmt->fetch(PDO::FETCH_ASSOC)['services_count'];
} catch (PDOException $e) {
    $services_count = 0;
}
?>

<?php include 'csp.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Profile</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icons -->
    <link rel="icon" href="images/logos/logo-1.png" type="image/gif" />

    <!-- Preload critical resources -->
    <link rel="preload" href="css/bootstrap.min.css" as="style">
    <link rel="preload" href="css/style.css" as="style">
    <link rel="preload" href="js/jquery.min.js" as="script">
    <link rel="preload" href="js/bootstrap.min.js" as="script">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Site css -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- colors css -->
    <link rel="stylesheet" href="css/colors1.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />
    <!-- wow Animation css -->
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/all.min.css" />
</head>

<body id="default_theme" class="it_service">
    <!-- loader -->
    <div class="bg_load"> <img class="loader_animation" src="images/loaders/loader.gif" alt="#" /> </div>
    <!-- end loader -->
    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->

    <!-- inner page banner -->
    <?php include 'breadcrumbs.php'; ?>
    <!-- end inner page banner -->

    <!-- section -->
    <div class="section padding_layout_1 profile-section">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile-section">
                            <div class="profile-header">
                                <div class="profile-avatar">
                                    <?php if (!empty($user_data['photo_path'])): ?>
                                        <img src="<?= $user_data['photo_path'] ?>" alt="Profile Photo" class="profile-photo"
                                            onclick="openModal(this.src)">
                                    <?php elseif (!empty($user_data['photo'])): ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($user_data['photo']) ?>"
                                            alt="Profile Photo" class="profile-photo" onclick="openModal(this.src)">
                                    <?php else: ?>
                                        <div class="profile-initial">
                                            <?= strtoupper(substr($username, 0, 1)) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
                                <p class="text-muted">Manage your profile and view your activity</p>
                            </div>

                            <?php if (!empty($success_message)): ?>
                                <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
                            <?php endif; ?>

                            <?php if (!empty($error_message)): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                            <?php endif; ?>

                            <!-- Navigation Tabs -->
                            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                        role="tab">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password"
                                        role="tab">Change Password</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="orders-tab" href="user_orders" role="tab">My Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="services-tab" href="user_service_requests"
                                        role="tab">Service Requests</a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="profileTabsContent">
                                <!-- Profile Tab -->
                                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="username">Username</label>
                                                            <input type="text" class="form-control" id="username"
                                                                name="username"
                                                                value="<?= htmlspecialchars($username) ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="<?= htmlspecialchars($email) ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Full Name *</label>
                                                            <input type="text"
                                                                class="form-control <?= !empty($name_err) ? 'is-invalid' : '' ?>"
                                                                id="name" name="name"
                                                                value="<?= htmlspecialchars($user_data['name'] ?? '') ?>">
                                                            <?php if (!empty($name_err)): ?>
                                                                <div class="invalid-feedback">
                                                                    <?= htmlspecialchars($name_err) ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Phone Number *</label>
                                                            <input type="text"
                                                                class="form-control <?= !empty($phone_err) ? 'is-invalid' : '' ?>"
                                                                id="phone" name="phone"
                                                                value="<?= htmlspecialchars($user_data['phone'] ?? '') ?>">
                                                            <?php if (!empty($phone_err)): ?>
                                                                <div class="invalid-feedback">
                                                                    <?= htmlspecialchars($phone_err) ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address *</label>
                                                    <textarea
                                                        class="form-control <?= !empty($address_err) ? 'is-invalid' : '' ?>"
                                                        id="address" name="address"
                                                        rows="3"><?= htmlspecialchars($user_data['address'] ?? '') ?></textarea>
                                                    <?php if (!empty($address_err)): ?>
                                                        <div class="invalid-feedback"><?= htmlspecialchars($address_err) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="photo">Profile Photo</label>
                                                    <input type="file"
                                                        class="form-control <?= !empty($photo_err) ? 'is-invalid' : '' ?>"
                                                        id="photo" name="photo" accept="image/jpeg,image/png,image/gif">
                                                    <small class="form-text text-muted">
                                                        Upload JPEG, PNG, or GIF image (max 5MB)
                                                    </small>
                                                    <?php if (!empty($photo_err)): ?>
                                                        <div class="invalid-feedback">
                                                            <?= htmlspecialchars($photo_err) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <img id="imagePreview" alt="Image Preview">
                                                </div>
                                                <button type="submit" name="update_profile"
                                                    class="btn btn-profile btn-primary">Update
                                                    Profile</button>
                                            </form>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Account Information</h5>
                                                    <p><strong>Member since:</strong>
                                                        <?= date('F Y', strtotime($user_data['created_at'] ?? 'now')) ?>
                                                    </p>
                                                    <p><strong>Total Orders:</strong> <?= $orders_count ?></p>
                                                    <p><strong>Service Requests:</strong> <?= $services_count ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Tab -->
                                <div class="tab-pane fade" id="password" role="tabpanel">
                                    <form method="POST" action="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="current_password">Current Password *</label>
                                                    <input type="password"
                                                        class="form-control <?= !empty($current_password_err) ? 'is-invalid' : '' ?>"
                                                        id="current_password" name="current_password">
                                                    <?php if (!empty($current_password_err)): ?>
                                                        <div class="invalid-feedback">
                                                            <?= htmlspecialchars($current_password_err) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="new_password">New Password *</label>
                                                    <input type="password"
                                                        class="form-control <?= !empty($new_password_err) ? 'is-invalid' : '' ?>"
                                                        id="new_password" name="new_password">
                                                    <?php if (!empty($new_password_err)): ?>
                                                        <div class="invalid-feedback">
                                                            <?= htmlspecialchars($new_password_err) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="confirm_password">Confirm New Password *</label>
                                                    <input type="password"
                                                        class="form-control <?= !empty($confirm_password_err) ? 'is-invalid' : '' ?>"
                                                        id="confirm_password" name="confirm_password">
                                                    <?php if (!empty($confirm_password_err)): ?>
                                                        <div class="invalid-feedback">
                                                            <?= htmlspecialchars($confirm_password_err) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="change_password"
                                            class="btn btn-profile btn-primary">Change
                                            Password</button>
                                    </form>
                                </div>

                                <!-- Orders Tab -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <?php if (empty($orders)): ?>
                                        <div class="text-center py-5">
                                            <h4>No orders found</h4>
                                            <p class="text-muted">You haven't placed any orders yet.</p>
                                            <a href="shop" class="btn btn-profile">Start Shopping</a>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($orders as $order): ?>
                                            <div class="order-item">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <strong>Order #<?= htmlspecialchars($order['id']) ?></strong>
                                                        <br>
                                                        <small
                                                            class="text-muted"><?= date('M d, Y', strtotime($order['order_date'])) ?></small>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Total:</strong> ₹<?= number_format($order['total_amount'], 2) ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="status-badge status-<?= strtolower($order['status']) ?>">
                                                            <?= ucfirst(htmlspecialchars($order['status'])) ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="user_orders" class="btn btn-sm btn-outline-primary">View
                                                            Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <!-- Services Tab -->
                                <div class="tab-pane fade" id="services" role="tabpanel">
                                    <?php if (empty($service_requests)): ?>
                                        <div class="text-center py-5">
                                            <h4>No service requests found</h4>
                                            <p class="text-muted">You haven't booked any services yet.</p>
                                            <a href="service.php" class="btn btn-profile">Book a Service</a>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($service_requests as $request): ?>
                                            <div class="service-item">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <strong>Request #<?= htmlspecialchars($request['id']) ?></strong>
                                                        <br>
                                                        <small
                                                            class="text-muted"><?= date('M d, Y', strtotime($request['request_date'])) ?></small>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <strong>Service:</strong>
                                                        <?= htmlspecialchars($request['service_name']) ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="status-badge status-<?= strtolower($request['status']) ?>">
                                                            <?= ucfirst(htmlspecialchars($request['status'])) ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="user_service_requests"
                                                            class="btn btn-sm btn-outline-primary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end section -->

    <!-- Image Modal (Updated for Profile Photo) -->
    <div id="imageModal" class="modal main_img_con" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered main_inner_con">
            <div class="modal-content main_inner_content_con">
                <div class="modal-header border-0 main_content_header">
                    <h5 class="modal-title w-100 text-center main_header_text" id="profilePhotoModalLabel">
                        <?= htmlspecialchars($user_data['name'] ?? $username) ?>'s Profile Photo
                    </h5>
                </div>
                <div class="modal-body text-center main_con_body">
                    <img class="modal-image main_image" id="modalImage" alt="Profile Photo">
                </div>
                <div class="modal-footer border-0 justify-content-center image_close_btn">
                    <button type="button" class="btn btn-primary" id="closeModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include 'footer.php'; ?>
    <!-- end footer -->

    <!-- js section -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- menu js -->
    <script src="js/menumaker.js"></script>
    <!-- wow animation -->
    <script src="js/wow.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    <script src="revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="js/security.js"></script>
    <script src="js/profile_image.js"></script>
</body>

</html>