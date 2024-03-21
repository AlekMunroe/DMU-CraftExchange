<?php
// Enable error reporting for debugging - remove in production
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once 'admin/db_connect.php'; // Adjust this path as necessary
$db = getDbConnection();

try {
    $stmt = $db->query("SELECT notification_text, enabled FROM settings WHERE id = 1");
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($settings);
} catch (PDOException $e) {
    // Return an error as JSON
    echo json_encode(['error' => $e->getMessage()]);
}
