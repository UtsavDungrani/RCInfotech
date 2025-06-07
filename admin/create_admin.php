<?php
require_once '../config/config.php';

// Add CSP header
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self';");

try {
    if (isset($_POST['submit'])) {
        // First, let's clear any existing admin user to avoid duplicates
        $link->query("DELETE FROM admin_users WHERE username = 'admin'");

        // Now create new admin user
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $link->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashed_password]);

        echo "Admin user created successfully!<br>";
        echo "Username: $username<br>";
        echo "Password: $password<br>";
        echo "You can now go to the login page and sign in.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        Username:<input type="text" name="username"><br>
        Password:<input type="text" name="password"><br>
        <input type="submit" value="submit" name="submit">
    </form>
    <script src="../js/security.js"></script>
</body>

</html>