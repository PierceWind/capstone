<?php
// Database configuration
$servername = "localhost";  // Replace with your database server name
$username = "root";  // Replace with your database username
$password = "xoxad";  // Replace with your database password
$dbname = "capstone";  // Replace with your database name

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
$conn->set_charset("utf8");
