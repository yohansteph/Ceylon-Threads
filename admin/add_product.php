<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

if($_SESSION['role'] != 'admin'){
    header("Location: ../index.php");
    exit();
}

include("../config/database.php");

if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $image_url = $_POST['image_url'];

    $product_name = mysqli_real_escape_string($conn, $product_name);
    $description = mysqli_real_escape_string($conn, $description);
    $image_url = mysqli_real_escape_string($conn, $image_url);

    $sql = "INSERT INTO products
    (product_name, description, price, stock_quantity, image_url)
    VALUES
    ('$product_name', '$description', '$price', '$stock_quantity', '$image_url')";

    if(mysqli_query($conn, $sql)){
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

<form method="POST">

    <p>Product Name</p>
    <input type="text" name="product_name" required>

    <p>Description</p>
    <textarea name="description"></textarea>

    <p>Price</p>
    <input type="number" step="0.01" name="price" required>

    <p>Stock Quantity</p>
    <input type="number" name="stock_quantity" required>

    <p>Image URL</p>
    <input type="text" name="image_url" placeholder="img/image 1.png">

    <br><br>

    <button type="submit" name="add_product">
        Add Product
    </button>

</form>

</body>
</html>