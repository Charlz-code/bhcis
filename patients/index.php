<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth_check.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; margin:0; padding:20px;">

<div style="display:flex; gap:10px; align-items:center; margin-bottom:15px;">
  <a href="../"
     style="
       padding:8px 14px;
       background:#666;
       color:#fff;
       text-decoration:none;
       border-radius:4px;
     ">
     ← Back
  </a>
  <h2 style="margin:0;">Patients</h2>
</div>

<a href="patients/create.php" style="
    display:inline-block;
    margin-bottom:15px;
    padding:10px 16px;
    background:#1e88e5;
    color:white;
    text-decoration:none;
    border-radius:4px;
    font-weight:bold;
    box-shadow:0 2px 4px rgba(0,0,0,0.1);
    transition: background 0.3s;
" onmouseover="this.style.background='#1565c0';" onmouseout="this.style.background='#1e88e5';">
+ Register Patient
</a>

<table style="
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
    font-family:Arial, sans-serif;
    color:#444;
">
<tr style="background:#e3f2fd; text-align:left;">
    <th style="padding:12px; border:1px solid #ccc;">Name</th>
    <th style="padding:12px; border:1px solid #ccc; text-align:center;">Zone</th>
    <th style="padding:12px; border:1px solid #ccc; text-align:center;">Action</th>
</tr>

<?php
// Fetch patients with their zone numbers
$stmt = $pdo->query("
    SELECT p.patient_id, p.first_name, p.last_name, p.middle_name, p.suffix, z.zone_number
    FROM patient p
    LEFT JOIN household h ON p.household_id = h.household_id
    LEFT JOIN zone z ON h.zone_id = z.zone_id
    ORDER BY p.last_name ASC
");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($patients as $row): ?>
<tr style="border-bottom:1px solid #ddd;">
    <td style="padding:10px; border:1px solid #ddd;">
        <?= htmlspecialchars($row['last_name'] . ', ' . $row['first_name'] . 
            (!empty($row['middle_name']) ? ' ' . $row['middle_name'] : '') . 
            (!empty($row['suffix']) ? ', ' . $row['suffix'] : '')) ?>
    </td>
    <td style="padding:10px; border:1px solid #ddd; text-align:center;">
        <?= htmlspecialchars($row['zone_number'] ?? '—') ?>
    </td>
    <td style="padding:10px; border:1px solid #ddd; text-align:center;">
        <a href="patients/view.php?id=<?= $row['patient_id'] ?>" style="
            padding:6px 10px;
            background:#43a047;
            color:white;
            text-decoration:none;
            border-radius:3px;
            font-size:14px;
            box-shadow:0 1px 3px rgba(0,0,0,0.1);
            transition: background 0.3s;
        " onmouseover="this.style.background='#2e7d32';" onmouseout="this.style.background='#43a047';">
        View
        </a>
    </td>
</tr>
<?php endforeach; ?>

<?php if (empty($patients)): ?>
<tr>
    <td colspan="3" style="padding:12px; text-align:center; color:#777;">No patients found.</td>
</tr>
<?php endif; ?>
</table>
</body>
</html>