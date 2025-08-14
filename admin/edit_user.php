<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Handle form submission for editing a user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $fullName = $_POST['full-name'] ?? '';
    $phoneNumber = $_POST['phone-number'] ?? '';
    $address = $_POST['address'] ?? '';
    $role = $_POST['role'] ?? 'user';

    // Handle photo upload
    $photo_data = null;
    $photo_sql = "";
    $photo_params = [];

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['photo']['type'], $allowed_types)) {
            $_SESSION['error'] = "Please upload a valid image file (JPEG, PNG, GIF).";
            header("Location: edit_user.php?id=" . $id);
            exit();
        }

        if ($_FILES['photo']['size'] > $max_size) {
            $_SESSION['error'] = "Image size should be less than 5MB.";
            header("Location: edit_user.php?id=" . $id);
            exit();
        }

        $photo_data = file_get_contents($_FILES['photo']['tmp_name']);
        $photo_sql = ", photo = :photo";
        $photo_params[':photo'] = $photo_data;
    }

    try {
        $sql = "UPDATE users SET 
            username = :username, 
            email = :email, 
            name = :name,
            phone = :phone, 
            address = :address" .
            ($photo_data ? ", photo = :photo" : "") .
            " WHERE id = :id";

        $params = [
            ':username' => $name,
            ':email' => $email,
            ':name' => $fullName,
            ':phone' => $phoneNumber,
            ':address' => $address,
            ':id' => $id
        ];

        if ($photo_data) {
            $params[':photo'] = $photo_data;
        }

        $stmt = $link->prepare($sql);
        $stmt->execute($params);

        $_SESSION['success'] = "User updated successfully!";
        header("Location: users.php");
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "Failed to update user. Please try again.";
        header("Location: users.php");
        exit();
    }
}

// Fetch the user's current details for the form
$user = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $link->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $_SESSION['error'] = "Failed to fetch user details.";
        header("Location: users.php");
        exit();
    }
}
?>
<?php include '../csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
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
                                                class="topbar-hightlight">Edit User</span> </li>
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
                <!-- Display success/error messages -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="main_heading text_align_left home_head">
                                <h2>Edit User</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user['id'] ?? '' ?>">

                    <!-- Current Photo Display -->
                    <?php if (!empty($user['photo'])): ?>
                        <div class="text-center mb-3">
                            <img src="data:image/jpeg;base64,<?= base64_encode($user['photo']) ?>"
                                alt="Current Profile Photo" class="profile-photo">
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Full name</label>
                        <input type="text" class="form-control" id="full-name" name="full-name"
                            value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone number</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone-number"
                            pattern="^[6-9][0-9]{9}$" maxlength="10"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                            title="Please enter valid 10 digit Indian mobile number starting with 6-9"
                            value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="<?= htmlspecialchars($user['address'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Profile Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo"
                            accept="image/jpeg,image/png,image/gif">
                        <small class="form-text text-muted">Upload JPEG, PNG, or GIF (max 5MB)</small>
                        <img id="photoPreview" class="photo-preview" alt="Photo Preview">
                    </div>

                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="users.php" class="btn btn-secondary">Cancel</a>
                </form>
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
    <script>
        document.getElementById('photo').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('photoPreview');

            if (file) {
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    this.value = '';
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>