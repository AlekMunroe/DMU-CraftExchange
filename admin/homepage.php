<?php
session_start();

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Logout action
if (isset($_POST['logout'])) {
    // Destroy the session and redirect to login page
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
</head>
<body>
    <h1>Welcome to the Homepage</h1>
    <p>You are logged in as <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>
    
    <!-- Logout form -->
    <form action="homepage.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    
    <!-- Button to redirect to admin/database.php -->
    <form action="/admin/database.php" method="get">
        <button type="submit">Manage Items</button>
    </form>

    <form action="/admin/notification-edit.php" method="get">
        <button type="submit">Edit Notification</button>
    </form>
    
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <!-- Buttons visible only for admin -->
        <form action="register.php" method="get">
            <button type="submit">Register Admin Account</button>
        </form>
        
        <form action="/admin/admin-register.php" method="get">
            <button type="submit">Register Employee Account</button>
        </form>

        <form action="/admin/edit-users.php" method="get">
            <button type="submit">Edit Accounts</button>
        </form>
    <?php endif; ?>
</body>
</html>
