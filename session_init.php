<?php
// Initialize the session
session_start();

// Set default username if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    $_SESSION["username"] = "user";
}
?>