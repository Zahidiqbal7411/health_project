<?php

// Database connection variables
$_localhost = 'localhost';
$_name = 'root';
$_password = '';
$_db_name = 'student_registration_project';

// Establishing the connection
$conn = mysqli_connect($_localhost, $_name, $_password, $_db_name);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connection successful!";
}

?>
