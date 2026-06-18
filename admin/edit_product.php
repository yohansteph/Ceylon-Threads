<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}
include("../config/database.php");
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$id'");
$product = mysqli_fetch_assoc($result);
if(isset($_POST['update_product'])){
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $image_url = $_POST['image_url'];
    $sql = "UPDATE products SET
            product_name='$product_name',
            description='$description',
            price='$price',
            stock_quantity='$stock_quantity',
            image_url='$image_url'
            WHERE product_id='$id'";
    if(mysqli_query($conn, $sql)){
        header("Location: products.php");
        exit();
    }else{
        echo "Error updating product";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
<h1>Edit Product</h1>
<form method="POST">
<p>Product Name</p>
<input type="text" name="product_name"
       value="<?php echo $product['product_name']; ?>" required>
<p>Description</p>
<textarea name="description"><?php echo $product['description']; ?></textarea>
<p>Price</p>
<input type="number" step="0.01" name="price"
       value="<?php echo $product['price']; ?>" required>
<p>Stock Quantity</p>
<input type="number" name="stock_quantity"
       value="<?php echo $product['stock_quantity']; ?>" required>
<p>Image URL</p>
<input type="text" name="image_url"
       value="<?php echo $product['image_url']; ?>">
<br><br>
<button type="submit" name="update_product">
    Update Product
</button>
</form>
</body>
</html>