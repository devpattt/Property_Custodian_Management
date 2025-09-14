<?php
$host = 'localhost';
$dbname = 'bcp_sms4_pcm';
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, asset, report_type, reported_by, date_reported, status FROM bcp_sms4_reports ORDER BY date_reported DESC");
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $reports = []; 
}
?>
