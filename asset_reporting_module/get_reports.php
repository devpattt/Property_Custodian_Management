<?php
$host = 'localhost';
$dbname = 'bcp_sms4_pcm';
$username = 'root';
$password = '';

if (isset($_GET['id'])) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM bcp_sms4_reports WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $report = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($report) {
            echo '<div class="card border-0 shadow-sm">';
            echo '<div class="card-body">';
            echo '<table class="table table-bordered">';
            echo '<tr><th>Item Name</th><td>' . htmlspecialchars($report['asset']) . '</td></tr>';
            echo '<tr><th>Report Type</th><td>' . htmlspecialchars($report['report_type']) . '</td></tr>';
            echo '<tr><th>Reported By</th><td>' . htmlspecialchars($report['reported_by']) . '</td></tr>';
            echo '<tr><th>Date Reported</th><td>' . htmlspecialchars($report['date_reported']) . '</td></tr>';
            echo '<tr><th>Status</th><td><span class="badge bg-primary">' . htmlspecialchars($report['status']) . '</span></td></tr>';
            if (!empty($report['description'])) {
                echo '<tr><th>Description</th><td>' . nl2br(htmlspecialchars($report['description'])) . '</td></tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "<div class='alert alert-warning'>No report found.</div>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
