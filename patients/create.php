<?php
session_start();
require_once __DIR__ . '/../config/db.php';

/* ===============================
   LOOKUPS
=============================== */
$zones = $pdo->query("
    SELECT z.zone_id, z.zone_number, 
           CONCAT(hw.first_name,' ',hw.last_name) AS worker
    FROM zone z
    LEFT JOIN health_worker hw ON z.assigned_worker_id = hw.worker_id
    ORDER BY z.zone_number
")->fetchAll();
?>

<div style="
    font-family: Arial, sans-serif;
    background:#f4f6f8;
    padding:20px;
    min-height:100vh;
">

<h2>Patient Enrolment Record</h2>

<form method="POST" action="store.php">

<!-- ================= SECTION 1 ================= -->
<div class="step">
  <h3>Section 1: Patient Identification</h3>

  <input name="last_name" placeholder="Last Name" required>
  <input name="first_name" placeholder="First Name" required>
  <input name="middle_name" placeholder="Middle Name">
  <input name="suffix" placeholder="Suffix (Jr., Sr., III)">

  <br><br>
  <label>Date of Birth</label><br>
  <input type="date" name="date_of_birth" required>
</div>

<!-- ================= SECTION 2 ================= -->
<div class="step" style="display:none">
  <h3>Section 2: Address & Household</h3>

  <textarea name="residential_address" placeholder="Complete Address" required></textarea>

  <br><br>
  <label>Zone / Assigned BHW</label><br>
  <select name="zone_id" required>
    <option value="">Select Zone</option>
    <?php foreach ($zones as $z): ?>
      <option value="<?= $z['zone_id'] ?>">
        Zone <?= $z['zone_number'] ?> — <?= $z['worker'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <br><br>
  <input name="household_contact" placeholder="Household Contact Number">
</div>

<!-- ================= SECTION 3 ================= -->
<div class="step" style="display:none">
  <h3>Section 3: Enrollment Details</h3>

  <input name="patient_enrollment_id" placeholder="Patient Enrollment ID (optional)">
  <p style="color:#666;font-size:13px">
    Leave blank to auto-generate.
  </p>
</div>

<!-- ================= NAV ================= -->
<br>
<button type="button" onclick="prev()">Back</button>
<button type="button" onclick="next()">Next</button>
<button type="submit" id="submitBtn" style="display:none">
  Save Patient Record
</button>

</form>
</div>

<script>
let current = 0;
const steps = document.querySelectorAll(".step");

function showStep(i) {
  steps.forEach((s, idx) => s.style.display = idx === i ? "block" : "none");
  document.getElementById("submitBtn").style.display =
    (i === steps.length - 1) ? "inline" : "none";
}

function next() {
  if (current < steps.length - 1) current++;
  showStep(current);
}

function prev() {
  if (current > 0) current--;
  showStep(current);
}

showStep(current);
</script>
