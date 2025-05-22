huh445
huh445
Sharing their screen

GamethanVS — 10:45
None of the other 2 group members r there
And I'm leaving now so
huh445 — 19:55
not a bad game frhttps://store.steampowered.com/app/893680/Project_Warlock/
Steam
Project Warlock
One man and his guns. Become a mysterious Warlock who embarks on a dangerous mission to eradicate all evil. Put your finger on the trigger and travel through time and space to wreak havoc like in the golden days of fast-paced, adrenaline-pumping first-person shooters, hooking you for hours of super fun carnage. Let’s rock and roll!



Exp…
Price
$1.20
Recommendations
3906
Metacritic
78
huh445 — 20:20
im gonna withdraw from busdig
GamethanVS — 20:20
ight
huh445 — 20:23
nvm i cant
GamethanVS — 20:23
to late?
huh445 — 20:23
yeah
GamethanVS — 20:24
rip
huh445 — 20:24
time to fucking lock in ig
GamethanVS — 20:24
also im stupid we dont have the test tomorrow its next week
huh445 — 20:24
yeah i figured that out
the group project is due tomorrow
GamethanVS — 20:24
yh ik L
huh445 — 20:24
have you done it
GamethanVS — 20:24
doing my part rn
im still going in tomorrow cuz i gotta ask if i can do it another day next week cuz i dont want to take 2 shifts off 2 weeks in a row on the same day
huh445 — 20:25
isnt it an online test?
GamethanVS — 20:26
so was the first one but we needed a code to start it
which i take was givin in class
huh445 — 20:30
i might just take the fail
GamethanVS — 20:30
lmao
huh445 — 20:30
tbh
‘At risk’ notifications
Why have I received an 'at risk' notification?

If we think that you’re having difficulties with your studies, we may send you an email to notify you that you’re at risk of falling below Swinburne’s academic standards. This is known as an 'at risk' notification.

If you’re a part-time local student:

    you failed more than 50% of your enrolled units, credit points or scheduled hours in any one progress review period (this includes a Withdrawn Fail or WF – withdrawing after the census date) and/or
    you failed an enrolled unit (or its equivalent) for a second time.

If you’re a full-time local or international student:

    you failed 50% or more of your enrolled units, credit points or scheduled hours in any one progress review period (this includes WF) and/or
    you failed an enrolled unit (or its equivalent) for a second time.

If you’re an ELICOS student, you failed your ELICOS unit for the first time.

If you’re a Professional Degree student you have special academic progress requirements. Check the 'course rules and special requirements' link on your course page for more details.
GamethanVS — 20:31
will you have to take the class again?
huh445 — 20:32
nah
i can take a different class as long as i hit my credit points
GamethanVS — 20:32
oh w
huh445 — 20:32
and ill pass everything else
GamethanVS — 20:32
fair
huh445 — 20:33
what do we do for web tech btw
GamethanVS — 20:33
i was about to talk about that
so basically, the teacher said the other 2 havnt shown up for the classes aswell, and since no one has said anything in the gc, i take it no one has done anything
its due monday, and the indivdual thingy is due tuesday like last time
i havnt looked at anything, cuz i just got back from doin stuff, and im gonna finish the bus dig stuff first
jusy get that done with
huh445 — 20:35
call me when you wanna work on the web tech
imma get a jumpstart
GamethanVS — 20:35
ight cool
GamethanVS
 started a call. — 21:55
