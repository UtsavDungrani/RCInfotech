<?php
session_start();
require_once '../../config/config.php';

include '../../csp.php'; 

// Check if product ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: update_product.php');
    exit();
}

$productId = $_GET['id'];

try {
    // Prepare and execute the delete query
    $stmt = $link->prepare("DELETE FROM product WHERE id = ?");
    $stmt->execute([$productId]);

    // Redirect back to update page with success message
    $_SESSION['message'] = 'Product deleted successfully';
    header('Location: update_product.php');
    exit();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = 'Error deleting product';
    header('Location: update_product.php');
    exit();
}

?>
