<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if (!isset($_GET['id'])) {
    die("Patient ID required.");
}

$patient_id = (int) $_GET['id'];

/* ===============================
   CORE PATIENT INFO
=============================== */
$stmt = $pdo->prepare("
    SELECT 
        p.patient_id,
        p.first_name,
        p.middle_name,
        p.last_name,
        p.suffix,
        p.residential_address,
        p.date_of_birth,
        p.patient_enrollment_id,
        h.family_id,
        h.household_contact,
        z.zone_number,
        CONCAT(hw.first_name,' ',hw.last_name) AS assigned_worker
    FROM patient p
    LEFT JOIN household h ON p.household_id = h.household_id
    LEFT JOIN zone z ON h.zone_id = z.zone_id
    LEFT JOIN health_worker hw ON z.assigned_worker_id = hw.worker_id
    WHERE p.patient_id = ?
");
$stmt->execute([$patient_id]);
$patient = $stmt->fetch();

if (!$patient) {
    die("Patient not found.");
}

/* ===============================
   CONSULTATION HISTORY
=============================== */
$consults = $pdo->prepare("
    SELECT 
        c.record_id,
        c.date_of_consultation,
        nv.visit_type,
        mt.transaction_type
    FROM consultation_record c
    LEFT JOIN nature_of_visit nv ON c.visit_type_id = nv.visit_type_id
    LEFT JOIN mode_of_transaction mt ON c.transaction_type_id = mt.transaction_type_id
    WHERE c.patient_id = ?
    ORDER BY c.date_of_consultation DESC
");
$consults->execute([$patient_id]);
$consults = $consults->fetchAll();
?>

<div style="
    font-family: Arial, sans-serif;
    background:#f4f6f8;
    padding:20px;
    min-height:100vh;
">

<h2>Patient Record</h2>

<!-- ================= BASIC INFO ================= -->
<div style="background:#fff;padding:15px;border-radius:6px">
    <h3>Patient Information</h3>

    <p><strong>Name:</strong>
        <?= $patient['last_name'] ?>,
        <?= $patient['first_name'] ?>
        <?= $patient['middle_name'] ?>
        <?= $patient['suffix'] ?>
    </p>

    <p><strong>Date of Birth:</strong> <?= $patient['date_of_birth'] ?></p>
    <p><strong>Enrollment ID:</strong> <?= $patient['patient_enrollment_id'] ?></p>
    <p><strong>Address:</strong> <?= $patient['residential_address'] ?></p>
</div>

<br>

<!-- ================= HOUSEHOLD ================= -->
<div style="background:#fff;padding:15px;border-radius:6px">
    <h3>Household Information</h3>

    <p><strong>Family ID:</strong> <?= $patient['family_id'] ?></p>
    <p><strong>Contact:</strong> <?= $patient['household_contact'] ?></p>
    <p><strong>Zone:</strong> <?= $patient['zone_number'] ?></p>
    <p><strong>Assigned BHW:</strong> <?= $patient['assigned_worker'] ?></p>
</div>

<br>

<!-- ================= CONSULTATIONS ================= -->
<div style="background:#fff;padding:15px;border-radius:6px">
    <h3>Consultation History</h3>

    <?php if ($consults): ?>
        <ul>
        <?php foreach ($consults as $c): ?>
            <li>
                <?= $c['date_of_consultation'] ?> —
                <?= $c['visit_type'] ?> /
                <?= $c['transaction_type'] ?>
                |
                <a href="/bhcis/consultations/view.php?id=<?= $c['record_id'] ?>">
                    View
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No consultations recorded.</p>
    <?php endif; ?>
</div>

<br>

<a href="/bhcis/consultations/create.php?patient_id=<?= $patient_id ?>">
    ➕ New Consultation
</a>

</div>
<br>
<a href="/bhcis/patients/index.php">← Back to Patients</a>