huh445 — 21:57
https://github.com/huh445/CodeCraftersCollective_Part-1/tree/unstable
GitHub
GitHub - huh445/CodeCraftersCollective_Part-1 at unstable
This Repo is for all the files that are being worked on and used for Our teams Web technology project - GitHub - huh445/CodeCraftersCollective_Part-1 at unstable
This Repo is for all the files that are being worked on and used for Our teams Web technology project - GitHub - huh445/CodeCraftersCollective_Part-1 at unstable
https://x.com/kanyewest
xampp
huh445 — 22:13
C:\xampp\php
php -S localhost:8000
huh445 — 22:22
echo $Env:Path
huh445 — 22:30
RESTART COMPUTER
https://localhost:8000/
huh445 — 22:51
`
GamethanVS — 22:51
``````
<?php
// process_eoi.php

// Only handle POST submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit;
}

require_once __DIR__ . '/settings.php';
$conn = db_connect();

// Create table if it doesn't exist
$createSQL = "
CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(10) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
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
    status ENUM('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";
$conn->query($createSQL);

// Helper: sanitize input
function clean($data) {
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Collect and sanitize
$job_ref      = clean($_POST['job-ref'] ?? '');
$first_name   = clean($_POST['first-name'] ?? '');
$last_name    = clean($_POST['last-name'] ?? '');
$dob          = clean($_POST['dob'] ?? '');
$gender       = clean($_POST['gender'] ?? '');
$street       = clean($_POST['address'] ?? '');
$suburb       = clean($_POST['suburb'] ?? '');
$state        = clean($_POST['state'] ?? '');
$postcode     = clean($_POST['postcode'] ?? '');
$email        = clean($_POST['email'] ?? '');
$phone        = clean($_POST['phone'] ?? '');
$skills_arr   = $_POST['skills'] ?? [];
$other_skills = clean($_POST['other-skills'] ?? '');

$errors = [];

// Validation rules
if (empty($job_ref)) {
    $errors[] = 'Job reference is required.';
}
if (!preg_match('/^[A-Za-z]{1,20}$/', $first_name)) {
    $errors[] = 'First name must be alpha, max 20 chars.';
}
if (!preg_match('/^[A-Za-z]{1,20}$/', $last_name)) {
    $errors[] = 'Last name must be alpha, max 20 chars.';
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dob)) {
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
... (60 lines left)
Collapse
message.txt
5 KB
﻿
<?php
// process_eoi.php

// Only handle POST submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit;
}

require_once __DIR__ . '/settings.php';
$conn = db_connect();

// Create table if it doesn't exist
$createSQL = "
CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(10) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
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
    status ENUM('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";
$conn->query($createSQL);

// Helper: sanitize input
function clean($data) {
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Collect and sanitize
$job_ref      = clean($_POST['job-ref'] ?? '');
$first_name   = clean($_POST['first-name'] ?? '');
$last_name    = clean($_POST['last-name'] ?? '');
$dob          = clean($_POST['dob'] ?? '');
$gender       = clean($_POST['gender'] ?? '');
$street       = clean($_POST['address'] ?? '');
$suburb       = clean($_POST['suburb'] ?? '');
$state        = clean($_POST['state'] ?? '');
$postcode     = clean($_POST['postcode'] ?? '');
$email        = clean($_POST['email'] ?? '');
$phone        = clean($_POST['phone'] ?? '');
$skills_arr   = $_POST['skills'] ?? [];
$other_skills = clean($_POST['other-skills'] ?? '');

$errors = [];

// Validation rules
if (empty($job_ref)) {
    $errors[] = 'Job reference is required.';
}
if (!preg_match('/^[A-Za-z]{1,20}$/', $first_name)) {
    $errors[] = 'First name must be alpha, max 20 chars.';
}
if (!preg_match('/^[A-Za-z]{1,20}$/', $last_name)) {
    $errors[] = 'Last name must be alpha, max 20 chars.';
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dob)) {
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
// Limit and sanitize skills
$skills_arr = array_slice($skills_arr, 0, 5);
foreach ($skills_arr as $skill) {
    if (!preg_match('/^[A-Za-z0-9 ]{1,50}$/', $skill)) {
        $errors[] = 'Invalid skill value.';
    }
}

// Display errors if any
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
    job_ref, first_name, last_name,
    street, suburb, state, postcode,
    email, phone,
    skill1, skill2, skill3, skill4, skill5,
    other_skills, status
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";
$stmt = $conn->prepare($insertSQL);

// Pad skills to 5 entries
$sk = array_pad($skills_arr, 5, null);

$stmt->bind_param(
    str_repeat('s', 15),
    $job_ref, $first_name, $last_name,
    $street, $suburb, $state, $postcode,
    $email, $phone,
    $sk[0], $sk[1], $sk[2], $sk[3], $sk[4],
    $other_skills
);

$stmt->execute();

// Confirmation message
$eoiId = $stmt->insert_id;
echo "<h2>Thank you!</h2><p>Your application has been recorded. Your EOI number is <strong>#{$eoiId}</strong>.</p>";

$stmt->close();
$conn->close();
?>