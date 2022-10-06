<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: security/login.php");
}
require_once("admin/config.php");
//require_once('/SysDev/CoreGroup/security/admin/config.php');
if(isset($_SESSION['logged_in'])){
    $conn = get_db();
    $username = $_SESSION['username'];
    if($_SESSION['table']=='employees'){
        mysqli_query($conn, "DELETE  FROM `employees` WHERE `username`='$username';") or die("Could not remove employee!");

        //mysqli_query($conn, "UPDATE `employees` SET `employee_status` = 0 WHERE `employee_id` = '$user_id';") or die("Could not fire employee. Try again in a few!");

    }else{

        mysqli_query($conn, "DELETE  FROM `clients` WHERE `username`='$username';") or die("Could not remove client!");


    }
    mysqli_query($conn, "DELETE  FROM `users` WHERE `username`='$username';") or die("Could not remove user!");
    $root = "http://{$_SERVER['HTTP_HOST']}/SysDev/CoreGroup";
    if(session_unset() && session_destroy()){
        header("location: $root/");
        //header("location: /SysDev/CoreGroup/");
    }else{
        header("location: $root/scripts/logout.php");
        //header("location: /SysDev/CoreGroup/scripts/logout.php");
    }
}else{
    header('location: login.php');
}
header('location: logout.php');