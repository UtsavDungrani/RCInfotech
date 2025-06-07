<?php
session_start();
require_once '../../config/config.php';

// Add CSP header
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self';");

// Check if shop ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: update_shop.php');
    exit();
}

$shopId = $_GET['id'];

try {
    // Prepare and execute the delete query
    $stmt = $link->prepare("DELETE FROM shop WHERE id = ?");
    $stmt->execute([$shopId]);

    // Redirect back to update page with success message
    $_SESSION['message'] = 'Shop deleted successfully';
    header('Location: update_shop.php');
    exit();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = 'Error deleting shop';
    header('Location: update_shop.php');
    exit();
}
