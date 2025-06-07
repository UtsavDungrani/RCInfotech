<?php
session_start();
require_once '../../config/config.php';

include '../../csp.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: update_service.php');
    exit();
}

$serviceId = $_GET['id'];

try {
    $stmt = $link->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$serviceId]);

    $_SESSION['message'] = 'Service deleted successfully';
    header('Location: update_service.php');
    exit();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = 'Error deleting service';
    header('Location: update_service.php');
    exit();
}