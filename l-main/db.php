<?php
// Set up the database connection
$servername = "http://127.0.0.1:5500/"; // Database host
$username = "root"; // Database username
$password = "Hemanth@123"; // Database password
$dbname = "StudentDB"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
