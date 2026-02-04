<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$stmt = $pdo->query("
    SELECT 
        c.record_id,
        c.date_of_consultation,
        c.consultation_time,
        c.name_of_attending_provider,
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
<head><title>Consultations</title></head>
<body style="font-family:Arial;background:#f4f6f8;padding:20px;">

<h2>Consultation Records</h2>

<a href="/bhcis/consultations/create.php"
   style="padding:8px 14px;background:#1e88e5;color:#fff;text-decoration:none;border-radius:4px;">
   + New Consultation
</a>

<table style="width:100%;margin-top:15px;border-collapse:collapse;background:#fff;">
<thead style="background:#e3f2fd;">
<tr>
    <th>Date</th>
    <th>Time</th>
    <th>Patient</th>
    <th>Visit Type</th>
    <th>Provider</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php if (!$consultations): ?>
<tr><td colspan="6" style="text-align:center;padding:15px;">No records found</td></tr>
<?php else: foreach ($consultations as $c): ?>
<tr style="text-align:center;">
<td><?= htmlspecialchars($c['date_of_consultation']) ?></td>
<td><?= $c['consultation_time'] ?? '—' ?></td>
<td style="text-align:left">
    <?= htmlspecialchars($c['last_name'] . ', ' . $c['first_name']) ?>
</td>
<td><?= htmlspecialchars($c['visit_type'] ?? '—') ?></td>
<td><?= htmlspecialchars($c['name_of_attending_provider']) ?></td>
<td>
<a href="view.php?id=<?= $c['record_id'] ?>"
   style="padding:4px 8px;background:#43a047;color:#fff;border-radius:3px;text-decoration:none;">
   View
</a>
</td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>

<p>Total Records: <strong><?= count($consultations) ?></strong></p>
</body>
</html>
