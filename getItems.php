<?php
// Include the database connection file
require_once 'admin/db_connect.php';

// Get the database connection from the db_connect.php file
$db = getDbConnection();

// Prepare and execute the query with ORDER BY order_num
$query = $db->prepare("SELECT * FROM items ORDER BY order_num ASC");
$query->execute();
$items = $query->fetchAll(PDO::FETCH_ASSOC);

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($items);
