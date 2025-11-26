<?php
function checkAdminAuth()
{
    // Check if admin is logged in
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /admin/login");
        exit();
    }
}
?>
