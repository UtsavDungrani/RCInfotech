<?php
require_once './config/config.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    http_response_code(404);
    exit('Invalid service id');
}

try {
    // First try to get image_path (new method)
    $stmt = $link->prepare("SELECT image_path, image FROM services WHERE id = ?");
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        http_response_code(404);
        exit('Service not found');
    }

    // Prioritize image_path over blob image
    if (!empty($service['image_path'])) {
        // Serve file from filesystem
        $file_path = __DIR__ . '/' . $service['image_path'];

        if (file_exists($file_path)) {
            // Get MIME type: prefer finfo, fall back to mime_content_type, otherwise use generic
            $mime_type = 'application/octet-stream';
            if (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if ($finfo) {
                    $detected = finfo_file($finfo, $file_path);
                    if ($detected) {
                        $mime_type = $detected;
                    }
                    finfo_close($finfo);
                }
            } elseif (function_exists('mime_content_type')) {
                $mime_type = mime_content_type($file_path);
            }

            header("Content-Type: " . $mime_type);
            header("Content-Length: " . filesize($file_path));
            readfile($file_path);
        } else {
            http_response_code(404);
            exit('Image file not found');
        }
    } elseif (!empty($service['image'])) {
        // Fallback to blob image (for migration period)
        $blob = $service['image'];
        $length = strlen($blob);

        // Try to detect MIME type from the binary data if possible
        $mime_type = 'application/octet-stream';
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo) {
                $detected = finfo_buffer($finfo, $blob);
                if ($detected) {
                    $mime_type = $detected;
                }
                finfo_close($finfo);
            }
        }

        header("Content-Type: " . $mime_type);
        header("Content-Length: " . $length);
        echo $blob;
    } else {
        http_response_code(404);
        exit('No image available');
    }
} catch (Throwable $e) {
    http_response_code(500);
    exit('Error retrieving image: ' . $e->getMessage());
}
?>