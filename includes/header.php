<!DOCTYPE html>
<html>
<head>
    <title>BHCIS</title>
    <link rel="stylesheet" href="/bhcis/assets/css/style.css">
</head>
<body>

<nav>
    <a href="/bhcis">Dashboard</a>
    <a href="/bhcis?page=patients">Patients</a>
    <a href="/bhcis?page=consultations">Consultations</a>
    <a href="/bhcis?page=prenatal">Prenatal</a>
    <a href="/bhcis?page=immunization">Immunization</a>

    <?php if ($_SESSION['role'] === 'Admin'): ?>
        <a href="/bhcis?page=users">Users</a>
    <?php endif; ?>

    <a href="/bhcis/auth/logout.php">Logout</a>
</nav>
<hr>
