<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

include __DIR__ . '/../../pages/csp.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: update_service');
    exit();
}

$serviceId = $_GET['id'];

try {
    // Fetch service to get image path
    $fetch_stmt = $link->prepare("SELECT image_path FROM services WHERE id = ?");
    $fetch_stmt->execute([$serviceId]);
    $service = $fetch_stmt->fetch(PDO::FETCH_ASSOC);

    // Delete image file if it exists
    if ($service && !empty($service['image_path'])) {
        $image_file = $_SERVER['DOCUMENT_ROOT'] . '/RCInfotech/' . $service['image_path'];
        if (file_exists($image_file)) {
            unlink($image_file);
        }
    }

    $stmt = $link->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$serviceId]);

    $_SESSION['message'] = 'Service deleted successfully';
    header('Location: update_service');
    exit();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = 'Error deleting service';
    header('Location: update_service');
    exit();
}