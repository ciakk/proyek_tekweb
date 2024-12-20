<?php 
    
    require "session.php";
    
    require "../includes/koneksi.php";
    
    
    $queryKategori = mysqli_query($conn, "SELECT * FROM category");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    
    $queryProduk = mysqli_query($conn,"SELECT * FROM product");
    $jumlahProduk = mysqli_num_rows($queryProduk)
    
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
</head>

<style>
        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #343a40;
            background-color: black;
            color: #fff;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            color: #fff;
        }

        .nav-home {
            color:black;
            font-weight: bold;
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


<body style="background-color:rgb(126, 120, 162)">
    <header class="p-3">

        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="logo">E-Commerce <i class="fa fa-shopping-cart"></i> </h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home <i class="fa fa-home"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
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

    <div class="container mt-5">
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-home" href="home.php"> <i class="fa fa-home"></i> Home </a>
                </li>
                <li class="nav-item">
                    &nbsp;/ Kategori
                </li>
            </ul>
        </nav>
    </div>

    <div class="container mt-5">
        <h3 class="logo">Add Category</h3>

        <form action="" method ="post">
            <div>
                <label for="category">Category</label>
            </div>  
            <div class="mt-1">
                <input type="text" id="category" name="category" placeholder="Input nama kategori produk" class="form-control"></input>
            </div>  
            <div class="mt-3">
                <button class="btn btn-primary" type="submit" name="simpan_kategori">Save</button>
            </div>
        </form>

        <?php 
            if(isset($_POST["simpan_kategori"])){
                $category = htmlspecialchars($_POST["category"]);

                $queryCategoryExist = mysqli_query($conn,"SELECT category_name FROM category WHERE category_name='$category'");
                $DataCategoryISNew = mysqli_num_rows($queryCategoryExist);
                if($DataCategoryISNew == 1){
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        The Following Category Exist!
                    </div>
                    <?php
                }
                if($DataCategoryISNew == 0){
                    $querySaveData = mysqli_query($conn,"INSERT INTO category (category_name) VALUES ('$category')");
                    if($querySaveData){
                    ?>
                    
                    <div class="alert alert-primary mt-3" role="alert">
                        Category Added
                    </div>

                    <meta http-equiv="refresh" content="2; category.php" />
                    <?php
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
                
            }

        ?>
    </div>
    

    
    
    <div class="container mt-5">
        <h1 class="logo">
            Category
        </h1>
        <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($jumlahKategori == 0) {
                    ?>
                            <tr>
                                <td colspan = 3 class ="text-center"> No Data in the Category
                            </tr>
                    <?php
                        }
                        else{
                            $jumlah = 1;
                            while($data=mysqli_fetch_array($queryKategori)){
                    ?>         
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['category_name']; ?></td>
                                <td>
                                    <a href="category-detail.php?c=<?php echo $data['category_id']; ?>" class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                            </tr> 
                    <?php        
                            $jumlah++;

                            }  
                        }
                    ?>     
                    
                </tbody>
            </table>
        </div>
    </div>

    

    <script> src= "..bootstrap/js/bootstrap.bundle.min.js"</script>
    
    
</body>
</html>

