<?php

session_start();

include("../config/database.php");

$id = $_GET['id'];

mysqli_query($conn,
    "DELETE FROM cart WHERE product_id='$id'"
);

mysqli_query($conn,
    "DELETE FROM order_items WHERE product_id='$id'"
);

mysqli_query($conn,
    "DELETE FROM products WHERE product_id='$id'"
);

header("Location: products.php");
exit();

?>