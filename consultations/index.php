<?php
session_start();
require_once __DIR__ . '/../config/db.php';

/*
 Fetch recent consultations
*/
$stmt = $pdo->query("
    SELECT 
        c.record_id,
        c.date_of_consultation,
        c.consultation_time,
        p.last_name,
        p.first_name,
        nv.visit_type
    FROM consultation_record c
    JOIN patient p ON c.patient_id = p.patient_id
    LEFT JOIN nature_of_visit nv ON c.visit_type_id = nv.visit_type_id
    ORDER BY c.date_of_consultation DESC, c.consultation_time DESC
");
$consultations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultations</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; margin:0; padding:20px;">

<h2 style="margin-bottom:10px;">Consultation Records</h2>

<a href="consultations/create.php"
   style="
     display:inline-block;
     padding:8px 14px;
     background:#1e88e5;
     color:#fff;
     text-decoration:none;
     border-radius:4px;
     margin-bottom:15px;
   ">
   + New Consultation
</a>

<table style="
    width:100%;
    border-collapse:collapse;
    background:#fff;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
">
    <thead style="background:#e3f2fd;">
        <tr>
            <th style="padding:10px; border:1px solid #ccc;">Date</th>
            <th style="padding:10px; border:1px solid #ccc;">Time</th>
            <th style="padding:10px; border:1px solid #ccc;">Patient</th>
            <th style="padding:10px; border:1px solid #ccc;">Visit Type</th>
            <th style="padding:10px; border:1px solid #ccc;">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($consultations) === 0): ?>
        <tr>
            <td colspan="5" style="padding:15px; text-align:center;">
                No consultation records found.
            </td>
        </tr>
    <?php else: ?>
        <?php foreach ($consultations as $c): ?>
        <tr style="text-align:center;">
            <td style="padding:8px; border:1px solid #ddd;">
                <?= htmlspecialchars($c['date_of_consultation']) ?>
            </td>
            <td style="padding:8px; border:1px solid #ddd;">
                <?= htmlspecialchars($c['consultation_time']) ?>
            </td>
            <td style="padding:8px; border:1px solid #ddd; text-align:left;">
                <?= htmlspecialchars($c['last_name'] . ', ' . $c['first_name']) ?>
            </td>
            <td style="padding:8px; border:1px solid #ddd;">
                <?= htmlspecialchars($c['visit_type'] ?? '—') ?>
            </td>
            <td style="padding:8px; border:1px solid #ddd;">
                <a href="view.php?id=<?= $c['record_id'] ?>"
                   style="
                     padding:4px 8px;
                     background:#43a047;
                     color:white;
                     text-decoration:none;
                     border-radius:3px;
                   ">
                   View
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<p style="margin-top:10px; color:#555;">
    Total Records: <strong><?= count($consultations) ?></strong>
</p>

</body>
</html>
