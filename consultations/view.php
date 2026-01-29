<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if (!isset($_GET['id'])) {
    die("Consultation ID required.");
}

$record_id = (int) $_GET['id'];

/* ===============================
   CORE CONSULTATION
=============================== */
$stmt = $pdo->prepare("
    SELECT c.*, 
           p.first_name, p.last_name,
           nv.visit_type,
           mt.transaction_type
    FROM consultation_record c
    JOIN patient p ON c.patient_id = p.patient_id
    LEFT JOIN nature_of_visit nv ON c.visit_type_id = nv.visit_type_id
    LEFT JOIN mode_of_transaction mt ON c.transaction_type_id = mt.transaction_type_id
    WHERE c.record_id = ?
");
$stmt->execute([$record_id]);
$consultation = $stmt->fetch();

if (!$consultation) {
    die("Consultation not found.");
}

/* ===============================
   VITALS
=============================== */
$vitals = $pdo->prepare("SELECT * FROM vitals WHERE record_id = ?");
$vitals->execute([$record_id]);
$vitals = $vitals->fetch();

/* ===============================
   DIAGNOSES
=============================== */
$diagnoses = $pdo->prepare("
    SELECT d.diagnosis_name, dr.remarks
    FROM diagnosis_record dr
    JOIN diagnosis_lookup d ON dr.diagnosis_id = d.diagnosis_id
    WHERE dr.record_id = ?
");
$diagnoses->execute([$record_id]);
$diagnoses = $diagnoses->fetchAll();

/* ===============================
   MEDICATIONS
=============================== */
$meds = $pdo->query("
    SELECT m.medicine_name, t.dosage, t.frequency, t.duration
    FROM medication_treatment t
    JOIN medicines m ON t.medicine_id = m.medicine_id
")->fetchAll();
?>

<h2>Consultation Summary</h2>

<p><strong>Patient:</strong>
<?= $consultation['last_name'] . ', ' . $consultation['first_name'] ?></p>

<p><strong>Date:</strong> <?= $consultation['date_of_consultation'] ?></p>
<p><strong>Visit Type:</strong> <?= $consultation['visit_type'] ?></p>
<p><strong>Transaction:</strong> <?= $consultation['transaction_type'] ?></p>

<hr>

<h3>Vitals</h3>
<?php if ($vitals): ?>
<ul>
    <li>BP: <?= $vitals['bp'] ?></li>
    <li>Weight: <?= $vitals['weight'] ?> kg</li>
    <li>Height: <?= $vitals['height'] ?> cm</li>
    <li>Temperature: <?= $vitals['temperature'] ?> °C</li>
</ul>
<?php else: ?>
<p>No vitals recorded.</p>
<?php endif; ?>

<hr>

<h3>Diagnoses</h3>
<ul>
<?php foreach ($diagnoses as $d): ?>
    <li><?= $d['diagnosis_name'] ?> — <?= $d['remarks'] ?></li>
<?php endforeach; ?>
</ul>

<hr>

<h3>Medications</h3>
<ul>
<?php foreach ($meds as $m): ?>
    <li>
        <?= $m['medicine_name'] ?> |
        <?= $m['dosage'] ?> |
        <?= $m['frequency'] ?> |
        <?= $m['duration'] ?>
    </li>
<?php endforeach; ?>
</ul>

<br>
<a href="/bhcis/consultations/edit.php?id=<?= $record_id ?>">Edit Consultation</a>
