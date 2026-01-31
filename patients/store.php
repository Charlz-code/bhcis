<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: create.php");
    exit;
}

try {
    $pdo->beginTransaction();

    /* ===============================
       SANITIZE INPUT
    =============================== */
    $last_name   = trim($_POST['last_name']);
    $first_name  = trim($_POST['first_name']);
    $middle_name = trim($_POST['middle_name'] ?? null);
    $suffix      = trim($_POST['suffix'] ?? null);
    $dob         = $_POST['date_of_birth'];
    $address     = trim($_POST['residential_address']);

    $zone_id     = (int) $_POST['zone_id'];
    $contact     = trim($_POST['household_contact'] ?? null);

    $enrollment  = trim($_POST['patient_enrollment_id'] ?? '');

    if (!$last_name || !$first_name || !$dob || !$zone_id) {
        throw new Exception("Required fields missing.");
    }

    /* ===============================
       CREATE HOUSEHOLD
    =============================== */
    $stmt = $pdo->prepare("
        INSERT INTO household (family_id, household_contact, zone_id)
        VALUES (?, ?, ?)
    ");

    // Family ID = timestamp-based (simple + unique)
    $family_id = 'FAM-' . date('YmdHis');

    $stmt->execute([$family_id, $contact, $zone_id]);
    $household_id = $pdo->lastInsertId();

    /* ===============================
       AUTO-GENERATE ENROLLMENT ID
    =============================== */
    if ($enrollment === '') {
        $enrollment = 'PE-' . date('Y') . '-' . str_pad($household_id, 6, '0', STR_PAD_LEFT);
    }

    /* ===============================
       INSERT PATIENT
    =============================== */
    $stmt = $pdo->prepare("
        INSERT INTO patient (
            first_name,
            last_name,
            middle_name,
            suffix,
            residential_address,
            date_of_birth,
            household_id,
            patient_enrollment_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $first_name,
        $last_name,
        $middle_name,
        $suffix,
        $address,
        $dob,
        $household_id,
        $enrollment
    ]);

    $patient_id = $pdo->lastInsertId();

    $pdo->commit();

    /* ===============================
       REDIRECT
    =============================== */
    header("Location: view.php?id=" . $patient_id);
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    die("Patient registration failed: " . $e->getMessage());
}
