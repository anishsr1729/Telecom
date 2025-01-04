<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "Stock1"; // Updated to use the 'Stock' database
$port = 3306; // Optional if you're using the default MySQL port

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the Stock database.";
}
?>
