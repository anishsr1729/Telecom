<?php
include 'db_connection.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        // Add Product
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $stock_level = intval($_POST['stock_level']);
        $reorder_point = intval($_POST['reorder_point']);

        $query = "INSERT INTO Products (name, description, stock_level, reorder_point) VALUES ('$name', '$description', $stock_level, $reorder_point)";
        if ($conn->query($query)) {
            echo "Product added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif (isset($_POST['delete_id'])) {
        // Delete Product
        $delete_id = intval($_POST['delete_id']);
        $query = "DELETE FROM Products WHERE id = $delete_id";
        if ($conn->query($query)) {
            echo "Product deleted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Fetch all products
$query = "SELECT * FROM Products";
$result = $conn->query($query);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Manage Products</h1>
    <!-- Add Product Form -->
    <form action="" method="POST">
        <input type="hidden" name="action" value="add">
        <label>Product Name:</label>
        <input type="text" name="name" required>
        <label>Description:</label>
        <input type="text" name="description" required>
        <label>Stock Level:</label>
        <input type="number" name="stock_level" required>
        <label>Reorder Point:</label>
        <input type="number" name="reorder_point" required>
        <button type="submit">Add Product</button>
    </form>

    <!-- Product List -->
    <h2>Product List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Stock Level</th>
            <th>Reorder Point</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['id']) ?></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= htmlspecialchars($product['stock_level']) ?></td>
            <td><?= htmlspecialchars($product['reorder_point']) ?></td>
            <td>
                <form action="" method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($product['id']) ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
