<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST['categoryName'];
    
    $query = "INSERT INTO category (category_name) VALUES (:categoryName)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':categoryName', $categoryName);

    if ($stmt->execute()) {
        echo "Category added successfully.";
    } else {
        echo "Failed to add category.";
    }
}

// nampilin produk
$sql2= "SELECT category_name FROM category";
$stmt2= $conn->query($sql2);

?>
