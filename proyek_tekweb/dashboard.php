<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #343a40;
            color: #fff;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            color: #fff;
        }

        .nav-link:hover {
            color: #f8f9fa;
            text-decoration: underline;
        }

        .container {
            margin-top: 30px;
        }

        .card-header {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="logo">Admin Dashboard</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Admin Dashboard</h2>

        <!-- Add Category Section -->
        <section>
            <form class="POST" action="categoryadmin.php">
                <div class="card">
                <div class="card-header">Add New Category</div>
                <div class="card-body">
                    <form action="add_category.php" method="POST">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
            </form>
        </section>

        <!-- Add Product Section -->
        <section class="mt-5">
            <div class="card">
                <div class="card-header">Add New Product</div>
                <form class="POST" action="categoryadmin.php">
                    <div class="card-body">
                    <form action="add_product.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Product Price</label>
                            <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="productCategory">Product Category</label>
                            <select class="form-control" id="productCategory" name="productCategory" required>
                                <option value="">Select Category</option>
                                <!-- Categories will be populated from the database -->
                                <?php
                                    // Panggil fungsi fetch_categories untuk mengambil kategori dari database
                                    
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Product Description</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                    </form>
                </div>
            </div>
        </section>


    </div>
</body>
</html>
