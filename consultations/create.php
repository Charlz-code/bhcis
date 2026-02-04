<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$_SESSION['csrf'] = bin2hex(random_bytes(32));

$patients = $pdo->query("SELECT patient_id,last_name,first_name FROM patient ORDER BY last_name")->fetchAll();
$visits   = $pdo->query("SELECT * FROM nature_of_visit")->fetchAll();
$txnTypes = $pdo->query("SELECT * FROM mode_of_transaction")->fetchAll();
$dxList   = $pdo->query("SELECT * FROM diagnosis_lookup ORDER BY diagnosis_name")->fetchAll();
$medList  = $pdo->query("SELECT * FROM medicines ORDER BY medicine_name")->fetchAll();

$medicineOptions = '';
foreach ($medList as $m) {
    $medicineOptions .= "<option value='{$m['medicine_id']}'>{$m['medicine_name']}</option>";
}
?>

<div style="font-family:Arial;background:#f4f6f8;padding:20px;">

<h2>New Consultation</h2>

<form method="POST" action="store.php">
<input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

<div class="step">
<h3>Step 1: Consultation</h3>

<select name="patient_id" required>
<option value="">Select Patient</option>
<?php foreach ($patients as $p): ?>
<option value="<?= $p['patient_id'] ?>">
<?= $p['last_name'] . ', ' . $p['first_name'] ?>
</option>
<?php endforeach; ?>
</select>

<select name="visit_type_id" required>
<?php foreach ($visits as $v): ?>
<option value="<?= $v['visit_type_id'] ?>"><?= $v['visit_type'] ?></option>
<?php endforeach; ?>
</select>

<select name="transaction_type_id" required>
<?php foreach ($txnTypes as $t): ?>
<option value="<?= $t['transaction_type_id'] ?>"><?= $t['transaction_type'] ?></option>
<?php endforeach; ?>
</select>
</div>

<div class="step" style="display:none">
<h3>Step 2: Vitals</h3>
<input name="bp" placeholder="BP 120/80" required>
<input name="weight" type="number" step="0.01" placeholder="Weight (kg)" required>
<input name="height" type="number" step="0.01" placeholder="Height (cm)" required>
<input name="temperature" type="number" step="0.01" placeholder="Temp °C" required>
</div>

<div class="step" style="display:none">
<h3>Step 3: Diagnosis</h3>
<?php foreach ($dxList as $d): ?>
<label>
<input type="checkbox" name="diagnosis_ids[]" value="<?= $d['diagnosis_id'] ?>">
<?= $d['diagnosis_name'] ?>
</label><br>
<?php endforeach; ?>
<textarea name="diagnosis_remarks" placeholder="Remarks"></textarea>
</div>

<div class="step" style="display:none">
<h3>Step 4: Medication</h3>

<div id="medications">
<div>
<select name="medications[0][medicine_id]"><?= $medicineOptions ?></select>
<input name="medications[0][dosage]" placeholder="Dosage">
<input name="medications[0][frequency]" placeholder="Frequency">
<input name="medications[0][duration]" placeholder="Duration">
<input name="medications[0][notes]" placeholder="Notes">
</div>
</div>

<button type="button" onclick="addMed()">+ Add Medication</button>
</div>

<br>
<button type="button" onclick="prev()">Back</button>
<button type="button" onclick="next()">Next</button>
<button type="submit" id="submitBtn" style="display:none">Save Consultation</button>
</form>
</div>

<script>
let current=0, steps=document.querySelectorAll('.step');
function showStep(i){
steps.forEach((s,idx)=>s.style.display=idx===i?'block':'none');
document.getElementById('submitBtn').style.display=(i===steps.length-1)?'inline':'none';
}
function next(){ if(current<steps.length-1) current++; showStep(current); }
function prev(){ if(current>0) current--; showStep(current); }

let medIndex=1;
function addMed(){
const div=document.createElement('div');
div.innerHTML=`
<select name="medications[${medIndex}][medicine_id]"><?= $medicineOptions ?></select>
<input name="medications[${medIndex}][dosage]" placeholder="Dosage">
<input name="medications[${medIndex}][frequency]" placeholder="Frequency">
<input name="medications[${medIndex}][duration]" placeholder="Duration">
<input name="medications[${medIndex}][notes]" placeholder="Notes">
`;
document.getElementById('medications').appendChild(div);
medIndex++;
}
showStep(current);
</script>
