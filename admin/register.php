<?php
// Include the database connection file
require_once 'db_connect.php';

// Get the database connection
$db = getDbConnection();

try {
    // Create the users table if it does not exist
    $query = "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password TEXT NOT NULL,
        role VARCHAR(50) NOT NULL
    )";
    $db->exec($query);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = 'admin'; // Default role for this script

    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the INSERT statement
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $hashedPassword, $role]);
            echo "Admin account created successfully.";
        } catch (PDOException $e) {
            echo "Error creating account: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Admin Account</title>
</head>
<body>
    <h2>Register Admin Account</h2>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Register">
    </form>

    <a href="homepage.php">Back to homepage</a>
</body>
</html>
