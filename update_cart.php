<?php
session_start();

include("config/database.php");

$cart_id = $_GET['id'];
$action = $_GET['action'];

if($action == "increase"){

    mysqli_query(
        $conn,
        "UPDATE cart
         SET quantity = quantity + 1
         WHERE cart_id = '$cart_id'"
    );

}

if($action == "decrease"){

    $check = mysqli_query(
        $conn,
        "SELECT quantity
         FROM cart
         WHERE cart_id = '$cart_id'"
    );

    $row = mysqli_fetch_assoc($check);

    if($row['quantity'] > 1){

        mysqli_query(
            $conn,
            "UPDATE cart
             SET quantity = quantity - 1
             WHERE cart_id = '$cart_id'"
        );

    }

}

header("Location: cart.php");
exit();
?>