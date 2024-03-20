<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "You must be logged in as an admin to access this page.";
    exit; // Stop script execution if not an admin
}

require_once 'db_connect.php'; // Include the database connection

$db = getDbConnection(); // Get the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = 'employee'; // Set role to employee for this script

    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the INSERT statement
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$username, $hashedPassword, $role]);
            $success = "Employee account created successfully.";
        } catch (PDOException $e) {
            $error = "Error creating account: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Employee Account</title>
</head>
<body>
    <h2>Register Employee Account</h2>
    <?php if (!empty($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="admin-register.php" method="post">
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
