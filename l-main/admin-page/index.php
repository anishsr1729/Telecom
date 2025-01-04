<?php
require "./connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'] ?? null;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'] ?? null;  // Get category if set
    
    if (empty($product_id)) {
        $sql = "INSERT INTO products (name, description, price, stock, category) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdis", $name, $description, $price, $stock, $category);
        $stmt->execute();
        echo "New product added successfully!";
    } else {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, stock = ?, category = ? WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdisi", $name, $description, $price, $stock, $category, $product_id);
        $stmt->execute();
        echo "Product updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <style media="screen">
        label {
            display: block;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value="" selected hidden>Category</option>
            <option value="electronics">Electronics</option>
            <option value="clothing">Clothing</option>
            <option value="books">Books</option>
            <option value="other">Other</option>
        </select>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="price">Cost:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
