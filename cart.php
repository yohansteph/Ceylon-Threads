<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/database.php");

$user_id = $_SESSION['user_id'];

$sql = "
SELECT cart.cart_id,
       cart.quantity,
       products.product_name,
       products.price,
       products.image_url
FROM cart
JOIN products
ON cart.product_id = products.product_id
WHERE cart.user_id = '$user_id'
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Cart</title>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet"
href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

<style>

.cart-section{
    padding:120px 100px;
}

.cart-section h1{
    margin-bottom:30px;
}

.cart-table{
    width:100%;
    border-collapse:collapse;
}

.cart-table th{
    background:#8d6e63;
    color:white;
    padding:15px;
}

.cart-table td{
    padding:15px;
    text-align:center;
    border:1px solid #ddd;
}

.cart-table img{
    width:80px;
    height:80px;
    object-fit:cover;
}

.total-box{
    margin-top:30px;
    text-align:right;
}

.checkout-btn{
    display:inline-block;
    margin-top:15px;
    padding:12px 25px;
    background:#8d6e63;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.checkout-btn:hover{
    background:#5d4037;
}

.remove-btn{
    background:red;
    color:white;
    padding:8px 12px;
    text-decoration:none;
    border-radius:5px;
}

.remove-btn:hover{
    opacity:0.8;
}

</style>

</head>

<body>

<header>
    <a href="index.php" class="logo">
        <img src="img/logo.png" alt="">
    </a>

    <ul class="navbar">
        <li><a href="index.php#home">Home</a></li>
        <li><a href="index.php#products">Products</a></li>
        <li><a href="index.php#about">About Us</a></li>
        <li><a href="index.php#customers">Customers</a></li>
    </ul>

    <div class="header-icon">
        <a href="cart.php">
            <i class='bx bx-cart-alt'></i>
        </a>
    </div>
</header>

<section class="cart-section">

<h1>My Shopping Cart</h1>

<table class="cart-table">

<tr>
    <th>Image</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Action</th>
</tr>

<?php

$grand_total = 0;

while($item = mysqli_fetch_assoc($result)){

    $total = $item['price'] * $item['quantity'];
    $grand_total += $total;
?>

<tr>

<td>
    <img src="<?php echo $item['image_url']; ?>">
</td>

<td>
    <?php echo $item['product_name']; ?>
</td>

<td>
    Rs. <?php echo number_format($item['price'],2); ?>
</td>

<td>
    <a href="update_cart.php?action=decrease&id=<?php echo $item['cart_id']; ?>">➖</a>

    <?php echo $item['quantity']; ?>

    <a href="update_cart.php?action=increase&id=<?php echo $item['cart_id']; ?>">➕</a>
</td>

<td>
    Rs. <?php echo number_format($total,2); ?>
</td>

<td>
    <a class="remove-btn"
       href="remove_from_cart.php?id=<?php echo $item['cart_id']; ?>">
       Remove
    </a>
</td>

</tr>

<?php } ?>

</table>

<div class="total-box">

<h2>
Grand Total: Rs. <?php echo number_format($grand_total,2); ?>
</h2>

<a href="checkout.php" class="checkout-btn">
    Proceed to Checkout
</a>

</div>

</section>

</body>
</html>