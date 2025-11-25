<?php
session_start();
require_once '../../config/config.php';

include '../../csp.php';

// Check if shop ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: update_shop');
    exit();
}

$shopId = $_GET['id'];

try {
    // Fetch shop to get image path
    $fetch_stmt = $link->prepare("SELECT image_path FROM shop WHERE id = ?");
    $fetch_stmt->execute([$shopId]);
    $shop = $fetch_stmt->fetch(PDO::FETCH_ASSOC);

    // Delete image file if it exists
    if ($shop && !empty($shop['image_path'])) {
        $image_file = $_SERVER['DOCUMENT_ROOT'] . '/RCInfotech/' . $shop['image_path'];
        if (file_exists($image_file)) {
            unlink($image_file);
        }
    }

    // Prepare and execute the delete query
    $stmt = $link->prepare("DELETE FROM shop WHERE id = ?");
    $stmt->execute([$shopId]);

    // Redirect back to update page with success message
    $_SESSION['message'] = 'Shop deleted successfully';
    header('Location: update_shop');
    exit();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = 'Error deleting shop';
    header('Location: update_shop');
    exit();
}
