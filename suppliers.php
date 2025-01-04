<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connection.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        // Add Supplier
        $name = $conn->real_escape_string($_POST['name']);
        $contact_name = $conn->real_escape_string($_POST['contact_name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone_number = isset($_POST['phone_number']) ? $conn->real_escape_string($_POST['phone_number']) : null;
        $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : null;

        // Basic input validation (you can add more as needed)
        if (empty($name) || empty($contact_name) || empty($email)) {
            echo "Please fill in all required fields.";
        } else {
            $query = "INSERT INTO suppliers (name, contact_name, email, phone_number, address) 
                      VALUES ('$name', '$contact_name', '$email', '$phone_number', '$address')";
            if ($conn->query($query)) {
                echo "Supplier added successfully.";
            } else {
                echo "Error: " . $conn->error . " Query: " . $query;
            }
        }
    } elseif (isset($_POST['delete_id'])) {
        // Delete Supplier
        $delete_id = intval($_POST['delete_id']);
        $query = "DELETE FROM suppliers WHERE id = $delete_id";
        if ($conn->query($query)) {
            echo "Supplier deleted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Fetch all suppliers
$query = "SELECT * FROM suppliers";
$result = $conn->query($query);
$suppliers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $suppliers[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Suppliers</title>
</head>
<body>
    <h1>Manage Suppliers</h1>
    
    <!-- Add Supplier Form -->
    <form action="" method="POST">
        <input type="hidden" name="action" value="add">
        <label>Supplier Name:</label>
        <input type="text" name="name" required>
        <label>Contact Name:</label>
        <input type="text" name="contact_name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Phone Number:</label>
        <input type="text" name="phone_number">
        <label>Address:</label>
        <textarea name="address"></textarea>
        <button type="submit">Add Supplier</button>
    </form>

    <!-- Supplier List -->
    <h2>Supplier List</h2>
    
    <?php if (count($suppliers) == 0): ?>
        <p>No suppliers found.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= htmlspecialchars($supplier['id']) ?></td>
                <td><?= htmlspecialchars($supplier['name']) ?></td>
                <td><?= htmlspecialchars($supplier['contact_name']) ?></td>
                <td><?= htmlspecialchars($supplier['email']) ?></td>
                <td><?= htmlspecialchars($supplier['phone_number']) ?></td>
                <td><?= htmlspecialchars($supplier['address']) ?></td>
                <td>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?= htmlspecialchars($supplier['id']) ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
