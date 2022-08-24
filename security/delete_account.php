<?php
    session_start();
    require_once("admin/config.php");
    //require_once('/SysDev/CoreGroup/security/admin/config.php');
    if(isset($_SESSION['logged_in'])){
        $conn = get_db();
        $username= $_POST['username'];
        if($_SESSION['user_type']=='employee'){
            mysqli_query($conn, "DELETE  FROM `employees` WHERE `username`='$username';") or die("Could not remove employee!");
            //mysqli_query($conn, "UPDATE `employees` SET `employee_status` = 0 WHERE `employee_id` = '$user_id';") or die("Could not fire employee. Try again in a few!");
        }else{
            mysqli_query($conn, "DELETE  FROM `clients` WHERE `username`='$username';") or die("Could not remove client!");

        }
    }else{
        header('location: login.php');
    }
    header('location: logout.php');