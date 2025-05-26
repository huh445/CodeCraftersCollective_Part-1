<?php
// process_eoi.php

// Only handle POST submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit;
}

require_once __DIR__ . '/settings.php';
$conn = db_connect();

//  Delete old table if it exists
$conn->query("DROP TABLE IF EXISTS eoi;");

// Create table with correct columns (no duplicate 'dob')
$createSQL = "
CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(10) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    street VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state CHAR(3) NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    skill1 VARCHAR(50),
    skill2 VARCHAR(50),
    skill3 VARCHAR(50),
    skill4 VARCHAR(50),
    skill5 VARCHAR(50),
    other_skills TEXT,
    status ENUM( ) NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if (!$conn->query($createSQL)) {
    die("Table creation failed: " . $conn->error);
}

// Clean inputs
function clean($data) {
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Collect and clean inputs
$job_ref      = clean($_POST['job-ref'] ?? '');
$first_name   = clean($_POST['first-name'] ?? '');
$last_name    = clean($_POST['last-name'] ?? '');
$dob_raw      = clean($_POST['dob'] ?? '');  // input expected in dd/mm/yyyy format
$gender       = clean($_POST['gender'] ?? '');
$street       = clean($_POST['address'] ?? '');
$suburb       = clean($_POST['suburb'] ?? '');
$state        = clean($_POST['state'] ?? '');
$postcode     = clean($_POST['postcode'] ?? '');
$email        = clean($_POST['email'] ?? '');
$phone        = clean($_POST['phone'] ?? '');
$skills_arr   = $_POST['skills'] ?? [];
$other_skills = clean($_POST['other-skills'] ?? '');

// Convert dob from dd/mm/yyyy to yyyy-mm-dd for SQL Date
$dob = null;
if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $dob_raw, $matches)) {
    $dob = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
}

// Catch any validation errors
$errors = [];

// Rules for validation
if (empty($job_ref)) {
    $errors[] = 'Job reference is required.';
}
if (!preg_match('/^[A-Za-z]{1,20}$/', $first_name)) {
    $errors[] = 'First name must be alpha, max 20 chars.';
}
if (!preg_match('/^[A-Za-z]{1,20}$/', $last_name)) {
    $errors[] = 'Last name must be alpha, max 20 chars.';
}
if (!$dob) {
    $errors[] = 'Date of birth must be in dd/mm/yyyy format.';
}
if (!in_array($gender, ['Male','Female','Other'], true)) {
    $errors[] = 'Invalid gender selection.';
}
if (strlen($street) < 1 || strlen($street) > 40) {
    $errors[] = 'Street address must be 1–40 characters.';
}
if (strlen($suburb) < 1 || strlen($suburb) > 40) {
    $errors[] = 'Suburb must be 1–40 characters.';
}
$state_list = ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'];
if (!in_array($state, $state_list, true)) {
    $errors[] = 'Invalid state selection.';
}
if (!preg_match('/^\d{4}$/', $postcode)) {
    $errors[] = 'Postcode must be exactly 4 digits.';
} else {
    $postcode_map = [
        'VIC' => '/^[38]\d{3}$/',
        'NSW' => '/^[12]\d{3}$/',
        'QLD' => '/^[49]\d{3}$/',
        'NT'  => '/^0\d{3}$/',
        'WA'  => '/^6\d{3}$/',
        'SA'  => '/^5\d{3}$/',
        'TAS' => '/^7\d{3}$/',
        'ACT' => '/^0?2\d{2,3}$/'
    ];
    if (isset($postcode_map[$state]) && !preg_match($postcode_map[$state], $postcode)) {
        $errors[] = "Postcode does not match state $state.";
    }
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format.';
}
if (!preg_match('/^[0-9 ]{8,12}$/', $phone)) {
    $errors[] = 'Phone number must be 8–12 digits (spaces allowed).';
}
if (!is_array($skills_arr) || count($skills_arr) < 1) {
    $errors[] = 'At least one technical skill must be selected.';
}

// Limit and clean skills
$skills_arr = array_slice($skills_arr, 0, 5);
foreach ($skills_arr as $skill) {
    if (!preg_match('/^[A-Za-z0-9 ]{1,50}$/', $skill)) {
        $errors[] = 'Invalid skill value.';
    }
}

// Display any errors caught
if ($errors) {
    echo "<h2>Submission Errors</h2><ul>";
    foreach ($errors as $e) {
        echo "<li>" . htmlspecialchars($e, ENT_QUOTES, 'UTF-8') . "</li>";
    }
    echo "</ul><p><a href=\"apply.php\">Go back to form</a></p>";
    exit;
}

// Prepare and execute insert
$insertSQL = "INSERT INTO eoi (
    job_ref, first_name, last_name, dob, gender,
    street, suburb, state, postcode,
    email, phone,
    skill1, skill2, skill3, skill4, skill5,
    other_skills, status
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";

$stmt = $conn->prepare($insertSQL);
if (!$stmt) {
    die("SQL error: " . $conn->error);
}

// Pad skills to 5 entries
$sk = array_pad($skills_arr, 5, null);

$stmt->bind_param(
    str_repeat('s', 17),
    $job_ref, $first_name, $last_name, $dob, $gender,
    $street, $suburb, $state, $postcode,
    $email, $phone,
    $sk[0], $sk[1], $sk[2], $sk[3], $sk[4],
    $other_skills
);

$stmt->execute();

if ($stmt->error) {
    die("Insert failed: " . $stmt->error);
}

// Provide confirmation to user
$eoiId = $stmt->insert_id;
echo "<h2>Thank you!</h2><p>Your application has been recorded. Your EOI number is <strong>#{$eoiId}</strong>.</p>";

$stmt->close();
$conn->close();
?>
