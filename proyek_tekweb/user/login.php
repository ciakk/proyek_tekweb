<?php
session_start();
include '../koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
 
    if (!empty($username) && !empty($password)) { 
        $sql = "SELECT password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($db_password);
        $stmt->fetch();

        if ($stmt->num_rows > 0) {
           
            if ($password === $db_password) {
                echo "Login berhasil!";

                header('Location: home.php');
            } else {
                echo "Password salah";
            }
        } else {
            echo "Username tidak ditemukan";
        }

        $stmt->close();
    } else {
        echo "Harap isi username dan password!";
    }
} else {
    echo "Tidak memiliki akses.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login - E-Commerce</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            
            <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
             }
            header {
                background-color: #343a40;
                color: #fff;
            }
            .nav-link {
                color: #fff;
            }
            .nav-link:hover {
                color: #f8f9fa;
                text-decoration: underline;
            }
            .login-container {
                max-width: 400px;
                margin: 50px auto;
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }
            .login-container h2 {
                color: #007bff;
                margin-bottom: 20px;
                font-weight: bold;
            }
            footer {
                background-color: #343a40;
                color: #fff;
                padding: 10px 0;
                text-align: center;
                margin-top: 50px;
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
        
        <div class="login-container">
            <h2>Login</h2>
            
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            
            <p class="mt-3 text-center">Don't have an account? 
                <a href="signin.php">Sign In</a>
            </p>
        </div>
    </body>
</html>
