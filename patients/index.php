<?php
$stmt = $pdo->query("
    SELECT p.patient_id, p.last_name, p.first_name, z.zone_number
    FROM patient p
    LEFT JOIN household h ON p.household_id = h.household_id
    LEFT JOIN zone z ON h.zone_id = z.zone_id
    ORDER BY p.last_name
");
?>

<h2>Patients</h2>

<table border="1" cellpadding="5">
<tr>
    <th>Name</th>
    <th>Zone</th>
</tr>
<?php foreach ($stmt as $row): ?>
<tr>
    <td><?= "{$row['last_name']}, {$row['first_name']}" ?></td>
    <td><?= $row['zone_number'] ?? '—' ?></td>
</tr>
<?php endforeach; ?>
</table>
