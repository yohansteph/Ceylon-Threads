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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<section class="home">
<div class="home-text">
<h1>Admin Dashboard</h1>
<p>Welcome <?php echo $_SESSION['name']; ?></p>
<a href="products.php" class="btn">
Manage Products
</a>
<a href="orders.php" class="btn">
View Orders
</a>
<a href="logout.php" class="btn">
Logout
</a>
</div>
</section>
</body>
</html>