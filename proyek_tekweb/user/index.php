<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link rel="stylesheet" href="../css/style.css">
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

        .hero {
            background-color: #007bff;
            color: #fff;
            padding: 50px 0;
        }

        .hero h2 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 20px;
        }

        .categories h3, .featured-products h3 {
            color: #007bff;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .categories .col-md-4 h4 {
            color: #343a40;
            margin-top: 10px;
            font-weight: bold;
        }
        footer {
            background-color: #343a40;
            color: #fff;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
    </head>
    <body>
        <header class="p-3">
            <div class="container d-flex justify-content-between align-items-center">
                <h1 class="logo">E-Commerce</h1>
                <nav>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sign In</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        
        <section class="hero text-center">
            <div class="container text-center text-white">
                <h2>Welcome to Our Store!</h2>
                <p>Discover amazing products here</p>
                <div class="container-fluid d-flex align-items-center">
                    <form action="product.php" method="GET">
                        <div class="container-fluid d-flex align-items-center">
                            <input type="text" class="form-control" placeholder="Nama Barang"
                            aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                            <button type="" class="btn btn-warning text-black">Telusuri</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
        <!-- <section class="categories mt-5">
            <div class="container">
                <h3>Featured Categories</h3>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <a href="category1.php">
                            <img src= "baju.avif" class="img-fluid rounded" alt="Category 1">
                            <h4>Category 1</h4>
                        </a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="category2.php">
                            <img src="#" class="img-fluid rounded" alt="Category 2">
                            <h4>Category 2</h4>
                        </a>
                    </div>
                    
                    <div class="col-md-4 text-center">
                        <a href="category3.php">
                            <img src="#" class="img-fluid rounded" alt="Category 3">
                            <h4>Category 3</h4>
                        </a>
                    </div>
                 </div>
            </div>
        </section>

        <section class="featured-products mt-5">
            <div class="container">
                <h3>Featured Products</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <img src="product1.jpg" class="card-img-top" alt="Product 1">
                            <div class="card-body">
                                <h5 class="card-title">Product 1</h5>
                                <p class="card-text">$19.99</p>
                                <a href="product1.php" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                    </div>

                    
                

                </div>
            </div>
        </section> -->



    </body>
</html>
