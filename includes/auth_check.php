<?php
// Allow login page without session
$currentFile = basename($_SERVER['PHP_SELF']);
if ($currentFile === 'login.php') {
    return;
}

// BYPASS: Set default session for development
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['role_id'] = 1;
}

// Check authentication (DISABLED FOR DEVELOPMENT)
// if (!isset($_SESSION['user_id'])) {
//     header("Location: /bhcis/auth/login.php");
//     exit;
// }
