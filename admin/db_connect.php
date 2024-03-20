<?php
// db_connect.php
function getDbConnection() {
    $host = 'HOST';
    $dbname = 'DATABASE';
    $user = 'USERNAME';
    $password = 'PASSWORD';
    $port = 'PORT';
    $dsn = "DSN"; // Connection details

    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        exit("Connection failed: " . $e->getMessage());
    }
}
