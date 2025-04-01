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
        header("Location: login.php?error=Please fill in all fields");
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
        header("Location: login.php?error=Invalid email or password");
        exit();
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, display the HTML login form
    include 'header.php'; // Include any common header code if you have one
    ?>

    <!-- Paste your HTML code here -->
    <!DOCTYPE html>

<!-- Section - 1 -->
<!--
// WEBSITE: https://AbleOmnivoreX.com
// TWITTER: https://twitter.com/AbleOmnivoreX
// FACEBOOK: https://www.facebook.com/AbleOmnivoreX
// GITHUB: https://github.com/AbleOmnivoreX/
-->

<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title>AbleOmnivoreX | E-commerce</title>
    
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Constra HTML Template v1.0">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    
    <!-- Themefisher Icon font -->
    <link rel="stylesheet" href="plugins/themefisher-font/style.css">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    
    <!-- Animate css -->
    <link rel="stylesheet" href="plugins/animate/animate.css">
    
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick/slick-theme.css">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<!-- Section - 2 -->
<body id="body">
    <section class="signin-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="block text-center">
                        <a class="logo" href="1.1.0_home.html">
                            <img src="images/logo.png" alt="">
                        </a>
                        <h2 class="text-center">Welcome Back</h2>
                        <form class="text-left clearfix" method="post" action="login.php">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-main text-center">Login</button>
                            </div>
                        </form>
                        <p class="mt-20">New in this site ?<a href="signup.html"> Create New Account</a></p>
                        <p class="mt-20">Forgot your password ?<a href="reset-pass.html"> Reset Password</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Essential Scripts
    =====================================-->
    <!-- Main jQuery -->
    <script src="plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap Touchpin -->
    <script src="plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Instagram Feed Js -->
    <script src="plugins/instafeed/instafeed.min.js"></script>
    <!-- Video Lightbox Plugin -->
    <script src="plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
    <!-- Count Down Js -->
    <script src="plugins/syo-timer/build/jquery.syotimer.min.js"></script>
    <!-- slick Carousel -->
    <script src="plugins/slick/slick.min.js"></script>
    <script src="plugins/slick/slick-animation.min.js"></script>
    <!-- Google Mapl -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script type="text/javascript" src="plugins/google-map/gmap.js"></script>
    <!-- Main Js File -->
    <script src="js/script.js"></script>
</body>
</html>
    <!-- End of your HTML code -->

    <?php
    include 'footer.php'; // Include any common footer code if you have one
}
?>