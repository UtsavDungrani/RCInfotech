<?php
session_start();
include '../csp.php';
session_destroy();
header("Location: login.php");
exit();