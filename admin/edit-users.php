<?php
session_start();

require_once 'db_connect.php'; // Include your database connection file
$db = getDbConnection();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Handle user update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editUser'])) {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Consider validating the password strength

    // Update user details
    if (!empty($username) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $stmt->execute([$username, $hashedPassword, $userId]);
    }
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $userId = $_POST['userId'];

    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);
}

// Fetch all users
$stmt = $db->prepare("SELECT id, username FROM users ORDER BY username ASC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Users</title>
</head>
<body>
    <h1>Edit Users</h1>
    
    <?php foreach ($users as $user): ?>
    <form action="edit-users.php" method="post">
        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
        Username: <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        Password: <input type="password" name="password" placeholder="New password">
        <button type="submit" name="editUser">Save Changes</button>
        <button type="submit" name="deleteUser" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</button>
    </form>
    <?php endforeach; ?>

    <a href="homepage.php">Back to homepage</a>
</body>
</html>
