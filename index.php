<?php
declare(strict_types=1);
session_start();

define('BASE_PATH', __DIR__);

// Core
require_once BASE_PATH . '/config/db.php';
require_once BASE_PATH . '/includes/auth_check.php';
require_once BASE_PATH . '/includes/header.php';

// Default landing
$page = $_GET['page'] ?? 'dashboard';

// Route map (matches your folder structure)
$routes = [
    'dashboard'     => 'dashboard.php',
    'patients'      => 'patients/index.php',
    'consultations' => 'consultations/index.php',
    'prenatal'      => 'prenatal/index.php',
    'postpartum'    => 'postpartum/index.php',
    'immunization'  => 'immunization/index.php',
    'users'         => 'users/index.php',
];

// Resolve route
if ($page === 'dashboard') {
    require BASE_PATH . '/dashboard.php';
} elseif (isset($routes[$page])) {
    $path = BASE_PATH . '/' . $routes[$page];
    file_exists($path)
        ? require $path
        : print "<h3>Module not found</h3>";
} else {
    http_response_code(404);
    echo "<h3>404 – Page not found</h3>";
}

require_once BASE_PATH . '/includes/footer.php';
