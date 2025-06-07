<?php
require_once './config/config.php';

$id = $_GET['id'] ?? 0;
$stmt = $link->prepare("SELECT image FROM services WHERE id = ?");  // Updated column name
$stmt->execute([$id]);
$image = $stmt->fetchColumn();

header("Content-Type: image/jpeg");
echo $image;
?>