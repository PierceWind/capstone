<?php
// Database configuration
$servername = "localhost";  // Replace with your database server name
$username = "root";  // Replace with your database username
$password = "xoxad";  // Replace with your database password
$dbname = "capstone";  // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Rest of your code here

?>
