<?php
session_start();
require_once '../config/config.php';
require_once 'auth_check.php';

// Check authentication
checkAdminAuth();

// Fetch all service requests from the bookser table
$service_requests = [];
try {
    $stmt = $link->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
}
?>
<?php include '../csp.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service Requests</title>
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
        .user-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
            transition: transform 0.2s ease;
            cursor: pointer;
        }

        .user-photo:hover {
            transform: scale(1.1);
            border-color: #007bff;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            border: 2px solid #ddd;
        }

        .table th {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            font-weight: 600;
        }

        .table td {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Modal styles matching profile.php */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 20px;
        }

        .modal-header {
            width: 100%;
            max-width: 600px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background: white;
            border-radius: 8px 8px 0 0;
        }

        .modal-header h5 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .modal-image-container {
            max-width: 600px;
            width: 100%;
            background: white;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }

        .modal-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .close-modal {
            color: #333;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            padding: 0 5px;
        }

        .close-modal:hover {
            color: #039ee3;
        }


        /* Modal custom styles */
        #imageModal .modal-dialog {
            max-width: 350px;
        }

        #imageModal .modal-content {
            border-radius: 20px;
        }

        #imageModal .modal-header,
        #imageModal .modal-footer {
            border: none;
        }

        #imageModal .modal-title {
            font-weight: 600;
        }

        #imageModal .modal-image {
            width: 100%;
            border-radius: 15px;
        }

        .main_img_con {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .main_inner_con {
            max-width: 350px;
            margin: auto;
        }

        .main_inner_content_con {
            border-radius: 20px;
            overflow: hidden;
        }

        .main_content_header {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #fff;
            border-radius: 20px 20px 0 0;
        }

        .main_header_text {
            margin: 16px 0 0 0;
            font-size: 1.2rem;
        }

        .main_con_body {
            background: #fff;
            padding: 24px 16px 16px 16px;
        }

        .main_image {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(50, 41, 41, 0.1);
        }

        .image_close_btn {
            background: #fff;
            border-radius: 0 0 20px 20px;
            padding-bottom: 24px;
        }
    </style>
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
                                                class="topbar-hightlight">Users information</span> </li>
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
                            <div class="main_heading text_align_left home_head">
                                <h2>Users information</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile Photo</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Registration date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td>
                                            <?php if (!empty($user['photo'])): ?>
                                                <img src="data:image/jpeg;base64,<?= base64_encode($user['photo']) ?>"
                                                    alt="User Photo" class="user-photo" title="Click to view larger"
                                                    onclick="openModal(this.src, '<?= htmlspecialchars($user['name'] ?? $user['username']) ?>')">
                                            <?php else: ?>
                                                <div class="user-avatar">
                                                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($user['address']); ?></td>
                                        <td><?php echo htmlspecialchars($user['reg_date']); ?></td>
                                        <td>
                                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-primary">Edit</a>
                                            <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger bg-danger"
                                                onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add this script to hide the loader after a specific duration
        setTimeout(function () {
            document.querySelector('.bg_load').style.display = 'none';
        }, 2000);
    </script>

    <!-- Image Modal (Updated for User Photos) -->
    <div id="imageModal" class="modal main_img_con" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered main_inner_con">
            <div class="modal-content main_inner_content_con">
                <div class="modal-header border-0 main_content_header">
                    <h5 class="modal-title w-100 text-center main_header_text" id="userPhotoModalLabel">
                        User's Profile Photo
                    </h5>
                </div>
                <div class="modal-body text-center main_con_body">
                    <img class="modal-image main_image" id="modalImage" alt="User Photo">
                </div>
                <div class="modal-footer border-0 justify-content-center image_close_btn">
                    <button type="button" class="btn btn-primary" id="closeModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/menumaker.js"></script>
    <script src="../js/wow.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/security.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const closeBtn = document.getElementById('closeModalBtn');
            const modalTitle = document.getElementById('userPhotoModalLabel');

            window.openModal = function (src, userName) {
                if (imageModal && modalImage) {
                    imageModal.style.display = 'flex';
                    modalImage.src = src;
                    modalTitle.textContent = userName + "'s Profile Photo";
                    document.body.style.overflow = 'hidden';
                }
            };

            function closeModal() {
                if (imageModal) {
                    imageModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeModal);
            }

            if (imageModal) {
                imageModal.addEventListener('click', function (e) {
                    if (e.target === imageModal) {
                        closeModal();
                    }
                });
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
</body>

</html>