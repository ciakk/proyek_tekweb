<?php 
    
    require "session.php";
    
    require "../includes/koneksi.php";
    
    
    $id = $_GET['c'];

    $query = mysqli_query($conn,"SELECT * FROM category WHERE category_id='$id'");
    $data= mysqli_fetch_array($query);
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Category</title>
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
            <h1 class="logo">E-Commerce <i class="fa fa-shopping-cart"></i></h1>
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
		<h2>Category Details</h2>
	</div>

	<div class="container mt-5">
		<form action="" method="post">
			<div>
				<label for="category">Category</label>
				<input type="text" name="category" id="category" class="form-control" value="<?php echo $data['category_name']; ?>">
			</div>

			<div class="mt-5 d-flex justify-content-between">
				<button type="submit" class="btn btn-primary" name="edit_button">Edit</button>
				<button type="submit" class="btn btn-danger" name="delete_button">Delete</button>
			</div>
			
		</form>

		<?php
			if(isset($_POST['edit_button'])) {

				$category = htmlspecialchars($_POST['category']);
				
				if($data['category_name']==$category){
					?>
						<meta http-equiv="refresh" content="2; url=category.php" />
					<?php
				}
				else{
					$query = mysqli_query($conn,"SELECT * FROM category WHERE category_name='$category'");
					$TotalData = mysqli_num_rows($query);

					if($TotalData == 1){
						?>
						<div class="alert alert-warning mt-3" role="alert">
                        	The Following Category Already Exist!
                		</div>

						<?php
					}
					if($TotalData == 0){
						
						$querySaveData = mysqli_query($conn,"UPDATE category SET category_name='$category' WHERE category_id='$id'");
                    	if($querySaveData){
                    	?>
                    
                		<div class="alert alert-primary mt-3" role="alert">
                       	 	Category has been Changed
                    	</div>

						<meta http-equiv="refresh" content="2; url=category.php" />

						<?php
					}


				}
			}
		}
		if(isset($_POST["delete_button"])) {
            //To check whether the category is already used in a product
            $queryCheck = mysqli_query($conn,"SELECT * FROM product WHERE category_id='$id'");
            $dataCount = mysqli_num_rows($queryCheck);

            if($dataCount > 0){
            ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Kategori tidak bisa dihapus karena sudah digunakan di suatu produk!
                </div>
            <?php
                die();
            }
            $queryDelete = mysqli_query($conn,"DELETE FROM category WHERE category_id='$id'");
			if($queryDelete){
				?>
					<div class="alert alert-primary mt-3" role="alert">
                        The Following Category Has been Deleted..
                	</div>

					<meta http-equiv="refresh" content="2; url=category.php" />

				<?php
			}
			else{
				echo mysqli_error($conn);
			}
		}
		?>
	</div>

	<script src= "..bootstrap/js/bootstrap.bundle.min.js"> </script>
</body>
</html>