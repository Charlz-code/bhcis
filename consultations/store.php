<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../config/db.php';

if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    die('Invalid CSRF token');
}

try {
$pdo->beginTransaction();

/* CONSULTATION */
$stmt=$pdo->prepare("
INSERT INTO consultation_record
(patient_id,worker_id,visit_type_id,transaction_type_id,
 date_of_consultation,consultation_time,name_of_attending_provider)
VALUES (?,?,?,?,CURDATE(),CURTIME(),?)
");
$stmt->execute([
$_POST['patient_id'],
$_SESSION['worker_id'],
$_POST['visit_type_id'],
$_POST['transaction_type_id'],
$_SESSION['provider_name']
]);

$record_id=$pdo->lastInsertId();

/* VITALS */
$pdo->prepare("
INSERT INTO vitals (record_id,bp,weight,height,temperature)
VALUES (?,?,?,?,?)
")->execute([
$record_id,$_POST['bp'],$_POST['weight'],$_POST['height'],$_POST['temperature']
]);

/* DIAGNOSIS */
if (!empty($_POST['diagnosis_ids'])) {
$diag=$pdo->prepare("
INSERT INTO diagnosis_record
(patient_id,worker_id,diagnosis_id,record_id,date_diagnosed,remarks)
VALUES (?,?,?,?,CURDATE(),?)
");
foreach ($_POST['diagnosis_ids'] as $dx) {
$diag->execute([
$_POST['patient_id'],
$_SESSION['worker_id'],
$dx,
$record_id,
$_POST['diagnosis_remarks'] ?? null
]);
}
}

/* MEDICATIONS — LINKED TO RECORD */
$med=$pdo->prepare("
INSERT INTO medication_treatment
(record_id,medicine_id,dosage,frequency,duration,additional_notes,provider_name)
VALUES (?,?,?,?,?,?,?)
");

foreach ($_POST['medications'] as $m) {
if (empty($m['medicine_id'])) continue;
$med->execute([
$record_id,
$m['medicine_id'],
$m['dosage'],
$m['frequency'],
$m['duration'],
$m['notes'] ?? null,
$_SESSION['provider_name']
]);
}

$pdo->commit();
header("Location: /bhcis/consultations/view.php?id=".$record_id);
exit;

} catch (Throwable $e) {
$pdo->rollBack();
error_log($e->getMessage());
die("Transaction failed.");
}
