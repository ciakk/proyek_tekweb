<?php
    require "session.php";
    require "../includes/koneksi.php";

    $queryProduk = mysqli_query($conn,"SELECT a.*,b.category_name AS category_name FROM product a JOIN category b ON a.category_id = b.category_id");
    $jumlah_produk = mysqli_num_rows($queryProduk);
    $queryKategori = mysqli_query($conn,"SELECT * FROM category");
 
    function generateRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for($i = 0; $i < $length;$i++){
            $randomString.=$characters[rand(0,$charactersLength-1)];
        }
        return $randomString;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>
<style>
    .no-decoration{
        text-decoration: none;
    }
    form div{
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "../includes/navbar.php";?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class ="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>
        <!-- Tambah Produk -->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Product</h3> 
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="name_product">Nama</label>
                    <input type="text" id="name_product" name="name_product" placeholder="input nama product"
                    class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="category">Kategori</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="empty">Pilih 1</option>
                        <?php
                        while($data=mysqli_fetch_array($queryKategori)){
                        ?>
                        <option value="<?php echo $data['category_id'];?>"><?php echo $data['category_name']?></option>
                        <?php  
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" name="price" required>
                </div>
                <div>
                    <label for="photo">Foto Produk</label>
                    <input type="file" name="photo" id="photo" class="form-control" placeholder="Max Size:5MB">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea class="form-control" name="detail" id="detail" cols=30 rows=10></textarea>
                </div>
                <div>
                    <label for="stock_availability">Ketersediaan Stok</label>
                    <select name="stock_availability" id="stock_availability" class="form-control" required>
                        <option value="available">Tersedia</option>
                        <option value="not_available">Tidak Tersedia</option>
                        
                    </select>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan_produk">Simpan</button>
                </div>
            </form>
            <?php
                if(isset($_POST['simpan_produk'])){
                    $name_product = htmlspecialchars($_POST['name_product']);
                    $category_id = htmlspecialchars($_POST['category_id']);
                    $price = htmlspecialchars($_POST['price']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $stock_availability = htmlspecialchars($_POST['stock_availability']);

                    $target_dir = "../image/";
                    $file_name = basename($_FILES["photo"]["name"]);
                    $target_file = $target_dir . $file_name;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["photo"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name .".".$imageFileType;
    
                    echo $target_dir."<br>";
                    echo $file_name."<br>";
                    echo $target_file."<br>";
                    echo $imageFileType."<br>";
                    echo $image_size."<br>";
                    
                    if($name_product =='' ||$category_id ==''||$price =='' ){
            ?>     
                    <div class="alert alert-warning mt-3 role="alert">
                        Nama,kategori,dan harga wajib diisi!
                    </div>
            <?php
                    }
                    else{
                        if($file_name !=''){
                            if($image_size > 5000000){
            ?>
                                <div class="alert alert-warning mt-3 role="alert">
                                Ukuran file tidak boleh lebih dari 5MB!
                                </div>
            <?php              
                            }
                            else{
                                if($imageFileType !='jpg' && $imageFileType !='png'&& $imageFileType !='gif'){
            ?>
                                  <div class="alert alert-warning mt-3 role="alert">
                                    File wajib bertipe jpg atau png atau gif!
                                    </div>  
            <?php
                                }
                                else{
                                    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $new_name);
                                }
                            }
                        }

                        //query insert to product table
                        $queryTambah = mysqli_query($conn,"INSERT INTO product(name_product,price,category_id,photo,detail,stock_availability)
                        VALUES ('$name_product','$price','$category_id','$new_name','$detail','$stock_availability')");

                        if($queryTambah){
            ?>
                            <div class="alert alert-warning mt-3 role="alert">
                            Produk berhasil disimpan!
                            </div>

                            <meta http-equiv="refresh" content="2; url=product.php"/>
            <?php
                        }
                        else{
                            echo mysqli_error($conn);
                        }
                }
            }
                
            ?>
        </div>
        <div class="mt-5">
            <h2>List Produk</h2>
            <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Ketersediaan Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($jumlah_produk == 0){
                    ?>
                    <tr>
                        <td colspan=4 class="text-center">Data Product Tidak Tersedia</td>
                    </tr>
                    <?php
                        }
                        else{
                        $jumlah = 1;
                        while($data=mysqli_fetch_array($queryProduk)){       
                    ?>   
                    <tr>
                        <td><?php echo $jumlah;?></td>
                        <td><?php echo $data['name_product'];?></td>
                        <td><?php echo $data['price'];?></td>
                        <td><?php echo $data['category_name'];?></td>
                        <td><?php echo $data['stock_availability'];?></td>
                        <td>
                            <a href="product-detail.php?p=<?php echo $data['product_id']?>"
                            class="btn btn-info"><i class="fas fa-serch"></i></a>
                        </td>
                    </tr>
                    <?php
                    }
                        }
                    ?>    
                    
                </tbody>
            </table>
        </div>
        </div>
        

    </div>

    Ini halaman produk
    <script src="../boostrap/js/bootstrap/bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
