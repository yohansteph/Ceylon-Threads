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
$result = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
<style>
    body{
        font-family: Arial, sans-serif;
        margin: 30px;
    }
    table{
        width: 100%;
        border-collapse: collapse;
    }
    th, td{
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    th{
        background: #6d4c41;
        color: white;
    }
    img{
        width: 80px;
        height: 80px;
        object-fit: cover;
    }
    .btn{
        padding: 8px 12px;
        text-decoration: none;
        color: white;
        background: #6d4c41;
        border-radius: 5px;
    }
    .delete-btn{
        background: #c0392b;
    }
</style>
</head>
<body>
<h1>Manage Products</h1>

<p>
    <a href="dashboard.php" class="btn">Dashboard</a>

    <a href="orders.php" class="btn">View Orders</a>

    <a href="add_product.php" class="btn">Add New Product</a>

    <a href="logout.php" class="btn">Logout</a>
</p>

<table>
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Product Name</th>
    <th>Price</th>
    <th>Stock Quantity</th>
    <th>Actions</th>
</tr>
<?php while($product = mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $product['product_id']; ?></td>
<td>
    <img src="../<?php echo $product['image_url']; ?>" alt="">
</td>
<td><?php echo $product['product_name']; ?></td>
<td>Rs. <?php echo $product['price']; ?></td>
<td><?php echo $product['stock_quantity']; ?></td>
<td>
    <a href="edit_product.php?id=<?php echo $product['product_id']; ?>" class="btn">
        Edit
    </a>
    <a href="delete_product.php?id=<?php echo $product['product_id']; ?>" class="btn delete-btn">
        Delete
    </a>
</td>
</tr>
<?php } ?>
</table>
</body>
</html>