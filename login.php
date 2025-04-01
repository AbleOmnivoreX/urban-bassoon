<?php
// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the user input (you may want to perform more validation)
    if (empty($email) || empty($password)) {
        // Handle validation errors or redirect back to the login page with an error message
        header("Location: login.html?error=Please fill in all fields");
        exit();
    }

    // Replace these values with your actual database credentials
    $servername = "sql304.infinityfree.com";
    $username = "if0_35562001";
    $db_password = "U47sAgvuneU";
    $dbname = "if0_35562001_dbase";

    // Create a database connection
    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM ccustomers WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        // Set session variables
        $_SESSION["email"] = $email;

        // You may want to set other session variables based on your application's needs
        // Example: $_SESSION["user_id"] = $user_id;

        // Redirect to the dashboard or another secure page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        // Redirect back to the login page with an error message
        header("Location: login.html?error=Invalid email or password");
        exit();
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: login.html");
    exit();
}
?>