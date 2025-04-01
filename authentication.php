<?php
// check_login.php

// Assume you have a session variable indicating user login status
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
    echo json_encode(array('status' => 'success', 'action' => 'logout'));
} else {
    // User is not logged in
    echo json_encode(array('status' => 'success', 'action' => 'login'));
}
?>