<?php
// Assuming your SQLite database is in admin/items_database.db
$dbPath = __DIR__ . '/admin/items_database.db';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Prepare and execute the query with ORDER BY order_num
$query = $db->prepare("SELECT * FROM items ORDER BY order_num ASC");
$query->execute();
$items = $query->fetchAll(PDO::FETCH_ASSOC);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($items);
