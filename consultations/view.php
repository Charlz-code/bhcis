<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$record_id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
SELECT c.*, p.first_name, p.last_name, nv.visit_type, mt.transaction_type
FROM consultation_record c
JOIN patient p ON c.patient_id = p.patient_id
LEFT JOIN nature_of_visit nv ON c.visit_type_id = nv.visit_type_id
LEFT JOIN mode_of_transaction mt ON c.transaction_type_id = mt.transaction_type_id
WHERE c.record_id = ?
");
$stmt->execute([$record_id]);
$consultation = $stmt->fetch();
if (!$consultation) die("Consultation not found.");

/* VITALS */
$vitals = $pdo->prepare("SELECT * FROM vitals WHERE record_id = ?");
$vitals->execute([$record_id]);
$vitals = $vitals->fetch();

/* DIAGNOSES */
$diagnoses = $pdo->prepare("
SELECT d.diagnosis_name, dr.remarks
FROM diagnosis_record dr
JOIN diagnosis_lookup d ON dr.diagnosis_id = d.diagnosis_id
WHERE dr.record_id = ?
");
$diagnoses->execute([$record_id]);
$diagnoses = $diagnoses->fetchAll();

/* MEDICATIONS */
$meds = $pdo->prepare("
SELECT m.medicine_name, t.dosage, t.frequency, t.duration
FROM medication_treatment t
JOIN medicines m ON t.medicine_id = m.medicine_id
WHERE t.record_id = ?
");
$meds->execute([$record_id]);
$meds = $meds->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Consultation Summary</title>
</head>
<body style="
    font-family: Arial, sans-serif;
    background:#f4f6f8;
    margin:0;
    padding:20px;
">

<div style="
    max-width:900px;
    margin:auto;
    background:#ffffff;
    border-radius:8px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
    padding:25px;
">

<h2 style="margin-top:0;color:#1e88e5;">Consultation Summary</h2>

<!-- BASIC INFO -->
<div style="
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    background:#f9fbfd;
    padding:15px;
    border-radius:6px;
    margin-bottom:20px;
">
    <div><strong>Patient:</strong><br>
        <?= htmlspecialchars($consultation['last_name'].', '.$consultation['first_name']) ?>
    </div>
    <div><strong>Date:</strong><br>
        <?= htmlspecialchars($consultation['date_of_consultation']) ?>
    </div>
    <div><strong>Visit Type:</strong><br>
        <?= htmlspecialchars($consultation['visit_type']) ?>
    </div>
    <div><strong>Transaction:</strong><br>
        <?= htmlspecialchars($consultation['transaction_type']) ?>
    </div>
</div>

<!-- VITALS -->
<h3 style="border-bottom:2px solid #e3f2fd;padding-bottom:5px;">Vitals</h3>

<?php if ($vitals): ?>
<table style="width:100%;border-collapse:collapse;margin-bottom:20px;">
<tr>
    <th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">BP</th>
    <td style="padding:8px;border-bottom:1px solid #ddd;"><?= $vitals['bp'] ?></td>
</tr>
<tr>
    <th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">Weight</th>
    <td style="padding:8px;border-bottom:1px solid #ddd;"><?= $vitals['weight'] ?> kg</td>
</tr>
<tr>
    <th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">Height</th>
    <td style="padding:8px;border-bottom:1px solid #ddd;"><?= $vitals['height'] ?> cm</td>
</tr>
<tr>
    <th style="text-align:left;padding:8px;">Temperature</th>
    <td style="padding:8px;"><?= $vitals['temperature'] ?> °C</td>
</tr>
</table>
<?php else: ?>
<p style="color:#777;">No vitals recorded.</p>
<?php endif; ?>

<!-- DIAGNOSES -->
<h3 style="border-bottom:2px solid #e3f2fd;padding-bottom:5px;">Diagnoses</h3>

<?php if (!$diagnoses): ?>
<p style="color:#777;">No diagnoses recorded.</p>
<?php else: ?>
<ul style="padding-left:20px;margin-bottom:20px;">
<?php foreach ($diagnoses as $d): ?>
    <li style="margin-bottom:6px;">
        <strong><?= htmlspecialchars($d['diagnosis_name']) ?></strong>
        <?php if ($d['remarks']): ?>
            <span style="color:#555;"> — <?= htmlspecialchars($d['remarks']) ?></span>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<!-- MEDICATIONS -->
<h3 style="border-bottom:2px solid #e3f2fd;padding-bottom:5px;">Medications</h3>

<?php if (!$meds): ?>
<p style="color:#777;">No medications prescribed.</p>
<?php else: ?>
<table style="width:100%;border-collapse:collapse;">
<thead style="background:#e3f2fd;">
<tr>
    <th style="padding:8px;border:1px solid #ccc;">Medicine</th>
    <th style="padding:8px;border:1px solid #ccc;">Dosage</th>
    <th style="padding:8px;border:1px solid #ccc;">Frequency</th>
    <th style="padding:8px;border:1px solid #ccc;">Duration</th>
</tr>
</thead>
<tbody>
<?php foreach ($meds as $m): ?>
<tr>
    <td style="padding:8px;border:1px solid #ddd;"><?= htmlspecialchars($m['medicine_name']) ?></td>
    <td style="padding:8px;border:1px solid #ddd;"><?= htmlspecialchars($m['dosage']) ?></td>
    <td style="padding:8px;border:1px solid #ddd;"><?= htmlspecialchars($m['frequency']) ?></td>
    <td style="padding:8px;border:1px solid #ddd;"><?= htmlspecialchars($m['duration']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>

<!-- ACTION -->
<div style="margin-top:25px;text-align:right;">
<a href="edit.php?id=<?= $record_id ?>"
   style="
    padding:8px 14px;
    background:#1e88e5;
    color:#fff;
    text-decoration:none;
    border-radius:4px;
   ">
   Edit Vitals
</a>
</div>

</div>
</body>
</html>
