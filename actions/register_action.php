<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../config/database.php");

$name = $_POST['full_name'];
$email = $_POST['email'];

$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);

$sql = "INSERT INTO users
(full_name, email, password)
VALUES
('$name', '$email', '$password')";

if(mysqli_query($conn, $sql)){

    header("Location: ../login.php");
    exit();

}else{

    echo "Registration Failed: " . mysqli_error($conn);

}

?>