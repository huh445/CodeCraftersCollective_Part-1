<?php
$pageTitle = "Manager Dashboard";
include "header.inc";
require_once __DIR__ . "/settings.php";

$conn = db_connect();

// Function to get EOIs based on an optional search term
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

// Function to delete EOIs by job ref
function delEOIs($conn, $searchTerm = '') {
    if ($searchTerm !==  '') {
        $searchTerm = $conn->real_escape_string(trim($searchTerm));
        $sql = "DELETE FROM eoi WHERE job_ref LIKE '%$searchTerm%'";
        return $conn->query($sql);
    }
    return false;
}

// Handle delete if GET parameter exists
if (isset($_GET['delete_job_ref'])) {
    $deleted = delEOIs($conn, $_GET['delete_job_ref']);
    if ($deleted) {
        echo "<p>Deleted EOIs matching '" . htmlspecialchars($_GET['delete_job_ref']) . "'</p>";
    } else {
        echo "<p>Error deleting EOIs.</p>";
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

    <!-- Delete form without confirmation -->
    <form style="margin-top: 20px;">
        <input type="text" id="deleteInput" placeholder="Delete EOIs by job ref">
        <button type="button" onclick="
            const val = document.getElementById('deleteInput').value.trim();
            if(val) {
                window.location.href = '?delete_job_ref=' + encodeURIComponent(val);
            }
        ">Delete</button>
    </form>

    <!-- Results table -->
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>EOInumber</th>
                <th>Job Ref</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address ID</th>
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
                <td><?php echo htmlspecialchars($row['address_id']); ?></td>
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
