<?php
require_once('/SysDev/CoreGroup/admin/config.php');
if (isset($_SESSION['id'])) {
    if($_SESSION['role']=='client' || $_SESSION['role']=='receptionist'){
        header("location: /helpdesk.php");
    }else{
        header("location: /workorders.php");
    }
}

function standardize($string)
{
    $string = str_replace(' ', '', $string);
    $string = stripslashes($string);
    return strtolower($string);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) OR die("Could not connect to MySQL: " . mysqli_connect_error() . "<br>Contact IT for assistance!");
    $username = standardize($_POST['username']);
    $password = $_POST['password'];
    $query = "SELECT `username`, `user_type`, `password` FROM `users` WHERE `username` = $username;";
    $result = mysqli_query($conn, $query) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);
    
    $row = mysqli_fetch_array($result);
    $hashed_pass = $row['password'];
    if(password_verify($password, $hashed_pass)){
        if($row['user_type'] == 'client'){
            $_SESSION['role'] = $row['user_type'];
        }else{
            $result = mysqli_query($conn, "SELECT `role_id` FROM `user_role` WHERE `user_id` = ".$row['user_id'].";");

            if ($row = mysqli_fetch_array($result)){
                $result = mysqli_query($conn, "SELECT `role_id` FROM `user_role` WHERE `user_id` = ".$row['user_id'].";");
                if ($row = mysqli_fetch_array($result)){
                    $result = mysqli_query($conn, "SELECT `role_name` FROM `roles` WHERE `role_id` = ".$row['role_id'].";");
                    if ($row = mysqli_fetch_array($result)){
                        $_SESSION['role'] = $row['role_name'];
                    }else{
                        $_SESSION['role'] = 'employee';
                    }
                }else{
                    $_SESSION['role'] = 'employee';
                }
            }else{
                $_SESSION['role'] = 'employee';
            }
        }
        $_SESSION['logged_in'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        
        $row = mysqli_fetch_array($result);
        $_SESSION['rank'] = $row['rank'];
        echo 'true';
        
    }else{
        echo '<p>You have entered the wrong password. Try again!</p>';
        exit;
    }
    
    mysqli_close($conn);
}
