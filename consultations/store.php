<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../config/db.php';

try {
    // Start transaction
    $pdo->beginTransaction();

    /* ===============================
       1. CONSULTATION RECORD
    =============================== */
    $stmt = $pdo->prepare("
        INSERT INTO consultation_record (
            patient_id,
            worker_id,
            visit_type_id,
            transaction_type_id,
            date_of_consultation,
            consultation_time,
            name_of_attending_provider
        ) VALUES (?, ?, ?, ?, CURDATE(), CURTIME(), ?)
    ");

    $stmt->execute([
        $_POST['patient_id'],
        $_SESSION['worker_id'],          // from health_worker
        $_POST['visit_type_id'],
        $_POST['transaction_type_id'],
        $_SESSION['provider_name']
    ]);

    $record_id = $pdo->lastInsertId();

    /* ===============================
       2. VITALS
    =============================== */
    $stmt = $pdo->prepare("
        INSERT INTO vitals (
            record_id, bp, weight, height, temperature
        ) VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $record_id,
        $_POST['bp'],
        $_POST['weight'],
        $_POST['height'],
        $_POST['temperature']
    ]);

    /* ===============================
       3. DIAGNOSES (MULTIPLE)
    =============================== */
    $diagStmt = $pdo->prepare("
        INSERT INTO diagnosis_record (
            patient_id,
            worker_id,
            diagnosis_id,
            record_id,
            date_diagnosed,
            remarks
        ) VALUES (?, ?, ?, ?, CURDATE(), ?)
    ");

    foreach ($_POST['diagnosis_ids'] as $diagnosis_id) {
        $diagStmt->execute([
            $_POST['patient_id'],
            $_SESSION['worker_id'],
            $diagnosis_id,
            $record_id,
            $_POST['diagnosis_remarks'] ?? null
        ]);
    }

    /* ===============================
       4. MEDICATIONS (MULTIPLE)
    =============================== */
    $medStmt = $pdo->prepare("
        INSERT INTO medication_treatment (
            medicine_id,
            dosage,
            frequency,
            duration,
            additional_notes,
            provider_name
        ) VALUES (?, ?, ?, ?, ?, ?)
    ");

    foreach ($_POST['medications'] as $med) {
        $medStmt->execute([
            $med['medicine_id'],
            $med['dosage'],
            $med['frequency'],
            $med['duration'],
            $med['notes'] ?? null,
            $_SESSION['provider_name']
        ]);
    }

    /* ===============================
       COMMIT TRANSACTION
    =============================== */
    $pdo->commit();

    header("Location: /bhcis/consultations/view.php?id=" . $record_id);
    exit;

} catch (Throwable $e) {

    // Roll back everything
    $pdo->rollBack();

    // Log error (recommended)
    error_log($e->getMessage());

    die("Transaction failed. Data not saved.");
}
