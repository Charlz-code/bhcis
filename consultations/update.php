<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../config/db.php';

$record_id = (int) $_POST['record_id'];

try {
    $pdo->beginTransaction();

    /* ===============================
       DELETE DEPENDENTS
    =============================== */
    $pdo->prepare("DELETE FROM diagnosis_record WHERE record_id = ?")
        ->execute([$record_id]);

    $pdo->prepare("DELETE FROM vitals WHERE record_id = ?")
        ->execute([$record_id]);

    /* ===============================
       RE-INSERT VITALS
    =============================== */
    $pdo->prepare("
        INSERT INTO vitals (record_id, bp, weight, height, temperature)
        VALUES (?, ?, ?, ?, ?)
    ")->execute([
        $record_id,
        $_POST['bp'],
        $_POST['weight'],
        $_POST['height'],
        $_POST['temperature']
    ]);

    /* (Diagnosis & meds reinsert here if included) */

    $pdo->commit();

    header("Location: /bhcis/consultations/view.php?id=$record_id");
    exit;

} catch (Throwable $e) {
    $pdo->rollBack();
    die("Update failed. No changes saved.");
}


