<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$record_id = (int) $_GET['id'];

/* Load existing vitals */
$vitals = $pdo->prepare("SELECT * FROM vitals WHERE record_id = ?");
$vitals->execute([$record_id]);
$vitals = $vitals->fetch();
?>

<h2>Edit Consultation</h2>

<form method="POST" action="update.php">
<input type="hidden" name="record_id" value="<?= $record_id ?>">

<input type="hidden" name="patient_id" value="<?= $vitals['patient_id'] ?>">


<h3>Vitals</h3>
<input name="bp" value="<?= $vitals['bp'] ?>" required>
<input name="weight" value="<?= $vitals['weight'] ?>" required>
<input name="height" value="<?= $vitals['height'] ?>" required>
<input name="temperature" value="<?= $vitals['temperature'] ?>" required>

<br><br>
<button type="submit">Update Consultation</button>
</form>
