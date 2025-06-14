<?php
require_once './config/config.php';

$id = $_GET['id'] ?? 0;

// Set cache headers
header("Cache-Control: public, max-age=31536000"); // Cache for 1 year
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 31536000) . " GMT");
header("Pragma: public");

$stmt = $link->prepare("SELECT image FROM services WHERE id = ?");
$stmt->execute([$id]);
$image = $stmt->fetchColumn();

if ($image) {
    header("Content-Type: image/jpeg");
    echo $image;
} else {
    // Return a default image if no image is found
    header("Content-Type: image/jpeg");
    readfile("images/default-service.jpg");
}
?>