<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email from the POST data
    $email = $_POST["email"];

    // Validate the email (you might want to add more validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Bad Request
        echo "Invalid email address.";
        exit();
    }

    // Database configuration
    $servername = "sql304.infinityfree.com";
    $username = "if0_35562001";
    $password = "U47sAgvuneU";
    $dbname = "if0_35562001_dbase";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        echo "Database connection failed: " . $conn->connect_error;
        exit();
    }

    // Insert the email into the database
    $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
    if ($conn->query($sql) === TRUE) {
        http_response_code(200); // OK
        echo "Email subscribed successfully.";
    } else {
        http_response_code(500); // Internal Server Error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo "Method not allowed.";
}
?>