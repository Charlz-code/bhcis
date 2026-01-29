<?php
// Patient count
$patients = $pdo->query("SELECT COUNT(*) FROM patient")->fetchColumn();

// Today consultations
$consults = $pdo->query("
    SELECT COUNT(*) FROM consultation_record
    WHERE date_of_consultation = CURDATE()
")->fetchColumn();

// Prenatal cases
$prenatal = $pdo->query("SELECT COUNT(*) FROM prenatal_record")->fetchColumn();

// Immunizations
$immunization = $pdo->query("SELECT COUNT(*) FROM immunization")->fetchColumn();
?>

<h2>Dashboard</h2>

<ul>
    <li>Total Patients: <strong><?= $patients ?></strong></li>
    <li>Consultations Today: <strong><?= $consults ?></strong></li>
    <li>Prenatal Records: <strong><?= $prenatal ?></strong></li>
    <li>Immunizations Given: <strong><?= $immunization ?></strong></li>
</ul>
