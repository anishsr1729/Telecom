<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: login.php");
    exit;
}
include 'db_connection.php';

// Fetch data for the dashboard
$products_count = $conn->query("SELECT COUNT(*) AS total FROM Products")->fetch_assoc()['total'];
$orders_count = $conn->query("SELECT COUNT(*) AS total FROM Orders")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <div class="card">
        <h3>Total Products</h3>
        <p><?php echo $products_count; ?></p>
    </div>
    <div class="card">
        <h3>Total Orders</h3>
        <p><?php echo $orders_count; ?></p>
    </div>
    <a href="add_product.php">Add New Product</a>
    <a href="logout.php">Logout</a>
</body>
</html>