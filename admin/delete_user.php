<?php
session_start();
require_once '../config/config.php';

include '../csp.php'; 

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: users');
    exit();
}

$serviceId = $_GET['id'];

try {
    $stmt = $link->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$serviceId]);

    $_SESSION['message'] = 'Service deleted successfully';
    header('Location: users');
    exit();
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $_SESSION['error'] = 'Error deleting service';
    header('Location: users');
    exit();
}