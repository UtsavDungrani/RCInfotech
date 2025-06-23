<?php
require_once './config/config.php';

$id = $_GET['id'] ?? 0;
$stmt = $link->prepare("SELECT image FROM product WHERE id = ?");
$stmt->execute([$id]);
$image = $stmt->fetchColumn();
    
header("Content-Type: image/*");
echo $image;
?>