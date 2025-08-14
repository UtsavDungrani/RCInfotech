<?php
function checkAdminAuth()
{
    // Check if admin is logged in
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /RCInfotech/admin/login");
        exit();
    }
}
?>
