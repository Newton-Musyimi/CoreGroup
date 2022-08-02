<?php
require_once("../security/admin/config.php");
//require_once('/SysDev/CoreGroup/security/admin/config.php');
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
    $query = "SELECT `user_id`, `username`, `user_type`, `password` FROM `users` WHERE `username` = '$username';";
    $result = mysqli_query($conn, $query) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);
    
    $row = mysqli_fetch_array($result);
    $hashed_pass = $row['password'];
    if(password_verify($password, $hashed_pass)){
        $id = $row['user_id'];
        $username_query = $row['username'];
        if($row['user_type'] == 'client'){
            $_SESSION['role'] = "CLIENT";
        }else{
            var_dump($row);
            
            $result = mysqli_query($conn, "SELECT `role_id` FROM `user_role` WHERE `user_id` = '$id';");

            if ($row = mysqli_fetch_array($result)){
                $result = mysqli_query($conn, "SELECT `role_id` FROM `user_role` WHERE `user_id` = '$id';");
                if ($row = mysqli_fetch_array($result)){
                    $result = mysqli_query($conn, "SELECT `role_name` FROM `roles` WHERE `role_id` = '$id';");
                    if ($row = mysqli_fetch_array($result)){
                        $role = $row['role_name'];
                        $_SESSION['role'] = $role;
                    }else{
                        $_SESSION['role'] = 'EMPLOYEE';
                    }
                }else{
                    $_SESSION['role'] = 'EMPLOYEE';
                }
            }else{
                $_SESSION['role'] = 'EMPLOYEE';
            }
        }
        
        
        
    }else{
        echo '<p>You have entered the wrong password. Try again!</p>';
        exit;
    }
    mysqli_close($conn);
    $_SESSION['logged_in'] = $id;
    $_SESSION['username'] = $username_query;
    var_dump($_SESSION);
    //header("location: ../admin.php");
    
    
}
