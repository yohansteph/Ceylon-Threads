<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/database.php");

$user_id = $_SESSION['user_id'];

/* Get Cart Items */

$cart_query = mysqli_query($conn,"
SELECT cart.product_id,
       cart.quantity,
       products.price
FROM cart
JOIN products
ON cart.product_id = products.product_id
WHERE cart.user_id='$user_id'
");

if(mysqli_num_rows($cart_query) == 0){

    echo "<script>
            alert('Your cart is empty!');
            window.location='cart.php';
          </script>";
    exit();
}

/* Calculate Grand Total */

$grand_total = 0;

while($item = mysqli_fetch_assoc($cart_query)){

    $grand_total += ($item['price'] * $item['quantity']);

}

/* Create Order */

$order_sql = "INSERT INTO orders
(user_id, total_amount, order_status)
VALUES
('$user_id', '$grand_total', 'Pending')";

mysqli_query($conn, $order_sql);

$order_id = mysqli_insert_id($conn);

/* Get Cart Again */

$cart_query = mysqli_query($conn,"
SELECT cart.product_id,
       cart.quantity,
       products.price
FROM cart
JOIN products
ON cart.product_id = products.product_id
WHERE cart.user_id='$user_id'
");

/* Insert Order Items */

while($item = mysqli_fetch_assoc($cart_query)){

    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['price'];

    mysqli_query($conn,"
    INSERT INTO order_items
    (order_id, product_id, quantity, price)
    VALUES
    ('$order_id','$product_id','$quantity','$price')
    ");

}

/* Clear Cart */

mysqli_query($conn,"
DELETE FROM cart
WHERE user_id='$user_id'
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div style="text-align:center; padding:100px;">

    <h1>🎉 Order Placed Successfully!</h1>

    <p>
        Your Order ID is:
        <strong>#<?php echo $order_id; ?></strong>
    </p>

    <p>
        Total Amount:
        <strong>Rs. <?php echo number_format($grand_total,2); ?></strong>
    </p>

    <br>

    <a href="index.php" class="btn">
        Continue Shopping
    </a>

</div>

</body>
</html>