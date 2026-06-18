<?php

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

$result = mysqli_query($conn,"
SELECT orders.*,
       users.full_name
FROM orders
JOIN users
ON orders.user_id = users.user_id
ORDER BY orders.order_date DESC
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>

    <style>

    body{
        font-family: Arial, sans-serif;
        margin:30px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th,td{
        border:1px solid #ddd;
        padding:10px;
        text-align:center;
    }

    th{
        background:#6d4c41;
        color:white;
    }

    .btn{
    display:inline-block;
    padding:10px 15px;
    background:#7b5a4d;
    color:white;
    text-decoration:none;
    border-radius:5px;
    margin-right:10px;
}

.btn:hover{
    background:#5f4338;
}

    </style>

</head>
<body>

<h1>Customer Orders</h1>
<p>
    <a href="dashboard.php" class="btn">Dashboard</a>

    <a href="products.php" class="btn">Manage Products</a>

    <a href="add_product.php" class="btn">Add New Product</a>

    <a href="logout.php" class="btn">Logout</a>
</p>

<table>
    

<tr>
    <th>Order ID</th>
    <th>Customer</th>
    <th>Total Amount</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($order = mysqli_fetch_assoc($result)){ ?>

<tr>

<td>
    <?php echo $order['order_id']; ?>
</td>

<td>
    <?php echo $order['full_name']; ?>
</td>

<td>
    Rs. <?php echo number_format($order['total_amount'],2); ?>
</td>

<td>
    <?php echo $order['order_status']; ?>
</td>

<td>
    <?php echo $order['order_date']; ?>
</td>

</tr>

<?php } ?>

</table>

</body>
</html>