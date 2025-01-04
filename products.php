<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adding a product
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        // Get input values and sanitize them
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $stock_level = intval($_POST['stock_level']);
        $reorder_point = intval($_POST['reorder_point']);

        // Insert new product into the database
        $query = "INSERT INTO Products (name, description, stock_level, reorder_point) 
                  VALUES ('$name', '$description', $stock_level, $reorder_point)";
        if ($conn->query($query)) {
            echo "Product added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    // Deleting a product
    elseif (isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']);
        $query = "DELETE FROM Products WHERE id = $delete_id";
        if ($conn->query($query)) {
            echo "Product deleted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Fetch all products from the database
$query = "SELECT * FROM Products";
$result = $conn->query($query);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "No products found.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
            margin-bottom: 30px;
            background: #fafafa;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        form label {
            flex: 1 1 150px;
            font-weight: bold;
        }
        form input, form button {
            flex: 2 1 300px;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        form button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        table td {
            color: #555;
        }
        button.delete-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        button.delete-btn:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>
    <div class="container">
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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Stock Level</th>
                    <th>Reorder Point</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
