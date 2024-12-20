<?php
    require "../includes/koneksi.php";
    $queryKategori = mysqli_query($conn,"SELECT * FROM category");

    //get product by product name
    if(isset($_GET['keyword'])){
        $queryProduct = mysqli_query($conn,"SELECT * FROM product WHERE name_product LIKE '%$_GET[keyword]%'");
    }
    //get product by category
    else if(isset($_GET['kategori'])){
        $queryGetCategoryId = mysqli_query($conn,"SELECT category_id FROM category WHERE category_name='$_GET[kategori]'");
        $categoryId = mysqli_fetch_array($queryGetCategoryId);
        
        $queryProduct = mysqli_query($conn,"SELECT * FROM product WHERE category_id = '$categoryId[category_id]'");
    }
    //get product default
    else{
        $queryProduct = mysqli_query($conn,"SELECT * FROM product");
    }

    $countData = mysqli_num_rows($queryProduct);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
</head>
<body>
    <?php require "../includes/navbar.php";?>
<!-- Banner -->
    <div class="container-fluid banner-product d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>

<!-- Body -->
    <div class ="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
            <h3>Kategori</h3>
            <ul class="list-group">
            <?php while($category = mysqli_fetch_array($queryKategori)){?>
                <a class="no-decoration" href="product.php?kategori=<?php echo $category['category_name']?>">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $category['category_name']?>
                    </li>
                </a>
            <?php
            }
            ?>

            </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php 
                        if($countData < 1){
                    ?>
                        <h4 class ="text-center">Product yang anda cari tidak tersedia!</h4>
                    <?php
                        }
                    ?>

                    <?php while($product = mysqli_fetch_array($queryProduct)){?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="../image/<?php echo $product['photo']?>" class="card-img-top" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"> <?php echo $product['name_product']?> </h4>
                                <p class="card-text text-truncate"> <?php echo $product['detail']?></p>
                                <p class="card-text text-harga"> Rp <?php echo $product['price']?> </p>
                                <a href="product-detail.php?nama=<?php echo $product['name_product']?>">Lihat Detail</a>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../boostrap/js/bootstrap/bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
