<?php

$is_localhost = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1' || $_SERVER['HTTP_HOST'] === 'localhost:80' || $_SERVER['HTTP_HOST'] === 'localhost:8080');

if ($is_localhost) {
    // Localhost configuration
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "cms";
} else {
    // Hostinger (Production) configuration
    $host = "localhost";  // Change this to your Hostinger database host
    $user = "u221873998_utsav";       // Change this to your Hostinger database user
    $pass = "Uts@v1907";   // Change this to your Hostinger database password
    $db = "u221873998_cms";   // Change this to your Hostinger database name
}

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $link = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
?>