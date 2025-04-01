<?php
// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    // If not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Retrieve the user's email from the session
$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($email); ?>!</h1>
    <p>This is a secure page accessible only to authenticated users.</p>
    
    <!-- Add more content or features as needed -->

    <a href="logout.php">Logout</a>
</body>
</html>