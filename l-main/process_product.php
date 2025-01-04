<?php
include('db.php'); // Include your DB connection

// Check if the form is being submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // If product_id is empty, we are adding a new product
    if (empty($product_id)) {
        // Prepare SQL to insert new product
        $sql = "INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $name, $description, $price, $stock);
        $stmt->execute();

        echo "New product added successfully!";
    } else {
        // Prepare SQL to update existing product
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdis", $name, $description, $price, $stock, $product_id);
        $stmt->execute();

        echo "Product updated successfully!";
    }
}
?>
