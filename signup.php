<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $name = $_POST["name"];
    $country = $_POST["country"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $password = $_POST["password"];

    // Validate the user input (you may want to perform more validation)
    if (empty($name) || empty($country) || empty($email) || empty($phone) || empty($dob) || empty($password)) {
        // Handle validation errors or redirect back to the signup page with an error message
        header("Location: signup.html?error=Please fill in all fields");
        exit();
    }

    // Replace these values with your actual database credentials
    $servername = "sql304.infinityfree.com";
    $username = "if0_35562001";
    $password = "U47sAgvuneU";
    $dbname = "if0_35562001_dbase";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // For demonstration purposes, you can use a simple SQL query to insert user data.
    // Replace this with your actual database insert logic (e.g., prepared statements).
    $query = "INSERT INTO ccustomers (name, country, email, phone, dob, password) VALUES ('$name', '$country', '$email', '$phone', '$dob', '$password')";
    $result = $conn->query($query);

    if ($result) {
        // Successful signup
        // You may want to set session variables, redirect to a dashboard, etc.
        echo "Signup successful!";
    } else {
        // Signup failed
        // Redirect back to the signup page with an error message
        header("Location: signup.html?error=Signup failed");
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted, redirect to the signup page
    header("Location: signup.html");
    exit();
}
?>