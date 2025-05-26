<?php
$pageTitle = "Job Descriptions";
include "header.inc";

require_once "settings.php"; // Your DB connection details
$conn = db_connect();

$sql = "SELECT * FROM jobs ORDER BY job_code";
$result = $conn->query($sql);

if (!$result) {
    die("Database query failed: " . $conn->error);
}
?>

<aside class="side-shortcuts">
    <p><a href="#">Back to top</a></p>
    <?php
    // Navigation links to each job
    while ($job = $result->fetch_assoc()) {
        $anchor = strtolower(preg_replace('/\s+/', '', $job['job_title']));
        echo "<p><a href='#$anchor'>{$job['job_title']}</a></p>";
    }
    // Reset pointer to fetch rows again below
    $result->data_seek(0);
    ?>
</aside>

<main>
    <?php while ($job = $result->fetch_assoc()): 
        $anchor = strtolower(preg_replace('/\s+/', '', $job['job_title']));
        $responsibilities = json_decode($job['responsibilities']);
        $required_skills = json_decode($job['required_skills']);
        $preferred_qualifications = json_decode($job['preferred_qualifications']);
        $benefits = json_decode($job['benefits']);
    ?>
    <section id="<?php echo $anchor; ?>">
        <h2><?php echo htmlspecialchars($job['job_code']) . " - " . htmlspecialchars($job['job_title']); ?></h2>
        <h3>Salary Range</h3>
        <p><?php echo htmlspecialchars($job['salary_range']); ?></p>
        <h3>Overview</h3>
        <p><?php echo nl2br(htmlspecialchars($job['overview'])); ?></p>

        <h3>Key Responsibilities</h3>
        <ol>
            <?php foreach ($responsibilities as $item): ?>
                <li><?php echo htmlspecialchars($item); ?></li>
            <?php endforeach; ?>
        </ol>

        <h3>Required Skills & Experience</h3>
        <ul>
            <?php foreach ($required_skills as $skill): ?>
                <li><?php echo htmlspecialchars($skill); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>Preferred Qualifications</h3>
        <ul>
            <?php foreach ($preferred_qualifications as $qual): ?>
                <li><?php echo htmlspecialchars($qual); ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>What You'll Get</h3>
        <ul>
            <?php foreach ($benefits as $benefit): ?>
                <li><?php echo htmlspecialchars($benefit); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
    <hr>
    <?php endwhile; ?>
</main>

<?php include "footer.inc"; ?>
