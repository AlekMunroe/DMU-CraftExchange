<?php
session_start();

// Redirect if not logged in or not the correct role
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'employee')) {
    header('Location: login.php');
    exit;
}

require_once 'db_connect.php'; // Assume this file returns a PDO connection as $db
$db = getDbConnection();

// Ensure the settings table exists
$db->exec("CREATE TABLE IF NOT EXISTS settings (
    id SERIAL PRIMARY KEY,
    notification_text TEXT NOT NULL,
    enabled BOOLEAN NOT NULL
)");

// Check if the initial settings row exists, and if not, insert it
$checkExist = $db->query("SELECT id FROM settings LIMIT 1");
if ($checkExist->fetch() === false) {
    $db->exec("INSERT INTO settings (notification_text, enabled) VALUES ('Enter your notification here', false)");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notification_text'], $_POST['enabled'])) {
    $notificationText = $_POST['notification_text'];
    $enabled = isset($_POST['enabled']) ? ($_POST['enabled'] === '1' ? 'true' : 'false') : 'false';

    $stmt = $db->prepare("UPDATE settings SET notification_text = ?, enabled = ? WHERE id = 1");
    $stmt->execute([$notificationText, $enabled]);

    header('Location: notification-edit.php'); // Redirect to avoid form resubmission issues
    exit;
}


// Retrieve current settings
$stmt = $db->prepare("SELECT notification_text, enabled FROM settings WHERE id = 1");
$stmt->execute();
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notification</title>
    <!-- Add your stylesheet links here -->

    <style>
        textarea#notification_text {
        width: 50%; /* This will make it take the full width of its parent */
        height: 100px; /* This sets the height. Adjust as needed. */
        }
    </style>
</head>
<body>
    <h1>Edit Notification</h1>
    <form action="notification-edit.php" method="post">
        <label for="notification_text">Notification Text:</label>
        <br>
        <textarea id="notification_text" name="notification_text" required><?= htmlspecialchars($settings['notification_text']) ?></textarea>
        <br>
        <label for="enabled">Enabled:</label>
        <select id="enabled" name="enabled">
            <option value="1" <?= $settings['enabled'] ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= !$settings['enabled'] ? 'selected' : '' ?>>No</option>
        </select>
        <br>
        <button type="submit">Save Changes</button>
    </form>

    <a href="homepage.php">Back to homepage</a>
</body>
</html>
