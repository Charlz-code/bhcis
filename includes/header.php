<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>BHCIS</title>
</head>

<body style="
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f6f8;
">

<!-- ===============================
     TOP BAR
================================ -->
<div style="
    background:#1e88e5;
    color:white;
    padding:12px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
">

    <div style="font-size:18px; font-weight:bold;">
        🏥 Brgy Sta. Ana Health Center
    </div>

    <div style="font-size:14px;">
        Logged in as:
        <strong><?= $_SESSION['username'] ?? 'Admin' ?></strong>
    </div>
</div>

<!-- ===============================
     NAVIGATION BAR
================================ -->
<div style="
    background:#ffffff;
    padding:10px 20px;
    border-bottom:1px solid #ddd;
    display:flex;
    gap:15px;
    flex-wrap:wrap;
">

<a href="/bhcis/dashboard.php" style="
    text-decoration:none;
    color:#1e88e5;
    font-weight:bold;
">Dashboard</a>

<a href="/bhcis/patients/index.php" style="
    text-decoration:none;
    color:#333;
">Patients</a>

<a href="/bhcis/consultations/index.php" style="
    text-decoration:none;
    color:#333;
">Consultations</a>

<a href="/bhcis/prenatal/index.php" style="
    text-decoration:none;
    color:#333;
">Prenatal</a>

<a href="/bhcis/postpartum/index.php" style="
    text-decoration:none;
    color:#333;
">Postpartum</a>

<a href="/bhcis/immunization/index.php" style="
    text-decoration:none;
    color:#333;
">Immunization</a>

<a href="/bhcis/users/index.php" style="
    text-decoration:none;
    color:#333;
">Users</a>

<a href="/bhcis/auth/logout.php" style="
    text-decoration:none;
    color:#c62828;
    margin-left:auto;
">Logout</a>

</div>

<!-- ===============================
     PAGE CONTAINER START
================================ -->
<div style="padding:20px;">
