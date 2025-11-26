<?php
require_once './config/config.php';

$id = $_GET['id'] ?? 0;

try {
    // First try to get image_path (new method)
    $stmt = $link->prepare("SELECT image_path, image FROM shop WHERE id = ?");
    $stmt->execute([$id]);
    $shop = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$shop) {
        http_response_code(404);
        exit('Shop not found');
    }

    // Prioritize image_path over blob image
    if (!empty($shop['image_path'])) {
        // Serve file from filesystem
        $file_path = __DIR__ . '/' . $shop['image_path'];

        if (file_exists($file_path)) {
            // Get MIME type
            $mime_type = mime_content_type($file_path);
            header("Content-Type: " . $mime_type);
            header("Content-Length: " . filesize($file_path));
            readfile($file_path);
        } else {
            http_response_code(404);
            exit('Image file not found');
        }
    } elseif (!empty($shop['image'])) {
        // Fallback to blob image (for migration period)
        header("Content-Type: image/*");
        echo $shop['image'];
    } else {
        http_response_code(404);
        exit('No image available');
    }
} catch (Exception $e) {
    http_response_code(500);
    exit('Error retrieving image: ' . $e->getMessage());
}
?>