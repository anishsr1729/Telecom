<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "telecom_inventory_management"; 
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the telecom_inventory_management database.";
}

// If you need to close the connection at the end
$conn->close();
?>
