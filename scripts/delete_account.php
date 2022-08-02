<?php
    session_start();
    require_once('/scripts/admin/config.php');
    if(isset($_SESSION['logged_in'])){
        $user_id = $_SESSION['user_id'];
            mysqli_query($conn, "DELETE  FROM `users` WHERE `user_id`='$user_id';") or die("Could not delete account. Try again in a few!");
            if($_SESSION['user_type']=='employee'){
                mysqli_query($conn, "UPDATE `employees` SET `employee_status` = 0 WHERE `employee_id` = '$user_id';") or die("Could not fire employee. Try again in a few!");
            }else{
                mysqli_query($conn, "DELETE  FROM `clients` WHERE `client_id`='$user_id';") or die("Could not remove client!");

            }
    }else{
        header('location: login.php');
    }
    header('location: logout.php');
?>