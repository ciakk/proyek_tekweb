<?php 
    
    require "session.php";
    
    require "../includes/koneksi.php";
    
    
    $id = $_GET['p'];

    $query = mysqli_query($conn,"SELECT a.*,b.category_name AS category_name FROM product a JOIN category b ON a.category_id = b.category_id");
    $data= mysqli_fetch_array($query);
    $queryKategori = mysqli_query($conn,"SELECT * FROM category WHERE category_id != '$data[category_id]'");
    
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
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
</head>

<style>
    form div{
        margin-bottom: 10px;
    }

</style>

<body>
    <?php require "../includes/navbar.php";?>
    <script src= "..bootstrap/js/bootstrap.bundle.min.js"> </script>

    <div class="container mt-5">
		<h2>Product Details</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="name_product">Nama</label>
                    <input type="text" id="name_product" value = "<?php echo $data['name_product'];?>"name="name_product" placeholder="input nama product"
                    class="form-control" autocomplete="off" required>
                </div>

                <div>
                    <label for="category">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="<?php echo $data['category_name'];?>"><?php echo $data['category_name'];?></option>
                            <?php
                            while($dataKategori=mysqli_fetch_array($queryKategori)){
                            ?>
                            <option value="<?php echo $dataKategori['category_id'];?>"><?php echo $dataKategori['category_name'];?></option>
                            <?php  
                            }
                            ?>
                        </select>
                </div>
                <div>
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" value = "<?php echo $data['price'];?>" name="price" required>
                </div>

                <div>
                    <label for="currentPhoto">Foto Produk(sekarang)</label>
                    <img src="../image/<?php echo $data['photo']?>" alt="" width="300px;">
                </div>

                <div>
                    <label for="photo">Foto Produk</label>
                    <input type="file" name="photo" id="photo" class="form-control" placeholder="Max Size:5MB">
                </div>

                <div>
                    <label for="detail">Detail</label>
                    <textarea class="form-control" name="detail" id="detail" cols=30 rows=10>
                        <?php echo $data['detail']?>
                    </textarea>
                </div>

                <div>
                    <label for="stock_availability">Ketersediaan Stok</label>
                    <select name="stock_availability" id="stock_availability" class="form-control" required>
                        <option value="<?php echo $data['stock_availability']?>"><?php echo $data['stock_availability']?></option>
                        <?php
                            if($data['stock_availability'] == 'Available'){
                            ?>
                            <option value="not_available">Not Available</option>

                            <?php
                            }
                            else{
                            ?>
                            <option value="available">Available</option>
                            <?php
                            }
                        ?>
                        
                        
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit" name="simpan_produk">Simpan</button>
                    <button class="btn btn-danger" type="submit" name="delete_produk">Delete</button>

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

                    if($name_product =='' ||$category_id ==''||$price =='' ){
                    ?>     
                        <div class="alert alert-warning mt-3 role="alert">
                            Nama,kategori,dan harga wajib diisi!
                        </div>
                    <?php
                    }
                    else{
                        $queryUpdate = mysqli_query($conn,"UPDATE product SET category_id='$category_id',name_product='$name_product'
                        ,price='$price',detail='$detail',stock_availability='$stock_availability' WHERE product_id=$id");

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
                                    $queryUpdate = mysqli_query($conn,"UPDATE product SET photo='$new_name' WHERE product_id=$id");

                                    if($queryUpdate){
                                    ?>
                                    <div class="alert alert-primary mt-3 role="alert">
                                            Produk berhasil diupdate!
                                    </div>
                                    <meta http-equiv="refresh" content="2; url=product.php"/>
                                    <?php    
                                    }
                                    else{
                                        echo mysqli_error($conn);
                                    }
                                }
                            }
                        }
                    }
                }
                if(isset($_POST['delete_produk'])){
                    $queryDelete = mysqli_query($conn,"DELETE FROM product where product_id=$id");
                    if($queryDelete){
                        ?>
                        <div class="alert alert-primary mt-3 role="alert">
                            Produk berhasil diupdate!
                        </div>
                        <meta http-equiv="refresh" content="2; url=product.php"/>
                        <?php
                        }
                        else{
                            echo mysqli_error($conn);
                        }
                }
                
            ?>

        </div>
    </div>

</body>
</html>