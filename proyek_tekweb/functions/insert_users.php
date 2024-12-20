<?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        require("../includes/koneksi.php");
        $username = $_POST['username'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
         // $password = $_POST['password'];
        
        $sql = "INSERT INTO users (username,password) VALUES (?,?)";
    
        // PDO Method to prevent SQL Injection
        $stmt = $conn -> prepare($sql);
        $res = $stmt -> execute([$username, $password]);

        header("Location: ../admin//");
    
    }
?>
