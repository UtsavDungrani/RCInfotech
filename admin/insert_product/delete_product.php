<?php
session_start();
require_once '../../config/config.php';

include '../../csp.php';

// Check if product ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: update_product');
    exit();
}

$productId = $_GET['id'];

try {
    // Fetch product to get image path
    $fetch_stmt = $link->prepare("SELECT image_path FROM product WHERE id = ?");
    $fetch_stmt->execute([$productId]);
    $product = $fetch_stmt->fetch(PDO::FETCH_ASSOC);

    // Delete image file if it exists
    if ($product && !empty($product['image_path'])) {
        $image_file = $_SERVER['DOCUMENT_ROOT'] . '/RCInfotech/' . $product['image_path'];
        if (file_exists($image_file)) {
            unlink($image_file);
        }
    }

    // Prepare and execute the delete query
    $stmt = $link->prepare("DELETE FROM product WHERE id = ?");
    $stmt->execute([$productId]);

    // Redirect back to update page with success message
    $_SESSION['message'] = 'Product deleted successfully';
    header('Location: update_product');
    exit();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = 'Error deleting product';
    header('Location: update_product');
    exit();
}

?>