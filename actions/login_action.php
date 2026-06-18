<?php

session_start();

include("../config/database.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $user = mysqli_fetch_assoc($result);

    if(password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        if($user['role'] == 'admin'){
            header("Location: ../admin/dashboard.php");
            exit();
        }else{
            header("Location: ../index.php");
            exit();
        }

    }else{

        echo "<script>
                alert('Incorrect Password');
                window.location.href='../login.php';
              </script>";

    }

}else{

    echo "<script>
            alert('User Not Found');
            window.location.href='../login.php';
          </script>";

}

?>