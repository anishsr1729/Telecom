<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Page - Product Management</title>
    <style>
        /* Existing Styles */
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; }
        .top-bar { background: linear-gradient(135deg, #4b6cb7, #182848); color: #fff; padding: 10px 20px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; background: white; border-radius: 10px; }
        .product-form { display: grid; gap: 15px; }
        .form-group { display: grid; gap: 5px; }
        input, select, textarea { padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 20px; background: #4b6cb7; color: white; border: none; border-radius: 4px; }
        .products-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .products-table th, .products-table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .products-table th { background: #f8f9fa; font-weight: bold; }
        .products-table tr:hover { background: #f5f5f5; }
        .action-buttons .edit-btn { background: #4CAF50; color: white; }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="logo">Telecom<span style="color: #cce7ff">Titans</span></div>
        <div class="right-menu">
            <div class="menu-item">Profile</div>
            <div class="menu-item">Settings</div>
            <div class="menu-item">Logout</div>
        </div>
    </div>
    
    <!-- Product Management -->
    <div class="container">
        <h2>Product Management</h2>
        
        <!-- Product Form -->
        <form id="productForm" class="product-form">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" id="productName" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" required>
                    <option value="">Select Category</option>
                    <option value="Network Equipment">Network Equipment</option>
                    <option value="Mobile Devices">Mobile Devices</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Services">Services</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" rows="3"></textarea>
            </div>
            <button type="submit">Add Product</button>
        </form>
        
        <!-- Products Table -->
        <table class="products-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productsTableBody">
                <!-- Products will be listed here -->
            </tbody>
        </table>
    </div>

    <script>
        // Initialize products data (saved in localStorage or can be fetched from backend)
        let products = JSON.parse(localStorage.getItem('products')) || [];

        // Display Products in Table
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
                    <td class="action-buttons">
                        <button class="edit-btn" onclick="editProduct(${product.id})">Edit</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Edit Product (for Manager only)
        function editProduct(id) {
            const product = products.find(p => p.id === id);
            if (product) {
                document.getElementById('productName').value = product.name;
                document.getElementById('category').value = product.category;
                document.getElementById('price').value = product.price;
                document.getElementById('stock').value = product.stock;
                document.getElementById('description').value = product.description;
                
                // Remove the old product before updating
                products = products.filter(p => p.id !== id);
                localStorage.setItem('products', JSON.stringify(products));
                displayProducts();
            }
        }

        // Handle product form submission
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const product = {
                id: Date.now(),
                name: document.getElementById('productName').value,
                category: document.getElementById('category').value,
                price: parseFloat(document.getElementById('price').value),
                stock: parseInt(document.getElementById('stock').value),
                description: document.getElementById('description').value,
            };
            products.push(product);
            localStorage.setItem('products', JSON.stringify(products));
            displayProducts();
            this.reset();
        });

        // Initial display of products
        displayProducts();
    </script>
</body>
</html>
