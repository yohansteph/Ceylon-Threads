<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/database.php");

if(isset($_GET['id'])){

    $cart_id = $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM cart WHERE cart_id='$cart_id'"
    );

}

header("Location: cart.php");
exit();
?>