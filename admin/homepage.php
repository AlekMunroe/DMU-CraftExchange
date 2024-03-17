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
</body>
</html>
