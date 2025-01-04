<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page - Product Management</title>
    <style>
        /* Existing styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            color: #333;
        }
 
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: #fff;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
 
        .logo {
            font-size: 1.5em;
            font-weight: bold;
            display: flex;
            align-items: center;
            cursor: pointer;
            animation: fadeInLeft 1s;
        }
 
        .right-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
 
        .menu-item {
            position: relative;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 20px;
            transition: background 0.3s ease, color 0.3s ease;
            animation: fadeInRight 1s;
        }
 
        /* New styles for product management */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
 
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
 
        .products-table th, .products-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
 
        .products-table th {
            background: #f8f9fa;
            font-weight: bold;
        }
 
        .products-table tr:hover {
            background: #f5f5f5;
        }
 
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
 
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="logo">Telecom<span style="color: #cce7ff">Titans</span></div>
        <div class="right-menu">
            <div class="menu-item">
                <i class="fas fa-user-circle"></i> Profile
            </div>
            <div class="menu-item">
                <i class="fas fa-cog"></i> Settings
            </div>
            <div class="menu-item">
                <i class="fas fa-sign-out-alt"></i> Logout
            </div>
        </div>
    </div>
 
    <!-- Product Management Container -->
    <div class="container">
        <h2>Available Products</h2>
       
        <!-- Products Table -->
        <table class="products-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody id="productsTableBody">
                <!-- Products will be inserted here -->
            </tbody>
        </table>
    </div>
 
    <script>
        // Store products in localStorage
        let products = JSON.parse(localStorage.getItem('products')) || [];
 
        // Display products in table
        function displayProducts() {
            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = '';
 
            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td>${product.category}</td>
                    <td>$${product.price.toFixed(2)}</td>
                    <td>${product.stock}</td>
                `;
                tableBody.appendChild(row);
            });
        }
 
        // Initial display of products
        displayProducts();
    </script>
</body>
</html>
