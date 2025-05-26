<?php
$pageTitle = "Manager Dashboard";
include "header.inc";
require_once __DIR__ . "/settings.php";

$conn = db_connect();

// Search EOI's
function getEOIs($conn, $searchTerm = '') {
    if ($searchTerm !== '') {
        $searchTerm = $conn->real_escape_string(trim($searchTerm));
        $sql = "SELECT * FROM eoi WHERE job_ref LIKE '%$searchTerm%' OR first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM eoi";
    }
    
    $result = $conn->query($sql);
    if (!$result) {
        die("Database query failed: " . $conn->error);
    }
    
    $eoIs = [];
    while ($row = $result->fetch_assoc()) {
        $eoIs[] = $row;
    }
    return $eoIs;
}

// Delete EOI's
function delEOIs($conn, $searchTerm = '') {
    if ($searchTerm !== '') {
        $searchTerm = $conn->real_escape_string(trim($searchTerm));
        $sql = "DELETE FROM eoi WHERE job_ref LIKE '%$searchTerm%'";
        return $conn->query($sql);
    }
    return false;
}

// Change status of EOI's
function changeStatus($conn, $EOInumber = '', $newStatus = '') {
    if ($EOInumber !== '' && $newStatus !== '') {
        $EOInumber = $conn->real_escape_string(trim($EOInumber));
        $newStatus = $conn->real_escape_string(trim($newStatus));
        $sql = "UPDATE eoi SET status = '$newStatus' WHERE EOInumber LIKE '%$EOInumber%'";
        return $conn->query($sql);
    }
    return false;
}

// Handle delete via GET
if (isset($_GET['delete_job_ref'])) {
    $deleted = delEOIs($conn, $_GET['delete_job_ref']);
    if ($deleted) {
        echo "<p>Deleted EOIs matching '" . htmlspecialchars($_GET['delete_job_ref']) . "'</p>";
    } else {
        echo "<p>Error deleting EOIs.</p>";
    }
}

// Handle status change via GET
if (isset($_GET['change_status_eoinumber']) && isset($_GET['new_status'])) {
    $changed = changeStatus($conn, $_GET['change_status_eoinumber'], $_GET['new_status']);
    if ($changed) {
        echo "<p>Status updated successfully.</p>";
    } else {
        echo "<p>Error updating status.</p>";
    }
}

$searchTerm = $_GET['search'] ?? '';
$eoiList = getEOIs($conn, $searchTerm);
?>

<main>
    <!-- Search form -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search first or last name" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit">Search</button>
        <button type="button" onclick="window.location.href='?';">Clear</button>
    </form>

    <!-- Delete form -->
    <form style="margin-top: 20px;">
        <input type="text" id="deleteInput" placeholder="Delete EOIs by job ref">
        <button type="button" onclick="
            const val = document.getElementById('deleteInput').value.trim();
            if(val) {
                window.location.href = '?delete_job_ref=' + encodeURIComponent(val);
            }
        ">Delete</button>
    </form>

    <!-- Status change form -->
    <form style="margin-top: 20px;">
        <input type="text" id="statusEOInumber" placeholder="EOInumber to change status">

        <select id="newStatus">
            <option value="New">New</option>
            <option value="Current">Current</option>
            <option value="Final">Final</option>
        </select>

        <button type="button" onclick="
            const eoinum = document.getElementById('statusEOInumber').value.trim();
            const status = document.getElementById('newStatus').value;
            if(eoinum && status) {
                window.location.href = '?change_status_eoinumber=' + encodeURIComponent(eoinum) + '&new_status=' + encodeURIComponent(status);
            }
        ">Change Status</button>
    </form>


    <!-- Results table -->
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>EOInumber</th>
                <th>Job Ref</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skill 1</th>
                <th>Skill 2</th>
                <th>Skill 3</th>
                <th>Skill 4</th>
                <th>Skill 5</th>
                <th>Other Skills</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eoiList as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['EOInumber']); ?></td>
                <td><?php echo htmlspecialchars($row['job_ref']); ?></td>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                <td><?php echo htmlspecialchars(trim(($row['street'] ?? '') . ', ' .($row['suburb'] ?? '') . ', ' .($row['state'] ?? '') . ' ' .($row['postcode'] ?? '')));?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['skill1']); ?></td>
                <td><?php echo htmlspecialchars($row['skill2']); ?></td>
                <td><?php echo htmlspecialchars($row['skill3']); ?></td>
                <td><?php echo htmlspecialchars($row['skill4']); ?></td>
                <td><?php echo htmlspecialchars($row['skill5']); ?></td>
                <td><?php echo htmlspecialchars($row['other_skills']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include "footer.inc"; ?>
