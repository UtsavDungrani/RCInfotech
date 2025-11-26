<?php
session_start();
include '../pages/csp.php';
session_destroy();
header("Location: login");
exit();