<?php
declare(strict_types=1);
session_start();

define('BASE_PATH', __DIR__);

// ===============================
// CORE DEPENDENCIES
// ===============================
require_once BASE_PATH . '/config/db.php';
require_once BASE_PATH . '/includes/auth_check.php';

// ===============================
// ROUTING CONFIG
// ===============================
$page = $_GET['page'] ?? 'dashboard';

$routes = [
    'dashboard'     => 'dashboard.php',
    'patients'      => 'patients/index.php',
    'consultations' => 'consultations/index.php',
    'prenatal'      => 'prenatal/index.php',
    'postpartum'    => 'postpartum/index.php',
    'immunization'  => 'immunization/index.php',
    'users'         => 'users/index.php',
];

// Optional: Page titles for header.php
$pageTitles = [
    'dashboard'     => 'Dashboard',
    'patients'      => 'Patients',
    'consultations' => 'Consultations',
    'prenatal'      => 'Prenatal Records',
    'postpartum'    => 'Postpartum Records',
    'immunization'  => 'Immunization',
    'users'         => 'User Management',
];

// Set global page title
$GLOBALS['page_title'] = $pageTitles[$page] ?? 'BHCIS';

// ===============================
// HEADER
// ===============================
require_once BASE_PATH . '/includes/header.php';

// ===============================
// MAIN CONTENT WRAPPER
// ===============================
echo '<main style="
    padding:20px;
    min-height:calc(100vh - 120px);
    background:#f4f6f8;
">';

// ===============================
// ROUTE RESOLUTION
// ===============================
if ($page === 'dashboard') {

    require BASE_PATH . '/dashboard.php';

} elseif (isset($routes[$page])) {

    $path = BASE_PATH . '/' . $routes[$page];

    if (file_exists($path)) {
        require $path;
    } else {
        http_response_code(404);
        echo renderErrorCard(
            'Module Not Found',
            'The requested module exists in routing but the file is missing.'
        );
    }

} else {

    http_response_code(404);
    echo renderErrorCard(
        '404 – Page Not Found',
        'The page you are trying to access does not exist.'
    );
}

echo '</main>';

// ===============================
// FOOTER
// ===============================
require_once BASE_PATH . '/includes/footer.php';

// ===============================
// HELPER: ERROR CARD
// ===============================
function renderErrorCard(string $title, string $message): string
{
    return '
    <div style="
        max-width:600px;
        margin:60px auto;
        background:#fff;
        padding:25px;
        border-radius:8px;
        box-shadow:0 2px 8px rgba(0,0,0,0.1);
        text-align:center;
    ">
        <h2 style="color:#e53935;margin-top:0;">' . htmlspecialchars($title) . '</h2>
        <p style="color:#555;">' . htmlspecialchars($message) . '</p>
        <a href="?page=dashboard"
           style="
            display:inline-block;
            margin-top:15px;
            padding:8px 14px;
            background:#1e88e5;
            color:#fff;
            text-decoration:none;
            border-radius:4px;
           ">
           Go to Dashboard
        </a>
    </div>';
}
