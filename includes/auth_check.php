<?php
if (basename($_SERVER['PHP_SELF']) === 'login.php') {
    return;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /bhcis/auth/login.php");
    exit;
}
