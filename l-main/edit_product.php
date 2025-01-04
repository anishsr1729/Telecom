<?php
include('db.php'); // Include your DB connection

// Get the product ID from the URL
$product_id = $_GET['product_id'];

// Fetch the product data from the database
$sql = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// If product does not exist
if (!$product) {
    echo "Product not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <header>
        <h1>Edit Product</h1>
    </header>

    <main>
        <form action="process_product.php" method="POST">
            <!-- Hidden input for product ID -->
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $product['name']; ?>" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required><?php echo $product['description']; ?></textarea><br>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="<?php echo $product['price']; ?>" step="0.01" required><br>

            <label for="stock">Stock Quantity:</label>
            <input type="number" name="stock" id="stock" value="<?php echo $product['stock']; ?>" required><br>

            <input type="submit" value="Update Product">
        </form>
    </main>
</body>
</html>
