<?php
    require "../includes/koneksi.php";
    $nama = htmlspecialchars($_GET['nama']);
    $queryProduct = mysqli_query($conn,"SELECT * FROM product WHERE name_product ='$nama'");
    $product = mysqli_fetch_array($queryProduct);

    $queryProductTerkait = mysqli_query($conn,"SELECT * FROM product WHERE category_id='$product[category_id]' 
    AND product_id != '$product[product_id]'LIMIT 4");
    $productTerkait = mysqli_fetch_array($queryProductTerkait);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
</head>
<body>
    <?php require "../includes/navbar.php"; ?>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <img src="../image/<?php echo $product['photo']?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1> <?php echo $product['name_product']; ?></h1>
                    <p class="fs-5">
                        <?php echo $product['detail'];?>
                    </p>
                    <p class="text-harga">
                        Rp <?php echo $product['price'];?>
                    </p>
                    <p class="fs-5"> Status Ketersediaan : <strong> <?php echo $product['stock_availability']?> </strong> </p>
                </div>
            </div>
        </div>
    </div>

<!-- Produk Terkait -->
    <div class="containier-fluid py-5 warna2" > 
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>

            <div class="row">
                <?php while($data = mysqli_fetch_array($queryProductTerkait)){?>
                <div class="col-md-6 col-lg-3 mb-5">
                    <img src="../image/<?php echo $data['photo'];?>" class ="img-fluid img-thumbnail" alt="">
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="../boostrap/js/bootstrap/bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
