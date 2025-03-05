<?php
$host = 'localhost';
$dbname = 'health_project';
$username = 'root';
$password = '';

// Establish a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>