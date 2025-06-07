<?php
// Add CSP header
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self';");

function checkAdminAuth()
{
    // Check if admin is logged in
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /RCInfotech/admin/login.php");
        exit();
    }
}
